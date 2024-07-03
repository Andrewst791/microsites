<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name'      => 'Usuario Administrador',
            'email'     => 'administrador@example.com',
            'password'  => Hash::make('Administrador')
        ]);
        $admin->assignRole('Admin');
        $customer = User::factory()->create([
            'name'      => 'Usuario Cliente',
            'email'     => 'cliente@example.com',
            'password'  => Hash::make('Cliente')
        ]);
        $customer->assignRole('Customer');
//        $customer->assignRole('Guest');
        $guest = User::factory()->create([
            'name'      => 'Usuario Invitado',
            'email'     => 'invitado@example.com',
            'password'  => Hash::make('Invitado')
        ]);
        $guest->assignRole('Guest');
    }
}
