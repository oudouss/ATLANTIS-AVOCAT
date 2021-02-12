<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        Permission::generateFor('lawsuits');

        Permission::generateFor('stades');

        Permission::generateFor('attachements');

        Permission::generateFor('permissions');

        Permission::generateFor('contacts');
        
        Permission::generateFor('events');

        $tables = [
            'lawsuits',
            'stades',
            'attachements',
            'contacts',
        ];

        foreach ($tables as $table) {
            Permission::firstOrCreate([
                'key'        => 'deleted_'.$table,
                'table_name' => $table,
            ]);
        }
    }
}
