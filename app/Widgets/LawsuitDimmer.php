<?php

namespace App\Widgets;

use App\Lawsuit;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use Illuminate\Support\Facades\Auth;

class LawsuitDimmer extends BaseDimmer
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
        $Lawsuit = new Lawsuit;
        if (Auth::user()->can('edit', $Lawsuit)) {
            $countencours = Lawsuit::where('state', 'option1')->count();
            $count = Lawsuit::count();
        } else {
            $countencours = Lawsuit::whereIn('id', Auth::user()->lawsuits->pluck('id'))
                ->where('state', 'option1')
                ->count();
            $count = Lawsuit::whereIn('id', Auth::user()->lawsuits->pluck('id'))->count();
        }
        
        $string = 'Affaires';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-folder',
            'title'  => "{$count} {$string}",
            'text'   => "Vous avez $countencours affaires en-cours.",
            'button' => [
                'text' => 'Voir toutes les affaires',
                'link' => route('voyager.affaires.index'),
            ],
            'image' => 'img/offer_img_1.png',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        $Lawsuit = new \App\Lawsuit;
        return Auth::user()->can('browse' , $Lawsuit);
    }
}
