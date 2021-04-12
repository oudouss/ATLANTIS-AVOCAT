<?php

namespace App;

use App\Billing;
use App\Lawsuit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stade extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'stades';
    protected $guarded = [];
    public function attachements()
    {
        return $this->hasMany('App\Attachement');
    }

    public function lawsuit()
    {
        return $this->belongsTo('App\Lawsuit', 'lawsuit_id', 'id');
    }
    public function title()
    {
        return $this->belongsTo('App\StadeName', 'stade_name_id', 'id');
    }
    
    public function getNomAttribute()
    {
        if ($this->lawsuit) {
            return "{$this->lawsuit->name} Stade: ".$this->title->name;           
        }else {
            return "Pas de résultats.";
        }
    }
    public function getShortAttribute()
    {
        if ($this->title) {
            return $this->title->name;
        }else {
            return "Pas de résultats.";
        }
    }
    public function getDeadLineAttribute()
    {
        if ($this->title->days!=null) {
            return Carbon::parse($this->lawsuit->acceptation)->addDays((float) $this->title->days)->format('d-m-Y');
           
        }else {
            return "Pas de date limite.";
        }
    }
    public $additional_attributes = ['nom','short','dead_line'];

    public function scopeMyStades($query)
    {
        $Stade = new Stade();
        if (Auth::user()->can('deleted', $Stade)) {
            return $query;
        }else {
            if (Auth::user()->can('edit', $Stade)) {
                return $query->whereIn('lawsuit_id', Lawsuit::whereNull('deleted_at')->pluck('id'))->whereNull('deleted_at');
            } else {
                return $query->whereIn('lawsuit_id', Auth::user()->lawsuits()->whereNull('deleted_at')->pluck('id'))->whereNull('deleted_at');
            }
        }

    }
    
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($stade){
            if ($stade->lawsuit->state== "option1") {
                if ($stade->lawsuit->model_id!=null) {
                    if ($stade->lawsuit->procedure==$stade->lawsuit->model->procedure) {
                        $lawsuitModelStades= ModelStade::where("model_id", $stade->lawsuit->model_id)->where("current_id", $stade->stade_name_id)->get();
                        $lawsuitModelStadesLast= ModelStade::where("model_id", $stade->lawsuit->model_id)
                                                            ->where("last", 1)
                                                            ->whereNull("next_id")
                                                            ->firstOrFail();
                        $stadesList = Stade::where('lawsuit_id', $stade->lawsuit_id)->pluck('stade_name_id')->toArray();
                        if ($stade->state == 1) {
                            if ($stade->stade_name_id==$lawsuitModelStadesLast->current_id) {
                                $stade->lawsuit->state= "option3";
                            }
                            foreach ($lawsuitModelStades as $lawsuitModelStade) {
                                if ($lawsuitModelStade->next_id!=null) {
                                    if (!in_array($lawsuitModelStade->next_id, $stadesList)) {
                                        $stade->create([
                                            'lawsuit_id' => $stade->lawsuit_id,
                                            'stade_name_id' => $lawsuitModelStade->next_id,
                                            'date' => now(),
                                            'state' => 0,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
                if ($stade->lawsuit->convention!=null) {
                    if ($stade->lawsuit->procedure==$stade->lawsuit->convention->procedure) {
                        if ($stade->lawsuit->auto_billing==1) {
                            if ($stade->state == 1) {
                                $convention = $stade->lawsuit->convention;
                                $creance = $stade->lawsuit->creance;
                                $honoraireTotal=null;
                                $billingAmount = null;
                                if ($creance != null && $creance>=0) {
                                    $honoraires = $convention->honoraires()->where('min_crc', $convention->honoraires()->where('min_crc', '<=', $creance)->max('min_crc'))->get();
                                }
                                $thisStadeModalites = $convention->modalites()->where('stade_name_id', $stade->stade_name_id)->get();
                                if ($thisStadeModalites->count()>0) {
                                    if ($convention->type==1) {
                                        if ($convention->amount!=null && $convention->amount>=0) {
                                            $honoraireTotal = (float)$convention->amount;
                                        }
                                    } elseif ($convention->type==0) {
                                        if ($honoraires != null && $honoraires->count()>0) {
                                            foreach ($honoraires as $honoraire) {
                                                $percent=$honoraire->percent;
                                                if ($creance != null && $creance>=0) {
                                                    $honoraireTotalCalculated = ((float) $creance * (float) $percent) / 100;
                                                }
                                                $honoraireTotal = (float)$honoraireTotalCalculated;
                                                if ($honoraire->min!=null && $honoraire->min>=0) {
                                                    if ($honoraireTotal<(float)$honoraire->min) {
                                                        $honoraireTotal = (float) $honoraire->min;
                                                    }
                                                }
                                                if ($honoraire->min!=null && $honoraire->min>=0) {
                                                    if ($honoraireTotal>(float)$honoraire->max) {
                                                        $honoraireTotal = (float) $honoraire->max;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    foreach ($thisStadeModalites as $modalite) {
                                        $lawsuitBillsItems1=Billing::where('lawsuit_id', $stade->lawsuit_id)->pluck('item1')->toArray();
                                        $lawsuitBillsItems2=Billing::where('lawsuit_id', $stade->lawsuit_id)->pluck('item2')->toArray();
                                        $lawsuitBillsItems3=Billing::where('lawsuit_id', $stade->lawsuit_id)->pluck('item3')->toArray();
                                        $lawsuitBillsItems4=Billing::where('lawsuit_id', $stade->lawsuit_id)->pluck('item4')->toArray();
                                        if ($modalite->type==0 && $honoraireTotal!=null) {
                                            $billingAmount = (float) (($honoraireTotal * (float) $modalite->amount) / 100);
                                        } elseif ($modalite->type==1) {
                                            $billingAmount = (float) $modalite->amount;
                                        }
                                        $billingType= $modalite->bill_type;
                                        $billingMission= $modalite->name;
                                        $billingDays= $modalite->days;
                                        $billingTax= $modalite->tax;
                                        if ($billingMission!=null) {
                                            if (!in_array($billingMission, $lawsuitBillsItems1) && !in_array($billingMission, $lawsuitBillsItems2) && !in_array($billingMission, $lawsuitBillsItems3) && !in_array($billingMission, $lawsuitBillsItems4)) {
                                                if ($billingTax!=null) {
                                                    $billingTax=(float)$billingTax;
                                                }
                                                if ($billingDays!=null) {
                                                    $billingDays=(float)$billingDays;
                                                }
                                                if ($billingAmount!=null) {
                                                    Billing::create([
                                                        'lawsuit_id'    => $stade->lawsuit_id,
                                                        'type'          => $billingType,
                                                        'item1'         => $billingMission,
                                                        'days'          => $billingDays,
                                                        'tax'           => $billingTax,
                                                        'date'          => now(),
                                                        'price1'        => $billingAmount,
                                                    ]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
        static::deleting(function ($stade) {
            $stade->attachements()->delete();
        });
        static::restoring(function ($stade) {
            $stade->attachements()->withTrashed()->restore();
        });
    }

}
