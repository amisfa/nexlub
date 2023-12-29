<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'block-users', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'user-payments', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'user-withdraws', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'user-subsets', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'tickets', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'payments', 'guard_name' => config('auth.defaults.guard')]);
        Permission::create(['name' => 'withdraws', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole = Role::create(['name' => 'Administrator', 'guard_name' => config('auth.defaults.guard')]);
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole->givePermissionTo([
            'view-users',
            'block-users',
            'user-payments',
            'user-withdraws',
            'user-subsets',
            'tickets',
            'payments',
            'withdraws'
        ]);
        $adminRole->givePermissionTo([
            'view-users',
            'payment-users',
            'withdraw-users',
            'user-subsets',
            'payments',
            'withdraws'
        ]);
    }
}
