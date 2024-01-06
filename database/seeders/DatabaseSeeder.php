<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@user.com',
            'password' => bcrypt('admin'),
            'isAdmin' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Normal User',
            'email' => 'normal@user.com',
            'password' => bcrypt('123abc'),
            'isAdmin' => false,
        ]);
    }
}
