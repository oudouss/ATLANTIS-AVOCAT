<?php

use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeederCustom extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'Admin')->firstOrFail();

            User::create([
                'name'           => 'Administrateur',
                'email'          => 'admin@cabinetzaoui.ma',
                'password'       => bcrypt(config('voyager.adminPassword')),
                'avatar'         => 'users/September2020/MDnzvodhllJcfJ2VZleH.png',
                'locale'         => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Avocat')->firstOrFail();

            User::create([
                'name'           => 'Maître Avocat',
                'email'          => 'avocat@cabinetzaoui.ma',
                'avatar'         => 'users/September2020/11KFtdBU0w2iokAUr7xr.png',
                'password'       => bcrypt('password2021**'),
                'locale'         => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Cabinet')->firstOrFail();

            User::create([
                'name'           => 'Collaborateur 1',
                'email'          => 'col1@cabinetzaoui.ma',
                'avatar'         => 'users/September2020/11KFtdBU0w2iokAUr7xr.png',
                'password'       => bcrypt('password2021**'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);

            User::create([
                'name'           => 'Collaborateur 2',
                'email'          => 'col2@cabinetzaoui.ma',
                'avatar'         => 'users/defaultAvatar.png',
                'password'       => bcrypt('password2021**'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Client')->firstOrFail();

            User::create([
                'name'           => 'Client Test',
                'email'          => 'client-test@cabinetzaoui.ma',
                'avatar'         => 'users/September2020/XhlcbhGlETcrwpTXkShF.png',
                'password'       => bcrypt('password2021**'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);
            $role = Role::where('name', 'Comptable')->firstOrFail();

            User::create([
                'name'           => 'Comptable',
                'email'          => 'Comptable@cabinetzaoui.ma',
                'avatar'         => 'users/September2020/XhlcbhGlETcrwpTXkShF.png',
                'password'       => bcrypt('password2021**'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);
            //TODO:ADD useCases & permissions
            // $role = Role::where('name', 'Huissier')->firstOrFail();

            // User::create([
            //     'name'           => 'Huissier 1',
            //     'email'          => 'huissier1@cabinetzaoui.ma',
            //     'avatar'         => 'users/September2020/XhlcbhGlETcrwpTXkShF.png',
            //     'password'       => bcrypt('password2021**'),
            //     'locale'       => 'fr',
            //     'role_id'        => $role->id,
            // ]);

            // $role = Role::where('name', 'Expert')->firstOrFail();

            // User::create([
            //     'name'           => 'Expert',
            //     'email'          => 'expert@cabinetzaoui.ma',
            //     'avatar'         => 'users/September2020/XhlcbhGlETcrwpTXkShF.png',
            //     'password'       => bcrypt('password2021**'),
            //     'locale'       => 'fr',
            //     'role_id'        => $role->id,
            // ]);

        }


    }
}
