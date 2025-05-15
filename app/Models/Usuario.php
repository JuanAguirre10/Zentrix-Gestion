<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['username', 'email', 'password', 'tipo_usuario', 'estado'];
    
    protected $hidden = ['password', 'remember_token'];
}