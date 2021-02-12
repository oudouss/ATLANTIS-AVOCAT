<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }
    public function lawsuits()
    {
        return $this->hasMany('App\Lawsuit');
    }

    public function scopeAdversaire($query)
    {
        return $query->where('category', 'option1');
    }
    public function scopeClient($query)
    {
        return $query->where('category', 'option2');
    }
}
