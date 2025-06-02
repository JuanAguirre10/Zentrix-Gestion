<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GradoEscolar;

class GradoEscolarSeeder extends Seeder
{
    public function run(): void
    {
        $grados = [
            // Primaria (id_nivel = 1)
            ['nombre_grado' => '1° Primaria', 'descripcion' => 'Primer grado de primaria', 'id_nivel' => 1],
            ['nombre_grado' => '2° Primaria', 'descripcion' => 'Segundo grado de primaria', 'id_nivel' => 1],
            ['nombre_grado' => '3° Primaria', 'descripcion' => 'Tercer grado de primaria', 'id_nivel' => 1],
            ['nombre_grado' => '4° Primaria', 'descripcion' => 'Cuarto grado de primaria', 'id_nivel' => 1],
            ['nombre_grado' => '5° Primaria', 'descripcion' => 'Quinto grado de primaria', 'id_nivel' => 1],
            ['nombre_grado' => '6° Primaria', 'descripcion' => 'Sexto grado de primaria', 'id_nivel' => 1],

            // Secundaria (id_nivel = 2)
            ['nombre_grado' => '1° Secundaria', 'descripcion' => 'Primer año de secundaria', 'id_nivel' => 2],
            ['nombre_grado' => '2° Secundaria', 'descripcion' => 'Segundo año de secundaria', 'id_nivel' => 2],
            ['nombre_grado' => '3° Secundaria', 'descripcion' => 'Tercer año de secundaria', 'id_nivel' => 2],
            ['nombre_grado' => '4° Secundaria', 'descripcion' => 'Cuarto año de secundaria', 'id_nivel' => 2],
            ['nombre_grado' => '5° Secundaria', 'descripcion' => 'Quinto año de secundaria', 'id_nivel' => 2],

            // Universidad (id_nivel = 3)
            ['nombre_grado' => '1° Ciclo', 'descripcion' => 'Primer ciclo universitario', 'id_nivel' => 3],
            ['nombre_grado' => '2° Ciclo', 'descripcion' => 'Segundo ciclo universitario', 'id_nivel' => 3],
            ['nombre_grado' => '3° Ciclo', 'descripcion' => 'Tercer ciclo universitario', 'id_nivel' => 3],

            // Preuniversitario (id_nivel = 4)
            ['nombre_grado' => 'Pre San Marcos', 'descripcion' => 'Preparación para Universidad San Marcos', 'id_nivel' => 4],
            ['nombre_grado' => 'Pre UNI', 'descripcion' => 'Preparación para Universidad UNI', 'id_nivel' => 4],
            ['nombre_grado' => 'Pre UNMSM', 'descripcion' => 'Preparación para Universidad Mayor de San Marcos', 'id_nivel' => 4],
        ];

        foreach ($grados as $grado) {
            GradoEscolar::create($grado);
        }
    }
}