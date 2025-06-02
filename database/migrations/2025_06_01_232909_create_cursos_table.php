<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id('id_curso');
            $table->string('nombre_curso', 150);
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_nivel');
            $table->string('duracion', 50)->nullable();
            $table->decimal('precio', 10, 2)->default(0.00);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Relación foránea
            $table->foreign('id_nivel')
                  ->references('id_nivel')
                  ->on('niveles_educativos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};