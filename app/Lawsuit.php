<?php

namespace App;

use App\Event;
use App\Stade;
use Carbon\Carbon;
use App\ModelStade;
use Illuminate\Support\Arr;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Lawsuit extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'lawsuits';
    protected $guarded = [];
    
    public function client()
    {
        return $this->belongsTo('App\Contact', 'client_id', 'id');
    }

    public function opponent()
    {
        return $this->belongsTo('App\Contact', 'opponent_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function stades()
    {
        return $this->hasMany('App\Stade');
    }

    public function attachements()
    {
        return $this->hasMany('App\Attachement');
    }
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function billings()
    {
        return $this->hasMany('App\Billing');
    }

    public function convention()
    {
        return $this->belongsTo('App\Convention');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }
    public function model()
    {
        return $this->belongsTo('App\LawsuitModel', 'model_id', 'id');
    }

    public function getNameAttribute()
    {
        if ($this->deleted_at==null) {
            return "{$this->procedure->name} - Affaire {$this->caseNum}: {$this->client->name} contre {$this->opponent->name}";
        }else {
            return "Pas de résultats.";
        }
    }

    public function scopeCurrentUser($query)
    {
        $Lawsuit = new Lawsuit;
        if (Auth::user()->can('deleted', $Lawsuit)) {
            return $query;
        }else {
            if (Auth::user()->can('edit', $Lawsuit)) {
                return $query->whereNull('deleted_at');
            } else {
                return $query->whereIn('id', Auth::user()->lawsuits->pluck('id'))->whereNull('deleted_at');
            }
        }
    }

    public $additional_attributes = ['name'];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($lawsuit){
            if ($lawsuit->model_id!=null) {
                if ($lawsuit->procedure==$lawsuit->model->procedure) {
                    $firstLawsuitModelStade= ModelStade::where("model_id",$lawsuit->model_id)
                                                        ->where("first", 1)
                                                        ->whereNull("previous_id")
                                                        ->firstOrFail();
                    $stadesList = Stade::where('lawsuit_id', $lawsuit->id)->pluck('stade_name_id')->toArray();
                    if (!in_array($firstLawsuitModelStade->current_id, $stadesList)) {
                        $lawsuit->stades()->create([
                            'stade_name_id' => $firstLawsuitModelStade->current_id,
                            'date' => $lawsuit->acceptation,
                            'state' => 0,
                        ]); 
                    }
                    $roleAdmin = Role::where('name', 'Admin')->firstOrFail();
                    $roleAvocat = Role::where('name', 'Avocat')->firstOrFail();
                    $roleCabinet = Role::where('name', 'Cabinet')->firstOrFail();
                    $adminUser = User::where('role_id', $roleAdmin->id)->firstOrFail();
                    $RoleUsers = User::where('role_id', $roleAvocat->id)->orWhere('role_id', $roleCabinet->id)->get();
                    $eventIds = collect([]);
                    $LawsuitModelStades= ModelStade::where("model_id",$lawsuit->model_id)->get();
                    foreach ($LawsuitModelStades as $lawsuitModelStade) {
                        if ($lawsuitModelStade->current->days!=null) {
                            $start_date= Carbon::parse($lawsuit->acceptation)->addWeekdays((float)$lawsuitModelStade->current->days)->toDateString() . ' ' . date('H:i:s');
                            $event = Event::create([
                                'title' => 'Date Limite du Stade - ' . $lawsuitModelStade->current->name . ' - ' . $lawsuit->name,
                                'start_date' => $start_date,
                                'end_date' => Carbon::parse($start_date)->addMinutes(5)->toDateTimeString(),
                                'background_color' => '#22A7F0',
                                'user_id' => $adminUser->id,
                                'lawsuit_id' => $lawsuit->id,
                            ]);
                            $eventIds->push($event->id);
                        }
                    }
                    foreach ($RoleUsers as $RoleUser) {
                        $RoleUser->sharedevents()->syncWithoutDetaching($eventIds->all());
                    }
                }
            }     
        });
        static::updated(function ($lawsuit){
            if ($lawsuit->stades()->count()==0) {
                if ($lawsuit->model_id!=null) {
                    if ($lawsuit->procedure==$lawsuit->model->procedure) {
                        $firstLawsuitModelStade= ModelStade::where("model_id",$lawsuit->model_id)
                                                            ->where("first", 1)
                                                            ->whereNull("previous_id")
                                                            ->firstOrFail();
                        $stadesList = Stade::where('lawsuit_id', $lawsuit->id)->pluck('stade_name_id')->toArray();
                        if (!in_array($firstLawsuitModelStade->current_id, $stadesList)) {
                            $lawsuit->stades()->create([
                                'stade_name_id' => $firstLawsuitModelStade->current_id,
                                'date' => $lawsuit->acceptation,
                                'state' => 0,
                            ]); 
                        }
                    }
                }    
            }
            if ($lawsuit->events()->count()==0) {
                if ($lawsuit->model_id!=null) {
                    if ($lawsuit->procedure==$lawsuit->model->procedure) {
                        $roleAdmin = Role::where('name', 'Admin')->firstOrFail();
                        $roleAvocat = Role::where('name', 'Avocat')->firstOrFail();
                        $roleCabinet = Role::where('name', 'Cabinet')->firstOrFail();
                        $adminUser = User::where('role_id', $roleAdmin->id)->firstOrFail();
                        $RoleUsers = User::where('role_id', $roleAvocat->id)->orWhere('role_id', $roleCabinet->id)->get();
                        $eventIds = collect([]);
                        $LawsuitModelStades= ModelStade::where("model_id",$lawsuit->model_id)->get();
                        foreach ($LawsuitModelStades as $lawsuitModelStade) {
                            if ($lawsuitModelStade->current->days!=null) {
                                $start_date= Carbon::parse($lawsuit->acceptation)->addWeekdays((float)$lawsuitModelStade->current->days)->toDateString() . ' ' . date('H:i:s');
                                $event = Event::create([
                                    'title' => 'Date Limite du Stade  ' . $lawsuitModelStade->current->name . ' - ' . $lawsuit->name,
                                    'start_date' => $start_date,
                                    'end_date' => Carbon::parse($start_date)->addMinutes(5)->toDateTimeString(),
                                    'background_color' => '#22A7F0',
                                    'user_id' => $adminUser->id,
                                    'lawsuit_id' => $lawsuit->id,
                                ]);
                                $eventIds->push($event->id);
                            }
                        }
                        foreach ($RoleUsers as $RoleUser) {
                            $RoleUser->sharedevents()->syncWithoutDetaching($eventIds->all());
                        }
                    }
                }    
            }
            if ($lawsuit->convention!=null) {
                if ($lawsuit->procedure==$lawsuit->convention->procedure) {
                if ($lawsuit->isDirty('auto_billing') && $lawsuit->auto_billing==1) {
                    foreach ($lawsuit->stades as $stade) {
                        if ($stade->state == 1) {
                            $convention = $lawsuit->convention;
                            $creance = $lawsuit->creance;
                            $honoraireTotal = null;
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
                                    if ($honoraires) {
                                        if ($honoraires->count()>0) {
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
                                }
                                foreach ($thisStadeModalites as $modalite) {
                                    $lawsuitBillsItems1=Billing::where('lawsuit_id', $lawsuit->id)->pluck('item1')->toArray();
                                    $lawsuitBillsItems2=Billing::where('lawsuit_id', $lawsuit->id)->pluck('item2')->toArray();
                                    $lawsuitBillsItems3=Billing::where('lawsuit_id', $lawsuit->id)->pluck('item3')->toArray();
                                    $lawsuitBillsItems4=Billing::where('lawsuit_id', $lawsuit->id)->pluck('item4')->toArray();
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
                                                    'lawsuit_id'    => $lawsuit->id,
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
        static::deleting(function ($lawsuit) {
            $lawsuit->events()->delete();
            $lawsuit->billings()->delete();
            $lawsuit->stades()->delete();
        });
        static::restoring(function ($lawsuit) {
            $lawsuit->events()->withTrashed()->restore();
            $lawsuit->billings()->withTrashed()->restore();
            $lawsuit->stades()->withTrashed()->restore();
        });
    }
}
