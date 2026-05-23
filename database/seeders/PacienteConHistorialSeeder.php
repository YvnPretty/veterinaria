<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paciente;
use App\Models\HistorialMedico;
use App\Models\Cita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PacienteConHistorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $veterinarios = User::where('rol', 'veterinario')->get();

        if ($veterinarios->isEmpty()) {
            $veterinarios = collect([
                User::create([
                    'name' => 'Dra. Laura Pérez',
                    'email' => 'laura@vetcare.com',
                    'password' => Hash::make('123'),
                    'rol' => 'veterinario',
                ]),
            ]);
        }

        $clientes = collect([
            User::updateOrCreate(['email' => 'juan@vetcare.com'], [
                'name' => 'Juan Mendoza',
                'password' => Hash::make('123'),
                'rol' => 'usuario',
            ]),
            User::updateOrCreate(['email' => 'ana@vetcare.com'], [
                'name' => 'Ana Ruiz',
                'password' => Hash::make('123'),
                'rol' => 'usuario',
            ]),
            User::updateOrCreate(['email' => 'maria@vetcare.com'], [
                'name' => 'María Torres',
                'password' => Hash::make('123'),
                'rol' => 'usuario',
            ]),
        ]);

        $pacientesDemo = [
            [
                'owner' => 0,
                'nombre' => 'Max',
                'especie' => 'Perro',
                'raza' => 'Golden Retriever',
                'edad' => 3,
                'telefono' => '555-0199',
                'observaciones' => 'Mascota muy amigable, algo ansioso en consulta.',
                'historial' => [
                    ['fecha' => '2026-04-18', 'diagnostico' => 'Otitis externa bilateral leve. Enrojecimiento y secreción ceruminosa en ambos canales auditivos.', 'tratamiento' => 'Limpieza profunda del conducto auditivo externo e inicio de tratamiento tópico.', 'medicamentos' => 'Oto Clean, 4 gotas en cada oído cada 12 horas durante 7 días.'],
                    ['fecha' => '2026-05-18', 'diagnostico' => 'Control por otitis. Canales auditivos sanos, sin secreción ni signos de inflamación.', 'tratamiento' => 'Examen otoscópico completo y limpieza profiláctica.', 'medicamentos' => 'Ninguno. Alta médica del paciente.'],
                ],
                'citas' => [
                    ['fecha_hora' => now()->setTime(10, 0), 'motivo' => 'Control dermatológico', 'estado' => 'pendiente', 'notas' => 'Revisar oído derecho y tolerancia a limpieza.'],
                ],
            ],
            [
                'owner' => 1,
                'nombre' => 'Luna',
                'especie' => 'Gato',
                'raza' => 'Europeo doméstico',
                'edad' => 2,
                'telefono' => '555-0124',
                'observaciones' => 'Paciente nerviosa; manejar con transportadora cubierta y ambiente tranquilo.',
                'historial' => [
                    ['fecha' => '2026-05-03', 'diagnostico' => 'Gingivitis leve con acumulación de sarro premolar.', 'tratamiento' => 'Profilaxis dental preventiva y orientación de higiene oral.', 'medicamentos' => 'Gel oral antiséptico cada 24 horas por 10 días.'],
                ],
                'citas' => [
                    ['fecha_hora' => now()->setTime(12, 30), 'motivo' => 'Vacunación triple felina', 'estado' => 'en_proceso', 'notas' => 'Confirmar apetito y temperatura antes de aplicar.'],
                ],
            ],
            [
                'owner' => 1,
                'nombre' => 'Rocky',
                'especie' => 'Perro',
                'raza' => 'Bulldog Francés',
                'edad' => 5,
                'telefono' => '555-0124',
                'observaciones' => 'Tendencia a fatiga respiratoria en calor; evitar ejercicio intenso.',
                'historial' => [
                    ['fecha' => '2026-04-28', 'diagnostico' => 'Dermatitis alérgica estacional con prurito moderado.', 'tratamiento' => 'Baño dermatológico y control antipruriginoso.', 'medicamentos' => 'Shampoo dermatológico dos veces por semana durante 3 semanas.'],
                ],
                'citas' => [
                    ['fecha_hora' => now()->addDay()->setTime(9, 30), 'motivo' => 'Seguimiento dermatológico', 'estado' => 'pendiente', 'notas' => 'Evaluar respuesta al shampoo.'],
                ],
            ],
            [
                'owner' => 2,
                'nombre' => 'Mía',
                'especie' => 'Conejo',
                'raza' => 'Mini Lop',
                'edad' => 1,
                'telefono' => '555-0177',
                'observaciones' => 'Dieta alta en heno; revisar desgaste dental en cada visita.',
                'historial' => [
                    ['fecha' => '2026-05-10', 'diagnostico' => 'Sobrecrecimiento dental incipiente sin lesión oral.', 'tratamiento' => 'Ajuste alimenticio y revisión dental programada.', 'medicamentos' => 'Sin medicación. Incrementar heno fresco diario.'],
                ],
                'citas' => [
                    ['fecha_hora' => now()->addDay()->setTime(11, 0), 'motivo' => 'Revisión dental', 'estado' => 'pendiente', 'notas' => 'Traer registro de consumo de alimento.'],
                ],
            ],
            [
                'owner' => 2,
                'nombre' => 'Toby',
                'especie' => 'Perro',
                'raza' => 'Mestizo',
                'edad' => 7,
                'telefono' => '555-0177',
                'observaciones' => 'Paciente senior; monitorear movilidad y peso.',
                'historial' => [
                    ['fecha' => '2026-03-22', 'diagnostico' => 'Dolor articular leve en cadera posterior derecha.', 'tratamiento' => 'Manejo de peso, caminatas controladas y suplemento articular.', 'medicamentos' => 'Condroprotector oral cada 24 horas por 30 días.'],
                    ['fecha' => '2026-05-20', 'diagnostico' => 'Control geriátrico. Marcha estable y condición corporal aceptable.', 'tratamiento' => 'Examen físico completo y recomendación de control semestral.', 'medicamentos' => 'Continuar suplemento articular.'],
                ],
                'citas' => [
                    ['fecha_hora' => now()->subDay()->setTime(16, 0), 'motivo' => 'Control geriátrico', 'estado' => 'completada', 'notas' => 'Paciente estable.'],
                ],
            ],
        ];

        foreach ($pacientesDemo as $index => $item) {
            $cliente = $clientes[$item['owner']];

            $paciente = Paciente::updateOrCreate(
                ['nombre' => $item['nombre'], 'user_id' => $cliente->id],
                [
                    'especie' => $item['especie'],
                    'raza' => $item['raza'],
                    'edad' => $item['edad'],
                    'nombre_propietario' => $cliente->name,
                    'telefono_propietario' => $item['telefono'],
                    'observaciones' => $item['observaciones'],
                ]
            );

            foreach ($item['historial'] as $registro) {
                HistorialMedico::updateOrCreate(
                    [
                        'paciente_id' => $paciente->id,
                        'fecha' => $registro['fecha'],
                        'diagnostico' => $registro['diagnostico'],
                    ],
                    [
                        'veterinario_id' => $veterinarios[$index % $veterinarios->count()]->id,
                        'tratamiento' => $registro['tratamiento'],
                        'medicamentos' => $registro['medicamentos'],
                    ]
                );
            }

            foreach ($item['citas'] as $cita) {
                Cita::updateOrCreate(
                    [
                        'paciente_id' => $paciente->id,
                        'fecha_hora' => $cita['fecha_hora'],
                        'motivo' => $cita['motivo'],
                    ],
                    [
                        'estado' => $cita['estado'],
                        'notas' => $cita['notas'],
                    ]
                );
            }
        }
    }
}
