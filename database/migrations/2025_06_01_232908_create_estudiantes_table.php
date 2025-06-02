<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('id_estudiante');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('dni', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('id_apoderado');
            $table->unsignedBigInteger('id_grado');
            $table->string('centro_estudios', 255)->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Relaciones foráneas
            $table->foreign('id_apoderado')
                  ->references('id_apoderado')
                  ->on('apoderados')
                  ->onDelete('cascade');
                  
            $table->foreign('id_grado')
                  ->references('id_grado')
                  ->on('grados_escolar')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};