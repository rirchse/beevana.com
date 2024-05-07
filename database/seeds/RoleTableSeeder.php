<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
	    $role_employee->name = 'SuperAdmin';
	    $role_employee->description = 'Developer';
	    $role_employee->save();

	    $role_manager = new Role();
	    $role_manager->name = 'Admin';
	    $role_manager->description = 'A Manager User';
	    $role_manager->save();

        $role_editor = new Role();
        $role_editor->name = 'Editor';
        $role_editor->description = 'A Editor User';
        $role_editor->save();
    }
}
