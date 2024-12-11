<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles
        $role1 = Role::query()->updateOrCreate(['name' => 'admin']);
        $permissions1 = Permission::query()->get()->pluck('name');
        $role1->syncPermissions($permissions1);
        $role2 = Role::query()->updateOrCreate(['name' => 'user']);
        $permissions2 = Permission::query()->where('name' ,'like', "%orders")->get()->pluck('name');
        $role2->syncPermissions($permissions2);
    }
}
