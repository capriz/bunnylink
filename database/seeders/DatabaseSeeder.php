<?php

namespace Database\Seeders;

use App\Models\User;
use Silber\Bouncer\Bouncer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param \Silber\Bouncer\Bouncer $bouncer
     * @return void
     */
    public function run(Bouncer $bouncer)
    {
        // \App\Models\User::factory(10)->create();
        //Initialize Default User
        $user_model = User::create([
            'name'     => 'user',
            'email'    => 'renier.trenuela@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user       = $bouncer->role()->firstOrCreate([
            'name'  => 'user',
            'title' => 'User',
        ]);
        $bouncer->assign($user)->to($user_model);

        // Initialized Admin
        $admin_model = User::create([
            'name'     => 'admin',
            'email'    => 'admin@site.com',
            'password' => Hash::make('password'),
        ]);

        $admin       = $bouncer->role()->firstOrCreate([
            'name'  => 'admin',
            'title' => 'Administrator',
        ]);
        $bouncer->assign($admin)->to($admin_model);

        $manage_users = $bouncer->ability()->firstOrCreate([
            'name'  => 'manage-users',
            'title' => 'Manage Users',
        ]);
        $bouncer->allow($admin)->to($manage_users);

        $users = $bouncer->ability()->firstOrCreate([
            'name'  => 'users',
            'title' => 'Users',
        ]);
        $bouncer->allow($admin)->to($users);

        $roles = $bouncer->ability()->firstOrCreate([
            'name'  => 'roles',
            'title' => 'Roles',
        ]);
        $bouncer->allow($admin)->to($roles);
    }
}
