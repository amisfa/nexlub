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
        Permission::create(['name' => 'determine_access', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'payment-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'withdraw-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'subset-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'tickets', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'email-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'payments', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'withdraw', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole = Role::create(['name' => 'Administrator', 'guard_name' => config('auth.defaults.guard')]);
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole->givePermissionTo([
            'view-users',
            'block-users',
            'determine_access',
            'payment-users',
            'withdraw-users',
            'subset-users',
            'tickets',
            'email-users',
            'payments',
            'withdraw'
        ]);
        $adminRole->givePermissionTo([
            'view-users',
            'determine_access',
            'payment-users',
            'withdraw-users',
            'subset-users',
            'payments',
            'withdraw'
        ]);
    }
}
