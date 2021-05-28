<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminGroup = Group::create([
            'name'      => 'Admin',
            'active'    => true
        ]);

        $adminUser = User::firstWhere('first_name', 'Admin');
        $adminGroup->users()->sync($adminUser->id);

        $permissionIds = Permission::all()->pluck('id');
        $adminGroup->permissions()->sync($permissionIds);
    }
}
