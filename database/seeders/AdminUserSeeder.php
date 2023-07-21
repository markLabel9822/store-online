<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Internal\User;
use App\Models\Internal\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->roles()->attach(Role::where('name', 'Admin')->first());

        $viewer = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => bcrypt('password'),
        ]);
        $viewer->roles()->attach(Role::where('name', 'Viewer')->first());

        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => bcrypt('password'),
        ]);
        $editor->roles()->attach(Role::where('name', 'Editor')->first());
    }
}
