<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User
        Permission::create([
            'code' => 'users.view',
            'name' => 'View users'
        ]);

        Permission::create([
            'code' => 'users.create',
            'name' => 'Create users'
        ]);

        Permission::create([
            'code' => 'users.update',
            'name' => 'Update users'
        ]);

        Permission::create([
            'code' => 'users.delete',
            'name' => 'Delete users'
        ]);

        // Group
        Permission::create([
            'code' => 'groups.view',
            'name' => 'View groups'
        ]);

        Permission::create([
            'code' => 'groups.create',
            'name' => 'Create groups'
        ]);

        Permission::create([
            'code' => 'groups.update',
            'name' => 'Update groups'
        ]);

        Permission::create([
            'code' => 'groups.delete',
            'name' => 'Delete groups'
        ]);
    }
}
