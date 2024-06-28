<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Usuario Invitado',
            'email' => 'invitado@example.com',
        ]);
        User::factory()->create([
            'name' => 'Usuario Administrador',
            'email' => 'administrador@example.com',
        ]);
        User::factory(10)->create();
    }
}
