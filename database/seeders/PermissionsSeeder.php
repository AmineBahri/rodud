<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create permissions
        Permission::query()->updateOrCreate(['name' => 'view-orders']);
        Permission::query()->updateOrCreate(['name' => 'create-orders']);
        Permission::query()->updateOrCreate(['name' => 'edit-orders']);
        Permission::query()->updateOrCreate(['name' => 'delete-orders']);
        Permission::query()->updateOrCreate(['name' => 'view-users']);
        Permission::query()->updateOrCreate(['name' => 'edit-users']);
    }
}
