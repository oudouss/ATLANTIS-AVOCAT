<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $guarded = [];
  public $table = 'events';


  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function users()
  {
    return $this->belongsToMany('App\User');
  }
  public function lawsuit()
  {
      return $this->belongsTo('App\Lawsuit');
  }

  public function scopeCurrentUser($query)
  {
    $myEvent = Auth::user()->events;
    $eventShared = Auth::user()->sharedevents;
    if ($eventShared->isNotEmpty()) {
      $myEvent = $myEvent->merge($eventShared);
      $myEvent->all();
    }
    return $query->whereIn('id', $myEvent->pluck('id'));
  }
}
