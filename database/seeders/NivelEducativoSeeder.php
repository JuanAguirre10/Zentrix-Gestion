<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NivelEducativo;

class NivelEducativoSeeder extends Seeder
{
    public function run(): void
    {
        $niveles = [
            [
                'nombre_nivel' => 'Primaria',
                'descripcion' => 'Educación primaria para niños de 6 a 11 años',
                'activo' => true
            ],
            [
                'nombre_nivel' => 'Secundaria',
                'descripcion' => 'Educación secundaria para adolescentes de 12 a 16 años',
                'activo' => true
            ],
            [
                'nombre_nivel' => 'Universidad',
                'descripcion' => 'Educación superior universitaria para jóvenes y adultos',
                'activo' => true
            ],
            [
                'nombre_nivel' => 'Preuniversitario',
                'descripcion' => 'Preparación para exámenes de admisión universitaria',
                'activo' => true
            ]
        ];

        foreach ($niveles as $nivel) {
            NivelEducativo::create($nivel);
        }
    }
}