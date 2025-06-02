<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grados_escolar', function (Blueprint $table) {
            $table->id('id_grado');
            $table->string('nombre_grado', 100);
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_nivel');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Relación con niveles educativos
            $table->foreign('id_nivel')
                  ->references('id_nivel')
                  ->on('niveles_educativos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grados_escolar');
    }
};