<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeederCustom extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        $role_names = [
            'Client',
            'Avocat',
            'Cabinet',
            'Comptable',
        ];

        foreach ($role_names as $role_name) {
            $role = Role::where('name', $role_name)->firstOrFail();
            $permissions = Permission::all();

            if ($role_name == 'Client') {
                $permissionsFiltered = $permissions->filter(function ($permission, $key) {
                    return in_array($permission->key, [
                        'browse_admin',
                        'browse_lawsuits',
                        'read_lawsuits',
                        'read_stades',
                        'read_attachements',
                        'browse_events',
                        'read_events',
                        'edit_events',
                        'add_events',
                        'delete_events',
                        'browse_billings',
                        'read_billings',
                    ]);
                });
                $role->permissions()->sync($permissionsFiltered->pluck('id')->all());
            } elseif ($role_name == 'Avocat') {
                $permissionsFiltered = $permissions->filter(function ($permission, $key) {
                    return in_array($permission->key, [
                        'browse_admin',
                        'browse_users',
                        'read_users',
                        'add_users',
                        'browse_contacts',
                        'read_contacts',
                        'edit_contacts',
                        'add_contacts',
                        'delete_contacts',
                        'browse_lawsuits',
                        'read_lawsuits',
                        'edit_lawsuits',
                        'add_lawsuits',
                        'delete_lawsuits',
                        'read_stades',
                        'browse_stades',
                        'edit_stades',
                        'add_stades',
                        'delete_stades',
                        'browse_attachements',
                        'read_attachements',
                        'edit_attachements',
                        'add_attachements',
                        'delete_attachements',
                        'browse_events',
                        'read_events',
                        'edit_events',
                        'add_events',
                        'delete_events',
                        'browse_billings',
                        'read_billings',
                        'edit_billings',
                        'add_billings',
                        'delete_billings',
                        'browse_conventions',
                        'read_conventions',
                        'edit_conventions',
                        'add_conventions',
                        'delete_conventions',
                        'browse_honoraires',
                        'read_honoraires',
                        'edit_honoraires',
                        'add_honoraires',
                        'delete_honoraires',
                        'browse_modalites',
                        'read_modalites',
                        'edit_modalites',
                        'add_modalites',
                        'delete_modalites',
                    ]);
                });
                $role->permissions()->sync($permissionsFiltered->pluck('id')->all());
            } elseif ($role_name == 'Cabinet') {
                $permissionsFiltered = $permissions->filter(function ($permission, $key) {
                    return in_array($permission->key, [
                        'browse_admin',
                        'browse_contacts',
                        'read_contacts',
                        'edit_contacts',
                        'add_contacts',
                        'browse_lawsuits',
                        'read_lawsuits',
                        'edit_lawsuits',
                        'add_lawsuits',
                        'read_stades',
                        'edit_stades',
                        'add_stades',
                        'read_attachements',
                        'edit_attachements',
                        'add_attachements',
                        'browse_events',
                        'read_events',
                        'edit_events',
                        'add_events',
                        'delete_events',
                        'browse_billings',
                        'read_billings',
                        'add_billings',
                    ]);
                });
                $role->permissions()->sync($permissionsFiltered->pluck('id')->all());
            } elseif ($role_name == 'Comptable') {
                $permissionsFiltered = $permissions->filter(function ($permission, $key) {
                    return in_array($permission->key, [
                        'browse_admin',
                        'browse_lawsuits',
                        'read_lawsuits',
                        'browse_events',
                        'read_events',
                        'edit_events',
                        'add_events',
                        'delete_events',
                        'browse_billings',
                        'read_billings',
                        'edit_billings',
                        'add_billings',
                        'browse_conventions',
                        'read_conventions',
                        'edit_conventions',
                        'add_conventions',
                        'browse_honoraires',
                        'read_honoraires',
                        'edit_honoraires',
                        'add_honoraires',
                        'browse_honoraires',
                        'read_modalites',
                        'edit_modalites',
                        'add_modalites',
                    ]);
                });
                $role->permissions()->sync($permissionsFiltered->pluck('id')->all());
            }

        }
                
        $role = Role::where('name', 'Admin')->firstOrFail();
        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
    
}
