<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'approve stores']);
        Permission::create(['name' => 'view all stores']);
        Permission::create(['name' => 'view all invoices']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'customer']);

        // or may be done by chaining


        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
