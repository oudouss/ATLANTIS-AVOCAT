<?php

namespace App\Widgets;

use App\Stade;
use TCG\Voyager\Widgets\BaseDimmer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StadeDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $Stade = new Stade;
        if (Auth::user()->can('edit', $Stade)) {
            $countencours = Stade::where('state', '0')->count();
            $count = Stade::count();
        } else {
            $countencours = Stade::whereIn('lawsuit_id', Auth::user()->lawsuits->pluck('id'))
                                  ->where('state', '0')
                                  ->count();
            $count = Stade::whereIn('lawsuit_id', Auth::user()->lawsuits->pluck('id'))->count();
        }

        $string = 'Stades';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-archive',
            'title'  => "{$count} {$string}",
            'text'   => "Vous avez $countencours stades en-cours.",
            'button' => [
                'text' => 'Voir tous les stades',
                'link' => route('voyager.stades.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        $Stade = new \App\Stade;
        return Auth::user()->can('browse', $Stade);
    }
}
