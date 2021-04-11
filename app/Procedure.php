<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'procedures';
    protected $guarded = [];
    
    public function lawsuits()
    {
        return $this->hasMany('App\Lawsuit');
    }
    public function conventions()
    {
        return $this->hasMany('App\Convention');
    }
    public function models()
    {
        return $this->hasMany('App\LawsuitModel', 'id', 'model_id');
    }

}
