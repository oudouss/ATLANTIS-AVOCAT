<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawsuitModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    public $table = 'lawsuit_models';

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }
    public function stades()
    {
        return $this->hasMany('App\ModelStade','id','model_id');
    }
    public function lawsuits()
    {
        return $this->hasMany('App\Lawsuit','id','model_id');
    }
}
