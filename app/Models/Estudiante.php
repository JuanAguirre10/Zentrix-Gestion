<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $table = 'estudiantes';
    protected $primaryKey = 'id_estudiante';
    protected $fillable = ['nombres', 'apellidos', 'dni', 'fecha_nacimiento', 'id_apoderado', 'id_grado', 'centro_estudios', 'observaciones'];
    
    public function apoderado() {
        return $this->belongsTo(Apoderado::class, 'id_apoderado', 'id_apoderado');
    }
    
    public function gradoEscolar() {
        return $this->belongsTo(GradoEscolar::class, 'id_grado', 'id_grado');
    }
    
    public function matriculas() {
        return $this->hasMany(Matricula::class, 'id_estudiante', 'id_estudiante');
    }
    
    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class, 'id_estudiante', 'id_estudiante');
    }
}