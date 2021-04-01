<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convention extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'conventions';
    
    protected $guarded = [];

    public function honoraires()
    {
        return $this->hasMany('App\Honoraire');
    }
    public function modalites()
    {
        return $this->hasMany('App\Modalite');
    }
    public function lawsuits()
    {
        return $this->hasMany('App\Lawsuit');
    }
    public function scopePercent($query)
    {
        return $query->where('type',0)->whereNull('deleted_at');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($convention) {
            $convention->honoraires()->delete();
            $convention->modalites()->delete();
        });
        static::restoring(function ($lawsuit) {
            $convention->honoraires()->withTrashed()->restore();
            $convention->modalites()->withTrashed()->restore();
        });

    }
}
