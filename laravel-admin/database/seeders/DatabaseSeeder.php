<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'name' => 'Admin'
        ]);

        Role::factory()->create([
            'name' => 'Editor'
        ]);        

        Role::factory()->create([
            'name' => 'Viewer'
        ]);

        \App\Models\User::factory(20)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);

        \App\Models\User::factory()->create([
            'first_name' => 'Editor',
            'last_name' => 'Editor',
            'email' => 'editor@example.com',
            'role_id' => 2,
        ]);        

        \App\Models\User::factory()->create([
            'first_name' => 'Viewer',
            'last_name' => 'Viewer',
            'email' => 'viewer@example.com',
            'role_id' => 3,
        ]);        

    }
}
