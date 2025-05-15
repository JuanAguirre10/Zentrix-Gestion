<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;
    
    protected $table = 'apoderados';
    protected $primaryKey = 'id_apoderado';
    protected $fillable = ['nombres', 'apellidos', 'dni', 'telefono', 'celular', 'direccion', 'ocupacion', 'email'];
    
    public function estudiantes() {
        return $this->hasMany(Estudiante::class, 'id_apoderado', 'id_apoderado');
    }
}