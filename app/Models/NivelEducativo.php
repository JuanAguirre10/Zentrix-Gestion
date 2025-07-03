<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEducativo extends Model
{
    use HasFactory;
    
    protected $table = 'niveles_educativos';
    protected $primaryKey = 'id_nivel';
    protected $fillable = ['nombre_nivel', 'descripcion','activo'];
    
    public function grados() {
        return $this->hasMany(GradoEscolar::class, 'id_nivel', 'id_nivel');
    }
    
    public function cursos() {
        return $this->hasMany(Curso::class, 'id_nivel', 'id_nivel');
    }
    
    // Relación a través de grados para obtener estudiantes
    public function estudiantes() {
        return $this->hasManyThrough(
            Estudiante::class,
            GradoEscolar::class,
            'id_nivel', // Llave foránea en grados_escolar
            'id_grado',  // Llave foránea en estudiantes
            'id_nivel',  // Llave local en niveles_edu
            'id_grado'   // Llave local en grados_escolar
        );
    }
}