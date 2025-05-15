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
    
    public function detallesMatricula() {
        return $this->hasMany(DetalleMatricula::class, 'id_horario', 'id_horario');
    }
    
    // Formatear horas para mostrar
    public function getHorarioFormateadoAttribute() {
        return $this->dia_semana . ' ' . 
               date('H:i', strtotime($this->hora_inicio)) . ' - ' . 
               date('H:i', strtotime($this->hora_fin));
    }
}