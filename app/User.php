<?php

namespace App;

use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lawsuits()
    {
        return $this->belongsToMany('App\Lawsuit');
    }

    public function sharedevents()
    {
        return $this->belongsToMany('App\Event');
    }
    
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function scopeClient($query)
    {
        $role = Role::where('name', 'Client')->firstOrFail();
        
        return $query->where('role_id', $role->id);
    }
    
    public function scopeAccess($query)
    {
        $roleAdmin = Role::where('name', 'Admin')->firstOrFail();
        $roleClient = Role::where('name', 'Client')->firstOrFail();
        $roleComptable = Role::where('name', 'Comptable')->firstOrFail();
        $rolesCabinet = Role::where('name', 'Avocat')->orWhere('name', 'Cabinet')->pluck('id')->toArray();
        
        if (in_array(Auth::user()->role_id, $rolesCabinet)) {
            $rolesAcc = Role::where('name', 'Avocat')->orWhere('name', 'Cabinet')->orWhere('name', 'Client')
            ->orWhere('name', 'Comptable')->orWhere('name', 'Expert')->orWhere('name', 'Huissier')->pluck('id')->toArray();
            return $query->whereIn('role_id', $rolesAcc);

        }elseif((Auth::user()->role_id == $roleClient->id) || (Auth::user()->role_id == $roleComptable->id)){
            $rolesAcc = Role::where('name', 'Avocat')->pluck('id')->toArray();
            return $query->whereIn('role_id', $rolesAcc);

        }elseif(Auth::user()->role_id == $roleAdmin->id){
            return $query;
        }

    }
}
