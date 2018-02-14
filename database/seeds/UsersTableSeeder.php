<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $admin = new User();
        $admin->first_name = 'Juan';
        $admin->last_name = 'Dela Cruz';
        $admin->username = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin');
        $admin->is_verified = true;
        $admin->save();
        $admin->roles()->attach($role_admin);

        $role_practicum = Role::where('name', 'Practicum')->first();
        $practicum = new User();
        $practicum->first_name = 'Lai';
        $practicum->last_name = 'Calma';
        $practicum->username = 'practicum';
        $practicum->email = 'lai@lai.com';
        $practicum->password = bcrypt('practicum');
        $practicum->is_verified = true;
        $practicum->save();
        $practicum->roles()->attach($role_practicum);

    }
}
