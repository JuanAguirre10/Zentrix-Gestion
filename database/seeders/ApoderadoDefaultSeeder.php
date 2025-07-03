<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apoderado;

class ApoderadoDefaultSeeder extends Seeder
{
    public function run()
    {
        // Crear el apoderado por defecto si no existe
        Apoderado::firstOrCreate(
            ['id_apoderado' => 1],
            [
                'nombres' => 'Sin',
                'apellidos' => 'Apoderado',
                'dni' => '00000000',
                'telefono' => '',
                'celular' => '',
                'direccion' => '',
                'ocupacion' => '',
                'email' => ''
            ]
        );
    }
}