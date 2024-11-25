<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Crea permessi
        Permission::create(['name' => 'manage_patients']);
        Permission::create(['name' => 'view_patients']);
        Permission::create(['name' => 'manage_admissions']);
        Permission::create(['name' => 'view_admissions']);

        // Crea ruoli e assegna permessi
        $admin = Role::create(['name' => 'admin']);
        $doctor = Role::create(['name' => 'doctor']);
        $nurse = Role::create(['name' => 'nurse']);

        $admin->givePermissionTo(['manage_patients', 'manage_admissions', 'view_patients', 'view_admissions']);
        $doctor->givePermissionTo(['manage_patients', 'view_patients']);
        $nurse->givePermissionTo(['view_patients', 'view_admissions']);
    }
}
