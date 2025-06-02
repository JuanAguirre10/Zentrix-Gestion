<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = [
            [
                'nombres' => 'Luis Fernando',
                'apellidos' => 'García Rodríguez',
                'dni' => '71234567',
                'fecha_nacimiento' => '2010-03-15',
                'id_apoderado' => 1,
                'id_grado' => 7, // 1° Secundaria
                'centro_estudios' => 'I.E. San José',
                'observaciones' => 'Excelente estudiante, destacado en matemáticas'
            ],
            [
                'nombres' => 'Andrea Valeria',
                'apellidos' => 'Mendoza Silva',
                'dni' => '72345678',
                'fecha_nacimiento' => '2011-07-22',
                'id_apoderado' => 2,
                'id_grado' => 5, // 5° Primaria
                'centro_estudios' => 'Colegio Santa María',
                'observaciones' => 'Muy participativa en clase'
            ],
            [
                'nombres' => 'Diego Alejandro',
                'apellidos' => 'López Vargas',
                'dni' => '73456789',
                'fecha_nacimiento' => '2009-12-10',
                'id_apoderado' => 3,
                'id_grado' => 9, // 3° Secundaria
                'centro_estudios' => 'Colegio Nacional',
                'observaciones' => 'Necesita refuerzo en ciencias'
            ],
            [
                'nombres' => 'Sofía Isabella',
                'apellidos' => 'Fernández Castro',
                'dni' => '74567890',
                'fecha_nacimiento' => '2012-05-18',
                'id_apoderado' => 4,
                'id_grado' => 4, // 4° Primaria
                'centro_estudios' => 'I.E. María Auxiliadora',
                'observaciones' => 'Muy creativa y responsable'
            ],
            [
                'nombres' => 'Mateo Gabriel',
                'apellidos' => 'Quispe Mamani',
                'dni' => '75678901',
                'fecha_nacimiento' => '2008-09-03',
                'id_apoderado' => 5,
                'id_grado' => 15, // Pre San Marcos
                'centro_estudios' => 'Colegio Particular',
                'observaciones' => 'Preparándose para el examen de admisión'
            ]
        ];

        foreach ($estudiantes as $estudiante) {
            Estudiante::create($estudiante);
        }
    }
}