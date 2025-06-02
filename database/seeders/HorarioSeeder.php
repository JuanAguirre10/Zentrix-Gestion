<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        $horarios = [
            // Horarios de mañana
            [
                'dia_semana' => 'lunes',
                'hora_inicio' => '08:00',
                'hora_fin' => '10:00',
                'salon' => 'Aula 101',
                'cupo_maximo' => 25,
                'activo' => true
            ],
            [
                'dia_semana' => 'lunes',
                'hora_inicio' => '10:30',
                'hora_fin' => '12:30',
                'salon' => 'Aula 102',
                'cupo_maximo' => 20,
                'activo' => true
            ],
            [
                'dia_semana' => 'martes',
                'hora_inicio' => '08:00',
                'hora_fin' => '10:00',
                'salon' => 'Laboratorio',
                'cupo_maximo' => 15,
                'activo' => true
            ],
            [
                'dia_semana' => 'miercoles',
                'hora_inicio' => '14:00',
                'hora_fin' => '16:00',
                'salon' => 'Aula 103',
                'cupo_maximo' => 30,
                'activo' => true
            ],
            [
                'dia_semana' => 'jueves',
                'hora_inicio' => '16:30',
                'hora_fin' => '18:30',
                'salon' => 'Aula 201',
                'cupo_maximo' => 20,
                'activo' => true
            ],
            [
                'dia_semana' => 'viernes',
                'hora_inicio' => '09:00',
                'hora_fin' => '11:00',
                'salon' => 'Aula 202',
                'cupo_maximo' => 25,
                'activo' => true
            ],
            [
                'dia_semana' => 'sabado',
                'hora_inicio' => '08:00',
                'hora_fin' => '12:00',
                'salon' => 'Aula Magna',
                'cupo_maximo' => 50,
                'activo' => true
            ],
            [
                'dia_semana' => 'sabado',
                'hora_inicio' => '14:00',
                'hora_fin' => '18:00',
                'salon' => 'Aula 301',
                'cupo_maximo' => 35,
                'activo' => true
            ]
        ];

        foreach ($horarios as $horario) {
            Horario::create($horario);
        }
    }
}