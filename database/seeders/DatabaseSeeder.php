<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en orden de dependencia
        $this->call([
            // 1. Primero los niveles educativos (no dependen de nadie)
            NivelEducativoSeeder::class,
            
            // 2. Luego los grados (dependen de niveles)
            GradoEscolarSeeder::class,
            
            // 3. Después los apoderados (independientes)
            ApoderadoSeeder::class,
            
            // 4. Estudiantes (dependen de apoderados y grados)
            EstudianteSeeder::class,
            
            // 5. Cursos (dependen de niveles)
            CursoSeeder::class,
            
            // 6. Horarios (independientes)
            HorarioSeeder::class,
            
            // 7. Matrículas (dependen de estudiantes)
            MatriculaSeeder::class,
            
            // 8. Por último los pagos (dependen de matrículas)
            PagoSeeder::class,
        ]);
        
        $this->command->info('¡Todos los seeders ejecutados exitosamente!');
    }
}