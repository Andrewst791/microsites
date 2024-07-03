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
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            CurrencySeeder::class,
            UserSeeder::class
        ]);
//        $this->call(CurrencySeeder::class);
//        User::factory()->create([
//            'name' => 'Usuario Invitado',
//            'email' => 'invitado@example.com',
//        ]);
//        User::factory()->create([
//            'name' => 'Usuario Administrador',
//            'email' => 'administrador@example.com',
//        ]);
//        User::factory(100)->create();
    }
}
