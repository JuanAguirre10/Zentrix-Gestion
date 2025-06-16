<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    */
   public function run(): void
   {
       // PRIMERO: Crear usuarios del sistema
       $this->createSystemUsers();
       
       // SEGUNDO: Ejecutar seeders en orden de dependencia
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
       $this->command->info('Usuarios creados con roles y permisos.');
   }
   
   /**
    * Crear usuarios del sistema con diferentes roles
    */
   private function createSystemUsers(): void
   {
       $this->command->info('Creando usuarios del sistema...');
       
       // Crear Administrador Principal
       User::updateOrCreate(
           ['email' => 'admin@zentrix.com'],
           [
               'name' => 'Administrador Principal',
               'password' => Hash::make('admin123'),
               'role' => 'admin',
               'active' => true,
           ]
       );
       
       // Crear Profesor
       User::updateOrCreate(
           ['email' => 'profesor@zentrix.com'],
           [
               'name' => 'Profesor García',
               'password' => Hash::make('profesor123'),
               'role' => 'teacher',
               'active' => true,
           ]
       );
       
       // Crear Estudiante
       User::updateOrCreate(
           ['email' => 'estudiante@zentrix.com'],
           [
               'name' => 'Juan Estudiante',
               'password' => Hash::make('estudiante123'),
               'role' => 'student',
               'active' => true,
           ]
       );
       
       // Actualizar usuario existente si existe
       User::updateOrCreate(
           ['email' => 'admin@test.com'],
           [
               'name' => 'Admin Test',
               'password' => Hash::make('123456'),
               'role' => 'admin',
               'active' => true,
           ]
       );
       
       $this->command->info('Usuarios del sistema creados:');
       $this->command->line('- Admin: admin@zentrix.com / admin123');
       $this->command->line('- Profesor: profesor@zentrix.com / profesor123');
       $this->command->line('- Estudiante: estudiante@zentrix.com / estudiante123');
       $this->command->line('- Admin Test: admin@test.com / 123456');
   }
}