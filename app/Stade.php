<?php

namespace App;

use Carbon\Carbon;
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
        if (Auth::user()->can('edit', $Stade)) {
            return $query;
        } else {
             return $query->whereIn('lawsuit_id', Auth::user()->lawsuits->pluck('id'));
        }
    }

    
    public function getNomAttribute()
    {

        return "{$this->lawsuit->name} Stade: ".$this->stadenames[$this->name];
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
                            $next = $i + 1;
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
                            $next = $i + 1;
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
            }
        });
    }

}
