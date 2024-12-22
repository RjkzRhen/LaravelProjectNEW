<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Role_ADMIN')->first();

        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'Role_ADMIN']);
        }

        $admin = User::where('username', 'admin')->first();

        if (!$admin) {
            $admin = User::create([
                'last_name' => 'Admin',
                'first_name' => 'Admin',
                'middle_name' => 'Admin',
                'age' => 30,
                'username' => 'admin',
                'password' => Hash::make('password'),
            ]);
        }

        if (!$admin->roles->contains($adminRole->id)) {
            $admin->roles()->attach($adminRole);
        }
    }
}
