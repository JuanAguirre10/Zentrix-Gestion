<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante_curso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained('estudiantes', 'id_estudiante')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos', 'id_curso')->onDelete('cascade');
            $table->date('fecha_inscripcion');
            $table->enum('estado', ['activo', 'inactivo', 'completado', 'suspendido'])->default('activo');
            $table->decimal('nota_final', 5, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            
            // Evitar duplicados
            $table->unique(['estudiante_id', 'curso_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante_curso');
    }
};