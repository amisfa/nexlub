<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'block-users', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole = Role::create(['name' => 'Administrator', 'guard_name' => config('auth.defaults.guard')]);
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole->givePermissionTo([
            'view-users',
            'block-users'
        ]);
        $adminRole->givePermissionTo([
            'view-users',
        ]);
    }
}
