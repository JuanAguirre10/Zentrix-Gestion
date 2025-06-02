<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apoderado;

class ApoderadoSeeder extends Seeder
{
    public function run(): void
    {
        $apoderados = [
            [
                'nombres' => 'María Elena',
                'apellidos' => 'García Rodríguez',
                'dni' => '12345678',
                'telefono' => '01-4567890',
                'celular' => '987654321',
                'email' => 'maria.garcia@email.com',
                'ocupacion' => 'Docente',
                'direccion' => 'Av. Los Olivos 123, Lima',
                'parentesco' => 'madre'
            ],
            [
                'nombres' => 'Carlos Alberto',
                'apellidos' => 'Mendoza Silva',
                'dni' => '23456789',
                'telefono' => '01-5678901',
                'celular' => '976543210',
                'email' => 'carlos.mendoza@email.com',
                'ocupacion' => 'Ingeniero',
                'direccion' => 'Jr. Las Flores 456, Lima',
                'parentesco' => 'padre'
            ],
            [
                'nombres' => 'Ana Sofía',
                'apellidos' => 'López Vargas',
                'dni' => '34567890',
                'telefono' => '01-6789012',
                'celular' => '965432109',
                'email' => 'ana.lopez@email.com',
                'ocupacion' => 'Contadora',
                'direccion' => 'Calle San Martín 789, Lima',
                'parentesco' => 'madre'
            ],
            [
                'nombres' => 'Roberto',
                'apellidos' => 'Fernández Castro',
                'dni' => '45678901',
                'telefono' => '01-7890123',
                'celular' => '954321098',
                'email' => 'roberto.fernandez@email.com',
                'ocupacion' => 'Médico',
                'direccion' => 'Av. Universitaria 321, Lima',
                'parentesco' => 'padre'
            ],
            [
                'nombres' => 'Patricia',
                'apellidos' => 'Quispe Mamani',
                'dni' => '56789012',
                'telefono' => '01-8901234',
                'celular' => '943210987',
                'email' => 'patricia.quispe@email.com',
                'ocupacion' => 'Enfermera',
                'direccion' => 'Jr. Puno 654, Lima',
                'parentesco' => 'madre'
            ]
        ];

        foreach ($apoderados as $apoderado) {
            Apoderado::create($apoderado);
        }
    }
}