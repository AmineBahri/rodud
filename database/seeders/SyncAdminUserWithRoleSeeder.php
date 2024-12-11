<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SyncAdminUserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create demo users
        $role1 = Role::where('name','admin')->first();
        $user = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole($role1);
        $role2 = Role::where('name','user')->first();
        $user2 = User::query()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('123456')
        ]);
        $user2->assignRole($role2);
    }
}
