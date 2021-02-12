<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'permissions');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'permissions',
                'display_name_singular' => 'Permission',
                'display_name_plural'   => 'Permissions',
                'icon'                  => 'voyager-key',
                'model_name'            => 'TCG\Voyager\Models\Permission',
                'policy_name'           => null,
                'controller'            => null,
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => null
                ],
            ])->save();
        }

        $dataType = $this->dataType('slug', 'contacts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'contacts',
                'display_name_singular' => 'Contact',
                'display_name_plural'   => 'Contacts',
                'icon'                  => 'voyager-people',
                'model_name'            => 'App\Contact',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => null,
                    "scope" => null,
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'affaires');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'lawsuits',
                'display_name_singular' => 'Affaire',
                'display_name_plural'   => 'Affaires',
                'icon'                  => 'voyager-folder',
                'model_name'            => 'App\Lawsuit',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => null,
                    "scope" => "currentUser",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'stades');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'stades',
                'display_name_singular' => 'Stade',
                'display_name_plural'   => 'Stades',
                'icon'                  => 'voyager-archive',
                'model_name'            => 'App\Stade',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => null,
                    "scope" => "myStades",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'pieces-jointes');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'attachements',
                'display_name_singular' => 'Pièce Jointe',
                'display_name_plural'   => 'Pièces Jointes',
                'icon'                  => 'voyager-paperclip',
                'model_name'            => 'App\Attachement',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => null,
                    "scope" => "myAttachements",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'calendar');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'events',
                'display_name_singular' => 'Événement',
                'display_name_plural'   => 'Calendrier',
                'icon'                  => 'voyager-calendar',
                'model_name'            => 'App\Event',
                'policy_name'           => null,
                'controller'            => null,
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 0,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => null,
                    "scope" => "currentUser",
                ],
            ])->save();
        }

    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}

