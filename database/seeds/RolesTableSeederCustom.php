  
<?php

use TCG\Voyager\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if ($role->exists) {
            $role->fill([
                'name' => 'Admin',
                'display_name' => 'Administrateur',
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'user']);
        if ($role->exists) {
            $role->fill([
                'name' => 'Client',
                'display_name' => 'Cabinet: Client',
                ])->save();
        }
        
        $role = Role::firstOrNew(['name' => 'Cabinet']);
        if (!$role->exists) {
            $role->fill([
                'name' => 'Cabinet',
                'display_name' => 'Cabinet: Collaborateur',
                'created_at' => now(),
                'updated_at' => now(),
            ])->save();
        }
        $role = Role::firstOrNew(['name' => 'Avocat']);
        if (!$role->exists) {
            $role->fill([
                'name' => 'Avocat',
                'display_name' => 'Cabinet: Avocat',
                'created_at' => now(),
                'updated_at' => now(),
            ])->save();
        }
        $role = Role::firstOrNew(['name' => 'Huissier']);
        if (!$role->exists) {
            $role->fill([
                'name' => 'Huissier',
                'display_name' => 'Services Extrajudiciaires: Huissier',
                'created_at' => now(),
                'updated_at' => now(),
            ])->save();
        }
        $role = Role::firstOrNew(['name' => 'Expert']);
        if (!$role->exists) {
            $role->fill([
                'name' => 'Expert',
                'display_name' => 'Services Extrajudiciaires: Expert',
                'created_at' => now(),
                'updated_at' => now(),
            ])->save();
        }
        $role = Role::firstOrNew(['name' => 'Comptable']);
        if (!$role->exists) {
            $role->fill([
                'name' => 'Comptable',
                'display_name' => 'Comptable',
                'created_at' => now(),
                'updated_at' => now(),
            ])->save();
        }

    }
}
