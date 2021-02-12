<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];


    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function users()
    {
      return $this->belongsToMany('App\User');
    }


}
