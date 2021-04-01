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
        
        Permission::generateFor('billings');
        
        Permission::generateFor('conventions');
        
        Permission::generateFor('honoraires');
        
        Permission::generateFor('modalites');

        $tables = [
            'lawsuits',
            'stades',
            'attachements',
            'contacts',
            'billings',
            'conventions',
            'honoraires',
            'modalites',
        ];

        foreach ($tables as $table) {
            Permission::firstOrCreate([
                'key'        => 'deleted_'.$table,
                'table_name' => $table,
            ]);
        }
    }
}
