<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Internal\Role;
use App\Models\Internal\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $viewerRole = Role::create(['name' => 'Viewer']);
        $editorRole = Role::create(['name' => 'Editor']);

        $adminPermissions = [
            'edit_everything',
        ];
        $viewerPermissions = [];
        $editorPermissions = [
            'edit_products',
            'edit_product_categories',
        ];

        foreach ($adminPermissions as $permission) {
            $adminRole->permissions()->create(['name' => $permission]);
        }

        foreach ($viewerPermissions as $permission) {
            $viewerRole->permissions()->create(['name' => $permission]);
        }

        foreach ($editorPermissions as $permission) {
            $editorRole->permissions()->create(['name' => $permission]);
        }
    }
}
