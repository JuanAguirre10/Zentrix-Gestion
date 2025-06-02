<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matricula;

class MatriculaSeeder extends Seeder
{
    public function run(): void
    {
        $matriculas = [
            [
                'id_estudiante' => 1,
                'fecha_matricula' => '2025-01-15',
                'descuento_porcentaje' => 0.00,
                'monto_total' => 150.00,
                'estado' => 'activa',
                'observaciones' => 'Matrícula regular sin descuentos'
            ],
            [
                'id_estudiante' => 2,
                'fecha_matricula' => '2025-01-20',
                'descuento_porcentaje' => 10.00,
                'monto_total' => 180.00,
                'estado' => 'activa',
                'observaciones' => 'Descuento por hermano estudiante'
            ],
            [
                'id_estudiante' => 3,
                'fecha_matricula' => '2025-02-01',
                'descuento_porcentaje' => 0.00,
                'monto_total' => 200.00,
                'estado' => 'activa',
                'observaciones' => 'Matrícula completa'
            ],
            [
                'id_estudiante' => 4,
                'fecha_matricula' => '2025-02-10',
                'descuento_porcentaje' => 5.00,
                'monto_total' => 120.00,
                'estado' => 'activa',
                'observaciones' => 'Descuento por pronto pago'
            ],
            [
                'id_estudiante' => 5,
                'fecha_matricula' => '2025-02-15',
                'descuento_porcentaje' => 0.00,
                'monto_total' => 300.00,
                'estado' => 'activa',
                'observaciones' => 'Curso preuniversitario intensivo'
            ]
        ];

        foreach ($matriculas as $matricula) {
            Matricula::create($matricula);
        }
    }
}