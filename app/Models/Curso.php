<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    
    protected $table = 'cursos';
    protected $primaryKey = 'id_curso';
    protected $fillable = ['nombre_curso', 'id_nivel', 'duracion', 'precio', 'descripcion'];
    
public function nivelEducativo() {
        return $this->belongsTo(NivelEducativo::class, 'id_nivel', 'id_nivel');
    }
    
    public function temas() {
        return $this->hasMany(TemaCurso::class, 'id_curso', 'id_curso')->orderBy('orden');
    }
    
    public function detallesMatricula() {
        return $this->hasMany(DetalleMatricula::class, 'id_curso', 'id_curso');
    }
    
    public function materiales() {
        return $this->hasMany(MaterialDidactico::class, 'id_curso', 'id_curso');
    }
    
    public function estudiantes() {
        return Estudiante::join('matriculas', 'estudiantes.id_estudiante', '=', 'matriculas.id_estudiante')
                ->join('detalle_matric', 'matriculas.id_matricula', '=', 'detalle_matric.id_matricula')
                ->where('detalle_matric.id_curso', $this->id_curso)
                ->where('matriculas.estado', 'activa')
                ->select('estudiantes.*')
                ->distinct()
                ->get();
    }
}