<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $blogger = Role::create(['name' => 'blogger']);

        $permissions = Permission::pluck('id', 'id')->all();

        $admin->syncPermissions($permissions);
        $user->syncPermissions($permissions);
        $blogger->syncPermissions($permissions);
    }
}
