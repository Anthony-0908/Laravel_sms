<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        // Create permissions
        $permissions = [
            'create post',
            'edit post',
            'delete post',
            'view post',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());

        // Assign only specific permissions to user
        $userRole->syncPermissions([
            'view post',
        ]);
    }
}
