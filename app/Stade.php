<?php

namespace App;

use App\Billing;
use App\Lawsuit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stade extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'date', 'state', 'observation', 'lawsuit_id',
    ];
    public function attachements()
    {
        return $this->hasMany('App\Attachement');
    }

    public function lawsuit()
    {
        return $this->belongsTo('App\Lawsuit', 'lawsuit_id', 'id');
    }
    
    public function user()  
    {
        return $this->lawsuit->user;
    }

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
   
    public function getNomAttribute()
    {
        if ($this->lawsuit) {
            return "{$this->lawsuit->name} Stade: ".$this->stadenames[$this->name];
            
        }else {
            return "Pas de résultats.";

        }
    }
    public function getShortAttribute()
    {

        return $this->stadenames[$this->name];
    }

    public $stadenames = [
        "option1"   => "A0: Acceptation Dossier (M.E.D)",
        "option2"   => "A1: Audience",
        "option3"   => "A2: Notification et Exécution CI",
        "option4"   => "A3: Expertise Comptable",
        "option5"   => "A4: Jugement A.D.D",
        "option6"   => "A5: Jugement DEFINITIF",
        "option7"   => "A6: Demande Notification et Execution (F.C)",
        "option8"   => "A7: Adjudication",
        "option9"   => "B0: Acceptation Dossier",
        "option10"  => "B1: Mise en demeure (art 114 CC)",
        "option11"  => "B2: Notification",
        "option12"  => "B3: Procédure Curateur",
        "option13"  => "B4: Saisine du juge",
        "option14"  => "B5: Expertise Mobilière",
        "option15"  => "B7: Vente (F.C)",
        "option16"  => "C0: Acceptation Dossier",
        "option17"  => "C1: Dépôt CI",
        "option18"  => "C2: Notification et Exécution CI",
        "option19"  => "C3: Procédure Curateur",
        "option20"  => "C4: Publications CI",
        "option21"  => "C5: Expertise Immobilière",
        "option22"  => "C6: Rapport Expertise Immobilière",
        "option23"  => "C7: Vente Immobilière",
        ];

    public $additional_attributes = ['nom','short'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($stade){
            $procedure = $stade->lawsuit->procedure;
            $curateur = $stade->lawsuit->curateur;
            $creance = $stade->lawsuit->creance;
            $convention = $stade->lawsuit->convention;
            $lawsuitId = $stade->lawsuit_id;
            $stadesList = Stade::where('lawsuit_id', $lawsuitId)->pluck('name')->toArray();
            if ($stade->state == 1) {
                // Assignation (stades name:option1=>option8)
                if ($procedure == 'option1') {
                    for ($i = 1; $i < 8; $i++) {
                        if ($stade->name == 'option'.$i) {
                            $next = $i + 1;
                            $nextName = 'option'.$next;
                            if(!in_array($nextName, $stadesList)){
                                $stade->create([
                                    'lawsuit_id' => $lawsuitId,
                                    'name' => $nextName,
                                    'date' => now(),
                                    'state' => 0,
                                ]);
                            }
                        }
                    }
                // Commandement Immobilier (stades name:option16=>option23)
                } elseif ($procedure == 'option2') {
                    for ($i = 16; $i < 23; $i++) {
                        if ($stade->name == 'option' . $i) {
                            if ($i == 18) {
                                if ($stade->lawsuit->curateur==1) {
                                    $next = $i + 2;
                                }else{
                                    $next = $i + 1;
                                }
                            }else {
                                $next = $i + 1;
                            }
                            $nextName = 'option'.$next;
                            if (!in_array($nextName, $stadesList)) {
                                $stade->create([
                                    'lawsuit_id' => $lawsuitId,
                                    'name' => $nextName,
                                    'date' => now(),
                                    'state' => 0,
                                ]);
                            }                      
                        }
                    }

                // Nantissement F.C (stades name:option9=>option15)
                } elseif ($procedure == 'option4') {
                    for ($i = 9; $i < 15; $i++) {
                        if ($stade->name == 'option' . $i) {
                            if ($i == 11) {
                                if ($stade->lawsuit->curateur==1) {
                                    $next = $i + 2;
                                }else{
                                    $next = $i + 1;
                                }
                            }else {
                                $next = $i + 1;
                            }
                            $nextName = 'option' . $next;
                            if (!in_array($nextName, $stadesList)) {
                                $stade->create([
                                    'lawsuit_id' => $lawsuitId,
                                    'name' => $nextName,
                                    'date' => now(),
                                    'state' => 0,
                                ]);
                            }
                        }
                    }
                }

                if ($convention != null && $procedure == $convention->procedure) {
                    $thisStadeModalites=$convention->modalites()->where('stade_name',$stade->name)->get();
                    if ($thisStadeModalites->count()>0) {
                        if ($convention->type==1) {
                            if ($convention->amount!=null && $convention->amount>=0) {
                                $honoraireTotal = (float)$convention->amount;
                            }
                        }elseif ($convention->type==0) {
                            $honoraires=$convention->honoraires()->where('min_crc','<=',$creance)->where('max_crc','>=',$creance)->get();
                            if ($honoraires->count()>0) {
                                foreach($honoraires as $honoraire){
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
                        $lawsuitBillsItems1=Billing::where('lawsuit_id',$lawsuitId)->pluck('item1')->toArray();
                        $lawsuitBillsItems2=Billing::where('lawsuit_id',$lawsuitId)->pluck('item2')->toArray();
                        $lawsuitBillsItems3=Billing::where('lawsuit_id',$lawsuitId)->pluck('item3')->toArray();
                        $lawsuitBillsItems4=Billing::where('lawsuit_id',$lawsuitId)->pluck('item4')->toArray();
                        $billingDate= $stade->date;
                        foreach($thisStadeModalites as $modalite){
                            if ($modalite->type==0) {
                                $billingAmount = (float) (($honoraireTotal * (float) $modalite->amount) / 10);

                            }elseif ($modalite->type==1) {
                                $billingAmount = (float) $modalite->amount;

                            }
                            $billingType= $modalite->bill_type;
                            $billingMission= $modalite->name;
                            $billingDays= $modalite->days;
                            $billingTax= $modalite->tax;
                            if (!in_array($billingMission,$lawsuitBillsItems1) && !in_array($billingMission,$lawsuitBillsItems2) && !in_array($billingMission,$lawsuitBillsItems3) && !in_array($billingMission,$lawsuitBillsItems4)) {
                                # code for creating bill...
                                if ($billingTax!=null) {
                                    $billingTax=(float)$billingTax;
                                }
                                if ($billingDays!=null) {
                                    $billingDays=(float)$billingDays;
                                }
                                Billing::create([
                                    'lawsuit_id'    => $lawsuitId,
                                    'type'          => $billingType,
                                    'item1'         => $billingMission,
                                    'days'          => $billingDays,
                                    'tax'           => $billingTax,
                                    'date'          => $billingDate,
                                    'price1'        => $billingAmount,
                                ]);
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
