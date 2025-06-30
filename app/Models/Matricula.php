<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    
    protected $table = 'matriculas';
    protected $primaryKey = 'id_matricula';
    
    protected $fillable = [
        'id_estudiante', 
        'fecha_matricula',  // Cambiado de fecha_registro
        'estado', 
        'descuento_porcentaje',  // Cambiado de descuento
        'monto_total',  // Cambiado de costo_total
        'observaciones'  // Cambiado de notas
    ];
    
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_estudiante');
    }
    
    public function detallesMatricula()
    {
        return $this->hasMany(DetalleMatricula::class, 'id_matricula', 'id_matricula');
    }
    
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_matricula', 'id_matricula');
    }
    
    // Accessor para compatibilidad con vistas que usan costo_total
    public function getCostoTotalAttribute()
    {
        return $this->monto_total;
    }
    
    // Accessor para compatibilidad con vistas que usan fecha_registro
    public function getFechaRegistroAttribute()
    {
        return $this->fecha_matricula;
    }
    
    // Accessor para compatibilidad con vistas que usan notas
    public function getNotasAttribute()
    {
        return $this->observaciones;
    }
    
    // Accessor para compatibilidad con vistas que usan descuento
    public function getDescuentoAttribute()
    {
        return $this->descuento_porcentaje;
    }
    
    // Total pagado
    public function getTotalPagadoAttribute()
    {
        return $this->pagos()->where('estado', 'completado')->sum('monto');
    }
    
    // Saldo pendiente
    public function getSaldoPendienteAttribute()
    {
        return max(0, $this->monto_total - $this->total_pagado);
    }
}