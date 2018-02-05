<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
        $role1->name = 'Admin';
        $role1->save();

        $role2 = new Role();
        $role2->name = 'Practicum';
        $role2->save();

        $role3 = new Role();
        $role3->name = 'Student';
        $role3->save();

        $role4 = new Role();
        $role4->name = 'Company';
        $role4->save();
    }
}
