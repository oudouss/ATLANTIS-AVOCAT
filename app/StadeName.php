<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StadeName extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'stade_names';
    protected $guarded = [];

    public function stades() {
        return $this->hasMany('App\Stade', 'id', 'stade_name_id');
    }
    public function modalites() {
        return $this->hasMany('App\Modalite', 'id', 'stade_name_id');
    }
    // public function currents() {
    //     return $this->hasMany('App\ModelStade', 'id', 'current_id');
    // }
    // public function prevs() {
    //     return $this->hasMany('App\ModelStade', 'id', 'previous_id');
    // }
    // public function nexts() {
    //     return $this->hasMany('App\ModelStade', 'id', 'next_id');
    // }

}
