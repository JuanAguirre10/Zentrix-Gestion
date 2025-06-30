<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMatricula extends Model
{
    use HasFactory;
    
    protected $table = 'detalles_matricula';
    protected $primaryKey = 'id_detalle';
    
    protected $fillable = [
        'id_matricula', 
        'id_curso', 
        'precio_curso', 
        'descuento_aplicado', 
        'subtotal'
    ];
    
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'id_matricula', 'id_matricula');
    }
    
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }
    
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');
    }
    
    // Accessor para compatibilidad con la vista
    public function getMontoAttribute()
    {
        return $this->subtotal;
    }
}