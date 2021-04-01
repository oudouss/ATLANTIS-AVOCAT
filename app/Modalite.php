<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modalite extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'modalites';
    
    protected $guarded = [];

    public function convention()
    {
        return $this->belongsTo('App\Convention', 'convention_id', 'id');
    }

}
