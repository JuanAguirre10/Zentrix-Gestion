<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoEscolar extends Model
{
    use HasFactory;
    
    protected $table = 'grados_escolar';
    protected $primaryKey = 'id_grado';
    protected $fillable = ['nombre', 'id_nivel', 'jerarquia'];
    
    public function nivelEducativo() {
        return $this->belongsTo(NivelEducativo::class, 'id_nivel', 'id_nivel');
    }
    
    public function estudiantes() {
        return $this->hasMany(Estudiante::class, 'id_grado', 'id_grado');
    }
}