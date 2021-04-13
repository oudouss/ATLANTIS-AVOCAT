<?php

namespace App\Widgets;

use App\Billing;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Widgets\BaseDimmer;

class BillingDimmer extends BaseDimmer
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
        $Billing = new Billing;
        if (Auth::user()->can('edit', $Billing)) {
            $countnonpayees = Billing::whereNull('paid_at')->count();
            $count = Billing::count();
        } else {
            $countnonpayees = Billing::whereIn('lawsuit_id', Auth::user()->lawsuits->pluck('id'))
                                ->whereNull('paid_at')
                                ->count();
            $count = Billing::whereIn('lawsuit_id', Auth::user()->lawsuits->pluck('id'))->count();
        }

        $string = 'Factures';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon' => 'voyager-archive',
            'title' => "{$count} {$string}",
            'text' => "Vous avez $countnonpayees factures non payées.",
            'button' => [
                'text' => 'Voir toutes les factures',
                'link' => route('voyager.factures.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        $Billing = new \App\Billing;
        return Auth::user()->can('browse', $Billing);
    }
}
