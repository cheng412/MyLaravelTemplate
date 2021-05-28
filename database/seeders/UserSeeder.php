<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'    => 'Admin',
            'email'         => 'admin@example.com',
            'email_verified_at'     => now(),
            'password'      => bcrypt('password'),
            'status'        => User::STATUS_ACTIVE
        ]);

        User::create([
            'first_name'    => 'Guest',
            'email'         => 'guest@example.com',
            'email_verified_at'     => now(),
            'password'      => bcrypt('password'),
            'status'        => User::STATUS_ACTIVE
        ]);
    }
}
