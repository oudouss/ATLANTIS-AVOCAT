<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachement extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'lawsuit_id', 'stade_id', 'url',
    ];
    public function stade()
    {
        return $this->belongsTo('App\Stade');
    }

    public function lawsuit()
    {
        return $this->belongsTo('App\Lawsuit');
    }

    public function scopeMyAttachements($query)
    {
        $Attachement = new Attachement();
        if (Auth::user()->can('edit', $Attachement)) {
            return $query;
        } else {
            return $query->whereIn('lawsuit_id', Auth::user()->lawsuits->pluck('id'));
        }
    }
}
