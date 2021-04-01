<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Lawsuit extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

    public function getNameAttribute()
    {
        return "Affaire {$this->caseNum}: {$this->client->name} contre {$this->opponent->name}";
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
            $stades_start = 0;
            $stades_end = 0;
            $c = '#22A7F0';
         
            $stadenames = [
                "option1" => "A0: Acceptation Dossier (M.E.D)",
                "option2" => "A1: Audience",
                "option3" => "A2: Notification et Exécution CI",
                "option4" => "A3: Expertise Comptable",
                "option5" => "A4: Jugement A.D.D",
                "option6" => "A5: Jugement DEFINITIF",
                "option7" => "A6: Demande Notification et Execution (F.C)",
                "option8" => "A7: Adjudication",
                "option9" => "B0: Acceptation Dossier",
                "option10" => "B1: Mise en demeure (art 114 CC)",
                "option11" => "B2: Notification",
                "option12" => "B3: Procédure Curateur",
                "option13" => "B4: Saisine du juge",
                "option14" => "B5: Expertise Mobilière",
                "option15" => "B7: Vente (F.C)",
                "option16" => "C0: Acceptation Dossier",
                "option17" => "C1: Dépôt CI",
                "option18" => "C2: Notification et Exécution CI",
                "option19" => "C3: Procédure Curateur",
                "option20" => "C4: Publications CI",
                "option21" => "C5: Expertise Immobilière",
                "option22" => "C6: Rapport Expertise Immobilière",
                "option23" => "C7: Vente Immobilière",
            ];

            $deadlines = [
                "option1"   => Carbon::parse($lawsuit->acceptation)->toDateString() . ' ' . date('H:i:s'),
                "option2"   => Carbon::parse($lawsuit->acceptation)->addDays(15)->toDateString() . ' ' . date('H:i:s'),
                "option3"   => Carbon::parse($lawsuit->acceptation)->addDays(45)->toDateString() . ' ' . date('H:i:s'),
                "option4"   => Carbon::parse($lawsuit->acceptation)->addDays(60)->toDateString() . ' ' . date('H:i:s'),
                "option5"   => Carbon::parse($lawsuit->acceptation)->addDays(90)->toDateString() . ' ' . date('H:i:s'),
                "option6"   => Carbon::parse($lawsuit->acceptation)->addDays(90)->toDateString() . ' ' . date('H:i:s'),
                "option7"   => Carbon::parse($lawsuit->acceptation)->addDays(120)->toDateString() . ' ' . date('H:i:s'),
                "option8"   => Carbon::parse($lawsuit->acceptation)->addDays(140)->toDateString() . ' ' . date('H:i:s'),
                "option9"   => Carbon::parse($lawsuit->acceptation)->toDateString() . ' ' . date('H:i:s'),
                "option10"  => Carbon::parse($lawsuit->acceptation)->addDays(15)->toDateString() . ' ' . date('H:i:s'),
                "option11"  => Carbon::parse($lawsuit->acceptation)->addDays(45)->toDateString() . ' ' . date('H:i:s'),
                "option12"  => Carbon::parse($lawsuit->acceptation)->addDays(100)->toDateString() . ' ' . date('H:i:s'),
                "option13"  => Carbon::parse($lawsuit->acceptation)->addDays(87)->toDateString() . ' ' . date('H:i:s'),
                "option14"  => Carbon::parse($lawsuit->acceptation)->addDays(117)->toDateString() . ' ' . date('H:i:s'),
                "option15"  => Carbon::parse($lawsuit->acceptation)->addDays(150)->toDateString() . ' ' . date('H:i:s'),
                "option16"  => Carbon::parse($lawsuit->acceptation)->toDateString() . ' ' . date('H:i:s'),
                "option17"  => Carbon::parse($lawsuit->acceptation)->addDays(15)->toDateString() . ' ' . date('H:i:s'),
                "option18"  => Carbon::parse($lawsuit->acceptation)->addDays(45)->toDateString() . ' ' . date('H:i:s'),
                "option19"  => Carbon::parse($lawsuit->acceptation)->addDays(150)->toDateString() . ' ' . date('H:i:s'),
                "option20"  => Carbon::parse($lawsuit->acceptation)->addDays(87)->toDateString() . ' ' . date('H:i:s'),
                "option21"  => Carbon::parse($lawsuit->acceptation)->addDays(117)->toDateString() . ' ' . date('H:i:s'),
                "option22"  => Carbon::parse($lawsuit->acceptation)->addDays(147)->toDateString() . ' ' . date('H:i:s'),
                "option23"  => Carbon::parse($lawsuit->acceptation)->addDays(180)->toDateString() . ' ' . date('H:i:s'),
            ];

            // Assignation (stades names:option2=>option8)
            if ($lawsuit->procedure == 'option1') {
                $lawsuit->stades()->create([
                    'name' => 'option1',
                    'date' => $lawsuit->acceptation,
                    'state' => 0,
                ]);
                $stades_start = 2; $stades_end = 8; $c = '#F4A62A';

            }
            // Nantissement F.C (stades names:option10=>option15)
            elseif($lawsuit->procedure == 'option4') {
                $lawsuit->stades()->create([
                    'name' => 'option9',
                    'date' => $lawsuit->acceptation,
                    'state' => 0,
                    ]);
                $stades_start = 10; $stades_end = 15; $c = '#43D17F';

            }
            // Commandement Immobilier (stades names:option16=>option23)
            elseif($lawsuit->procedure == 'option2') {
                $lawsuit->stades()->create([
                    'name' => 'option16',
                    'date' => $lawsuit->acceptation,
                    'state' => 0,
                ]);
                $stades_start = 17; $stades_end = 23; $c = '#f02424';


            }
            if ( $stades_start != 0 && $stades_end != 0 ) {
                
                $roleAdmin = Role::where('name', 'Admin')->firstOrFail();
                $roleAvocat = Role::where('name', 'Avocat')->firstOrFail();
                $roleCabinet = Role::where('name', 'Cabinet')->firstOrFail();
                $adminUser = User::where('role_id', $roleAdmin->id)->firstOrFail();
                $RoleUsers = User::where('role_id', $roleAvocat->id)->orWhere('role_id', $roleCabinet->id)->get();
                $eventIds = collect([]);
                
                for ($i = $stades_start; $i < $stades_end + 1; $i++) {
                    $event = Event::create([
                        'title' => 'Date Limite - ' . $stadenames['option' . $i] . ' - ' . $lawsuit->name,
                        'start_date' => $deadlines['option' . $i],
                        'end_date' => Carbon::parse($deadlines['option' . $i])->addHour()->toDateTimeString(),
                        'background_color' => $c,
                        'user_id' => $adminUser->id,
                        'lawsuit_id'=> $lawsuit->id,
                    ]);
                    $eventIds->push($event->id);
                }

                foreach ($RoleUsers as $RoleUser) {
                    $RoleUser->sharedevents()->syncWithoutDetaching($eventIds->all());
                }

            }            
        });
        static::updated(function ($lawsuit){
            $stadesList = $lawsuit->stades()->pluck('name')->toArray();
            $stadesListCount = $lawsuit->stades()->pluck('name')->count();
            if ($lawsuit->procedure=='option4' || $lawsuit->procedure == 'option2') {
                // Nantissement F.C
                if ($lawsuit->procedure=='option4'){
                    $stadeCurateur = 'option12';
                // Commandement Immobilier
                }elseif($lawsuit->procedure=='option2'){
                    $stadeCurateur='option19';
                }
                if ($lawsuit->curateur==1) {
                    if ($stadesListCount>=4) {
                        if (!in_array($stadeCurateur, $stadesList)) {
                            $lawsuit->stades()->create([
                                'name' => $stadeCurateur,
                                'date' => now(),
                                'state' => 0,
                            ]);
                        }
                    }
                }
            }
            // dd($stadesList, $stadesListCount, $lawsuit->convention->honoraires,$lawsuit->convention->modalites,$lawsuit->billings->pluck('item1')->toArray());
            
        });
        static::deleting(function ($lawsuit) {
            $lawsuit->events()->delete();
            $lawsuit->billings()->delete();
            $lawsuit->attachements()->delete();
            $lawsuit->stades()->delete();
        });
        static::restoring(function ($lawsuit) {
            $lawsuit->billings()->withTrashed()->restore();
            $lawsuit->stades()->withTrashed()->restore();
            $lawsuit->attachements()->withTrashed()->restore();
        });
    }
}
