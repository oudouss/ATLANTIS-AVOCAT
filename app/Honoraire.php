<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Honoraire extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'honoraires';
    
    protected $guarded = [];

    public function convention()
    {
        return $this->belongsTo('App\Convention', 'convention_id', 'id');
    }
}
