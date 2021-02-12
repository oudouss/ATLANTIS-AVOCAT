<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Widgets\BaseDimmer;

class ContactDimmer extends BaseDimmer
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
        $countClient = \App\Contact::where('category', 'option2')->count();
        $count = \App\Contact::count();
        $string = 'Contacts';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-people',
            'title'  => "{$count} {$string}",
            'text'   => "Vous avez $countClient clients enregistrés.",
            'button' => [
                'text' => 'Voir tous les contacts',
                'link' => route('voyager.contacts.index'),
            ],
            'image' => 'img/offer_img_2.png',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        $Contact = new \App\Contact;
        return Auth::user()->can('browse', $Contact);
    }
}
