<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    // Verificar si es administrador
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Verificar si es profesor
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    // Verificar si es estudiante
    public function isStudent()
    {
        return $this->role === 'student';
    }

    // Verificar si tiene un rol específico
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Verificar si tiene cualquiera de los roles especificados
    public function hasAnyRole(array $roles)
    {
        return in_array($this->role, $roles);
    }

    // Verificar si está activo
    public function isActive()
    {
        return $this->active;
    }
}