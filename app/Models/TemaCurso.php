<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaCurso extends Model
{
    use HasFactory;
    
    protected $table = 'temas_curso';
    protected $primaryKey = 'id_tema';
    protected $fillable = ['titulo', 'descripcion', 'id_curso', 'orden'];
    
    public function curso() {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }
}