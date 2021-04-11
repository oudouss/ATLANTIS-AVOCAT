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
                    "default_search_key" => "name",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'affaires');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'lawsuits',
                'display_name_singular' => 'Affaire',
                'display_name_plural'   => 'Affaires',
                'icon'                  => 'voyager-hammer',
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
                    "default_search_key" => "opponent_id",
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
                'icon'                  => 'voyager-milestone',
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
                    "default_search_key" => "lawsuit_id",
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
                    "default_search_key" => "lawsuit_id",
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
                'policy_name'           => 'App\Policies\EventPolicy',
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
        $dataType = $this->dataType('slug', 'factures');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'billings',
                'display_name_singular' => 'Facture',
                'display_name_plural'   => 'Factures',
                'icon'                  => 'voyager-documentation',
                'model_name'            => 'App\Billing',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "lawsuit_id",
                    "scope" => "currentUser",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'conventions');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'conventions',
                'display_name_singular' => 'Convention',
                'display_name_plural'   => 'Conventions',
                'icon'                  => 'voyager-certificate',
                'model_name'            => 'App\Convention',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "name",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'honoraires');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'honoraires',
                'display_name_singular' => 'Honoraire',
                'display_name_plural'   => 'Honoraires',
                'icon'                  => 'voyager-dollar',
                'model_name'            => 'App\Honoraire',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "convention_id",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'modalites');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'modalites',
                'display_name_singular' => 'Modalité',
                'display_name_plural'   => 'Modalités',
                'icon'                  => 'voyager-logbook',
                'model_name'            => 'App\Modalite',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "convention_id",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'procedures');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'procedures',
                'display_name_singular' => 'Procédure',
                'display_name_plural'   => 'Procédures',
                'icon'                  => 'voyager-receipt',
                'model_name'            => 'App\Procedure',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "name",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'lawsuit-models');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'lawsuit_models',
                'display_name_singular' => 'Modèle de l\'Affaire',
                'display_name_plural'   => 'Modèles des Affaires',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'App\LawsuitModel',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "procedure_id",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'stade-names');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'stade_names',
                'display_name_singular' => 'Titre du Stade',
                'display_name_plural'   => 'Titres des Stades',
                'icon'                  => 'voyager-list',
                'model_name'            => 'App\StadeName',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "name",
                ],
            ])->save();
        }
        $dataType = $this->dataType('slug', 'model-stades');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'model_stades',
                'display_name_singular' => 'Stade du Modèle',
                'display_name_plural'   => 'Stades du Modèle',
                'icon'                  => 'voyager-list-add',
                'model_name'            => 'App\ModelStade',
                'policy_name'           => null,
                'controller'            => '\App\Http\Controllers\Voyager\BaseController',
                'description'           => null,
                'generate_permissions'  => 1,
                'server_side'           => 1,
                'details'               => [
                    "order_column" => null,
                    "order_display_column" => null,
                    "order_direction" => "asc",
                    "default_search_key" => "model_id",
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

