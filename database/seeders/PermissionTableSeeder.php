<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin permission store
        foreach (permissions('admin') as $permission) {
            Permission::create(['name' => $permission]);
        }

        // user permission store
        foreach (permissions('user') as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
