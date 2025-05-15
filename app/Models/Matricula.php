<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    
    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';
    protected $fillable = ['id_estudiante', 'fecha_registro', 'estado', 'descuento', 'costo_total', 'notas'];
    
    public function estudiante() {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_estudiante');
    }
    
    public function detallesMatricula() {
        return $this->hasMany(DetalleMatricula::class, 'id_matricula', 'id_matricula');
    }
    
    public function pagos() {
        return $this->hasMany(Pago::class, 'id_matricula', 'id_matricula');
    }
    
    // Total pagado
    public function getTotalPagadoAttribute() {
        return $this->pagos()->where('estado', 'completado')->sum('monto');
    }
    
    // Saldo pendiente
    public function getSaldoPendienteAttribute() {
        return $this->costo_total - $this->total_pagado;
    }
}