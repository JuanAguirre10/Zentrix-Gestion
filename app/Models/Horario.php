<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;  // ← AGREGAR ESTA LÍNEA

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';
    protected $fillable = ['dia_semana', 'hora_inicio', 'hora_fin', 'cupo_max', 'salon'];
        
    public function getRouteKeyName()
    {
        return 'id_horario';
    }

    public function detallesMatricula(): HasMany  // ← Y AGREGAR ": HasMany" AQUÍ
    {
        return $this->hasMany(DetalleMatricula::class, 'id_horario', 'id_horario');
    }

    // Formatear horas para mostrar
    public function getHorarioFormateadoAttribute(): string
    {
        return $this->dia_semana .
                ' de ' . date('H:i', strtotime($this->hora_inicio)) .
                ' a ' . date('H:i', strtotime($this->hora_fin));
    }
}