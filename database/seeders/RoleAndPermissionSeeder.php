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
        Permission::create(['name' => 'administrator_access', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole = Role::create(['name' => 'Administrator', 'guard_name' => config('auth.defaults.guard')]);
        $administratorRole->givePermissionTo([
            'administrator_access',
        ]);
    }
}
