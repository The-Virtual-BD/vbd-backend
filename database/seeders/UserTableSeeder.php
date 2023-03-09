<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@app.com',
            'birth_date' => Carbon::parse('12-12-2000'),
            'profession' => 'Web Developer',
            'phone' => '01789456123',
            'nationality' => 'Bangladeshi',
            'password' => Hash::make('admin123'),
            'status' => 2
        ]);

        $role = Role::where('name','admin')->first();
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
