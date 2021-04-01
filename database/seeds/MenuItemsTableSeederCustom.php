<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeederCustom extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (file_exists(base_path('routes/web.php'))) {
            require base_path('routes/web.php');

            /*
            |--------------------------------------------------------------------------
            | Admin Menu
            |--------------------------------------------------------------------------
            */

            $menu = Menu::where('name', 'admin')->firstOrFail();

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => __('voyager::seeders.menu_items.dashboard'),
                'url'     => '',
                'route'   => 'voyager.dashboard',
            ]);
            if ($menuItem->exists) {
                $menuItem->fill([
                    'icon_class' => 'voyager-dashboard',
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Permissions',
                'url'     => '',
                'route'   => 'voyager.permissions.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-key',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 5,
            ])->save();
            
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Contacts',
                'url'     => '',
                'route'   => 'voyager.contacts.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-people',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 6,
            ])->save();
            
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Affaires',
                'url'     => '',
                'route'   => 'voyager.affaires.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-folder',
                'color'      => '#000000',
                'parent_id'  => null,
                'order'      => 7,
            ])->save();
            
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Stades',
                'url'     => '',
                'route'   => 'voyager.stades.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-archive',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 8,
            ])->save();
            
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Pièces Jointes',
                'url'     => '',
                'route'   => 'voyager.pieces-jointes.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-paperclip',
                'color'      => '#000000',
                'parent_id'  => null,
                'order'      => 9,
            ])->save();

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Calendrier',
                'url'     => '',
                'route'   => 'voyager.calendar.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-calendar',
                'color'      => '#000000',
                'parent_id'  => null,
                'order'      => 2,
            ])->save();

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Factures',
                'url'     => '',
                'route'   => 'voyager.factures.index',
            ]);

            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => '#000000',
                'parent_id'  => null,
                'order'      => 10,
            ])->save();

            $menuItemFacturation = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Facturation',
                'url'     => '',
                'route'   => null,
            ]);

            $menuItemFacturation->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-logbook',
                'color'      => '#000000',
                'parent_id'  => null,
                'order'      => 11,
            ])->save();
     
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Conventions',
                'url'     => '',
                'route'   => 'voyager.conventions.index',
            ]);
                
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => '#000000',
                'parent_id'  => $menuItemFacturation->id,
                'order'      => 1,                  
            ])->save();
     
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Honoraires',
                'url'     => '',
                'route'   => 'voyager.honoraires.index',
            ]);
                
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-dollar',
                'color'      => '#000000',
                'parent_id'  => $menuItemFacturation->id,
                'order'      => 2,                  
            ])->save();
     
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'Modalités',
                'url'     => '',
                'route'   => 'voyager.modalites.index',
            ]);
                
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-params',
                'color'      => '#000000',
                'parent_id'  => $menuItemFacturation->id,
                'order'      => 3,                  
            ])->save();
        }
    }
}
