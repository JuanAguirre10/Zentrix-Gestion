<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = [
            // Cursos de Primaria (id_nivel = 1)
            [
                'nombre_curso' => 'Matemáticas Básicas',
                'descripcion' => 'Curso de matemáticas para estudiantes de primaria',
                'id_nivel' => 1,
                'duracion' => '4 meses',
                'precio' => 120.00,
                'activo' => true
            ],
            [
                'nombre_curso' => 'Comprensión Lectora',
                'descripcion' => 'Desarrollo de habilidades de lectura y comprensión',
                'id_nivel' => 1,
                'duracion' => '3 meses',
                'precio' => 100.00,
                'activo' => true
            ],

            // Cursos de Secundaria (id_nivel = 2)
            [
                'nombre_curso' => 'Álgebra Intermedia',
                'descripcion' => 'Curso de álgebra para estudiantes de secundaria',
                'id_nivel' => 2,
                'duracion' => '6 meses',
                'precio' => 180.00,
                'activo' => true
            ],
            [
                'nombre_curso' => 'Química General',
                'descripcion' => 'Fundamentos de química para secundaria',
                'id_nivel' => 2,
                'duracion' => '5 meses',
                'precio' => 200.00,
                'activo' => true
            ],
            [
                'nombre_curso' => 'Historia del Perú',
                'descripcion' => 'Historia peruana desde la conquista hasta la actualidad',
                'id_nivel' => 2,
                'duracion' => '4 meses',
                'precio' => 150.00,
                'activo' => true
            ],

            // Cursos Universitarios (id_nivel = 3)
            [
                'nombre_curso' => 'Cálculo Diferencial',
                'descripcion' => 'Matemáticas universitarias - Cálculo I',
                'id_nivel' => 3,
                'duracion' => '1 semestre',
                'precio' => 350.00,
                'activo' => true
            ],
            [
                'nombre_curso' => 'Física Mecánica',
                'descripcion' => 'Física I para estudiantes universitarios',
                'id_nivel' => 3,
                'duracion' => '1 semestre',
                'precio' => 400.00,
                'activo' => true
            ],

            // Cursos Preuniversitarios (id_nivel = 4)
            [
                'nombre_curso' => 'Razonamiento Matemático',
                'descripcion' => 'Preparación para exámenes de admisión',
                'id_nivel' => 4,
                'duracion' => '8 meses',
                'precio' => 500.00,
                'activo' => true
            ],
            [
                'nombre_curso' => 'Razonamiento Verbal',
                'descripcion' => 'Comprensión lectora y aptitud verbal',
                'id_nivel' => 4,
                'duracion' => '6 meses',
                'precio' => 450.00,
                'activo' => true
            ],
            [
                'nombre_curso' => 'Ciencias Naturales',
                'descripcion' => 'Biología, Química y Física integradas',
                'id_nivel' => 4,
                'duracion' => '10 meses',
                'precio' => 600.00,
                'activo' => true
            ]
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}