<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apoderados', function (Blueprint $table) {
            $table->id('id_apoderado');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('dni', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('ocupacion', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->enum('parentesco', ['padre', 'madre', 'abuelo', 'abuela', 'tio', 'tia', 'hermano', 'hermana', 'otro'])->default('padre');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apoderados');
    }
};