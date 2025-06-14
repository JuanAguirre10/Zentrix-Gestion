<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function detallesMatricula(): HasMany
    {
        return $this->hasMany(related: DetalleMatricula::class, foreignKey: 'id_horario', localKey: 'id_horario');
    }

    // Formatear horas para mostrar
    public function getHorarioFormateadoAttribute(): string
    {
        return $this->dia_semana . 
               ' de ' . date(format: 'H:i', timestamp: strtotime(datetime: $this->hora_inicio)) . 
               ' a ' . date(format: 'H:i', timestamp: strtotime(datetime: $this->hora_fin));
    }
}