<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalles_matricula', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->unsignedBigInteger('id_matricula');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_horario')->nullable();
            $table->decimal('precio_curso', 10, 2);
            $table->decimal('descuento_aplicado', 10, 2)->default(0.00);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            // Relaciones foráneas CORREGIDAS
            $table->foreign('id_matricula')
                  ->references('id_matricula')  // Cambiado de 'id' a 'id_matricula'
                  ->on('matriculas')
                  ->onDelete('cascade');
                  
            $table->foreign('id_curso')
                  ->references('id_curso')
                  ->on('cursos')
                  ->onDelete('cascade');
                  
            $table->foreign('id_horario')
                  ->references('id_horario')
                  ->on('horarios')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_matricula');
    }
};