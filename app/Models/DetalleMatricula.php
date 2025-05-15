<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMatricula extends Model
{
    use HasFactory;
    
    protected $table = 'detalle_matric';
    protected $primaryKey = 'id_detalle';
    protected $fillable = ['id_matricula', 'id_curso', 'id_horario', 'monto'];
    
    public function matricula() {
        return $this->belongsTo(Matricula::class, 'id_matricula', 'id_matricula');
    }
    
    public function curso() {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }
    
    public function horario() {
        return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');
    }
    
    public function asistencias() {
        return $this->hasMany(Asistencia::class, 'id_detalle_mat', 'id_detalle');
    }
}