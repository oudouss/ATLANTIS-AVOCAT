<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelStade extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'model_stades';
    protected $guarded = [];

    public function model()
    {
        return $this->belongsTo('App\LawsuitModel', 'model_id', 'id');
    }
    public function current()
    {
        return $this->belongsTo('App\StadeName', 'current_id', 'id');
    }
    public function previous()
    {
        return $this->belongsTo('App\StadeName', 'previous_id', 'id');
    }
    public function next()
    {
        return $this->belongsTo('App\StadeName', 'next_id', 'id');
    }

}
