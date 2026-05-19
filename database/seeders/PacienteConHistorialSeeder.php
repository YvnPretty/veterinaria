<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paciente;
use App\Models\HistorialMedico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PacienteConHistorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener un veterinario para asociarlo a las consultas
        $veterinario = User::where('rol', 'veterinario')->first();

        // En caso de que no exista ningún veterinario, creamos uno de respaldo
        if (!$veterinario) {
            $veterinario = User::create([
                'name' => 'Dra. Laura Pérez',
                'email' => 'laura@vetcare.com',
                'password' => Hash::make('1234'),
                'rol' => 'veterinario',
            ]);
        }

        // 2. Crear un usuario Dueño (rol usuario)
        $dueño = User::updateOrCreate(
            ['email' => 'juan@vetcare.com'],
            [
                'name' => 'Juan Mendoza',
                'password' => Hash::make('1234'),
                'rol' => 'usuario',
            ]
        );

        // 3. Crear una mascota (Paciente) asociada al dueño
        $paciente = Paciente::updateOrCreate(
            [
                'nombre' => 'Max',
                'user_id' => $dueño->id,
            ],
            [
                'especie' => 'Perro',
                'raza' => 'Golden Retriever',
                'edad' => 3,
                'nombre_propietario' => $dueño->name,
                'telefono_propietario' => '555-0199',
                'observaciones' => 'Mascota muy amigable, algo ansioso en consulta.',
            ]
        );

        // 4. Crear la primera consulta (hace un mes)
        HistorialMedico::create([
            'paciente_id' => $paciente->id,
            'veterinario_id' => $veterinario->id,
            'fecha' => '2026-04-18',
            'diagnostico' => 'Otitis externa bilateral leve. Se observa enrojecimiento y secreción ceruminosa en ambos canales auditivos.',
            'tratamiento' => 'Limpieza profunda del conducto auditivo externo en el consultorio e inicio de tratamiento tópico.',
            'medicamentos' => 'Oto Clean gotas óticas, aplicar 4 gotas en cada oído cada 12 horas durante 7 días.',
        ]);

        // 5. Crear la segunda consulta (hoy - control)
        HistorialMedico::create([
            'paciente_id' => $paciente->id,
            'veterinario_id' => $veterinario->id,
            'fecha' => '2026-05-18',
            'diagnostico' => 'Consulta de revisión por Otitis. Los canales auditivos se encuentran completamente sanos, sin secreción ni signos de inflamación.',
            'tratamiento' => 'Examen otoscópico completo de control y limpieza profiláctica de rutina.',
            'medicamentos' => 'Ninguno. Alta médica del paciente.',
        ]);
    }
}
