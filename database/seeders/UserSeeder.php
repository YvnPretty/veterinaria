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
        User::updateOrCreate(
            ['email' => 'admin@vetcare.com'],
            [
                'name' => 'Admin VetCare',
                'password' => Hash::make('1234'),
                'rol' => 'administrador',
            ]
        );

        User::updateOrCreate(
            ['email' => 'laura@vetcare.com'],
            [
                'name' => 'Dra. Laura Pérez',
                'password' => Hash::make('1234'),
                'rol' => 'veterinario',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pedro@vetcare.com'],
            [
                'name' => 'Dr. Pedro Gómez',
                'password' => Hash::make('1234'),
                'rol' => 'veterinario',
            ]
        );
    }
}
