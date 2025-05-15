<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    protected $fillable = ['id_matricula', 'monto', 'fecha_pago', 'id_metodo_pago', 'comprobante', 'estado'];
    
    public function matricula() {
        return $this->belongsTo(Matricula::class, 'id_matricula', 'id_matricula');
    }
    
    public function metodoPago() {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago', 'id_metodo_pago');
    }
}