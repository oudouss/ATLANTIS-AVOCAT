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
                    ]);
                });
                $role->permissions()->sync($permissionsFiltered->pluck('id')->all());
            } elseif ($role_name == 'Avocat') {
                $permissionsFiltered = $permissions->filter(function ($permission, $key) {
                    return in_array($permission->key, [
                        'browse_admin',
                        'browse_users',
                        'read_users',
                        'edit_users',
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
                        'edit_stades',
                        'add_stades',
                        'delete_stades',
                        'read_attachements',
                        'edit_attachements',
                        'add_attachements',
                        'delete_attachements',
                        'delete_events',
                        'browse_events',
                        'read_events',
                        'edit_events',
                        'add_events',
                        'delete_events',
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
