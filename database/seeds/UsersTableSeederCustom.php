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
                'email'          => 'admin@app.com',
                'password'       => bcrypt(config('voyager.adminPassword')),
                'avatar'         => 'users\defaultAvatar.png',
                'locale'         => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Avocat')->firstOrFail();

            User::create([
                'name'           => 'Maître Avocat',
                'email'          => 'avocat@app.com',
                'avatar'         => 'users\September2020\11KFtdBU0w2iokAUr7xr.png',
                'password'       => bcrypt('password'),
                'locale'         => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Cabinet')->firstOrFail();

            User::create([
                'name'           => 'Collaborateur 1',
                'email'          => 'col1@app.com',
                'avatar'         => 'users\September2020\11KFtdBU0w2iokAUr7xr.png',
                'password'       => bcrypt('password'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);

            User::create([
                'name'           => 'Collaborateur 2',
                'email'          => 'col2@app.com',
                'avatar'         => 'users\defaultAvatar.png',
                'password'       => bcrypt('password'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Client')->firstOrFail();

            User::create([
                'name'           => 'Client 1',
                'email'          => 'client1@app.com',
                'avatar'         => 'users\September2020\XhlcbhGlETcrwpTXkShF.png',
                'password'       => bcrypt('password'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Huissier')->firstOrFail();

            User::create([
                'name'           => 'Huissier 1',
                'email'          => 'huissier1@app.com',
                'avatar'         => 'users\September2020\XhlcbhGlETcrwpTXkShF.png',
                'password'       => bcrypt('password'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);

            $role = Role::where('name', 'Expert')->firstOrFail();

            User::create([
                'name'           => 'Expert 1',
                'email'          => 'expert1@app.com',
                'avatar'         => 'users\September2020\XhlcbhGlETcrwpTXkShF.png',
                'password'       => bcrypt('password'),
                'locale'       => 'fr',
                'role_id'        => $role->id,
            ]);
        }


    }
}
