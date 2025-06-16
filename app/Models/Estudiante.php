<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    
    protected $table = 'estudiantes';
    protected $primaryKey = 'id_estudiante';
    protected $fillable = [
        'nombres', 
        'apellidos', 
        'dni', 
        'fecha_nacimiento', 
        'id_apoderado', 
        'id_grado', 
        'centro_estudios', 
        'observaciones',
        'activo'
    ];
    
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo' => 'boolean',
    ];

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }

    // Relación con Apoderado
    public function apoderado()
    {
        return $this->belongsTo(Apoderado::class, 'id_apoderado', 'id_apoderado');
    }

    // Relación con GradoEscolar
    public function gradoEscolar()
    {
        return $this->belongsTo(GradoEscolar::class, 'id_grado', 'id_grado');
    }

    // Relación con Matriculas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_estudiante', 'id_estudiante');
    }

    // Relación con Evaluaciones
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'id_estudiante', 'id_estudiante');
    }

    // Relación muchos a muchos con Curso
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'estudiante_curso', 'estudiante_id', 'curso_id')
            ->using('App\Models\EstudianteCurso')
            ->withPivot('fecha_inscripcion', 'estado', 'nota_final', 'observaciones')
            ->withTimestamps();
    }

    // Relación con asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'id_estudiante', 'id_estudiante');
    }

    // Scope para filtrar por nivel educativo
    public function scopePorNivel($query, $nivelId)
    {
        return $query->whereHas('gradoEscolar', function ($q) use ($nivelId) {
            $q->where('id_nivel', $nivelId);
        });
    }

    // Scope para buscar estudiantes
    public function scopeBuscar($query, $termino)
    {
        return $query->where(function ($q) use ($termino) {
            $q->where('nombres', 'like', "%{$termino}%")
              ->orWhere('apellidos', 'like', "%{$termino}%")
              ->orWhere('dni', 'like', "%{$termino}%");
        });
    }

    // Scope para estudiantes activos
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Scope para filtrar por grado
    public function scopePorGrado($query, $gradoId)
    {
        return $query->where('id_grado', $gradoId);
    }

    // Scope para filtrar por apoderado
    public function scopePorApoderado($query, $apoderadoId)
    {
        return $query->where('id_apoderado', $apoderadoId);
    }

    // Scope para filtrar por rango de edad
    public function scopePorEdad($query, $edadMin = null, $edadMax = null)
    {
        if ($edadMin) {
            $query->whereDate('fecha_nacimiento', '<=', now()->subYears($edadMin));
        }
        if ($edadMax) {
            $query->whereDate('fecha_nacimiento', '>=', now()->subYears($edadMax + 1));
        }
        return $query;
    }

    // Scope para filtrar por centro de estudios
    public function scopePorCentroEstudios($query, $centro)
    {
        return $query->where('centro_estudios', 'like', "%{$centro}%");
    }

    // Método para obtener promedio de notas
    public function getPromedioNotasAttribute()
    {
        return $this->cursos()
            ->whereNotNull('estudiante_curso.nota_final')
            ->avg('estudiante_curso.nota_final');
    }

    // Método para obtener cursos activos
    public function getCursosActivosAttribute()
    {
        return $this->cursos()->wherePivot('estado', 'activo')->get();
    }

    // Método para obtener edad
    public function getEdadAttribute()
    {
        return $this->fecha_nacimiento ? $this->fecha_nacimiento->age : null;
    }

    // Método para verificar si tiene matrículas activas
    public function tieneMatriculasActivas()
    {
        return $this->matriculas()->where('estado', 'activa')->exists();
    }

    // Método para obtener el nivel educativo
    public function getNivelEducativoAttribute()
    {
        return $this->gradoEscolar ? $this->gradoEscolar->nivelEducativo : null;
    }

    // Método para obtener total de pagos realizados
    public function getTotalPagosAttribute()
    {
        return $this->matriculas->flatMap->pagos->where('estado', 'completado')->sum('monto');
    }

    // Método para verificar si está al día con los pagos
    public function estaAlDiaConPagos()
    {
        $matriculasActivas = $this->matriculas()->where('estado', 'activa')->get();
        
        foreach ($matriculasActivas as $matricula) {
            $totalPagado = $matricula->pagos()->where('estado', 'completado')->sum('monto');
            if ($totalPagado < $matricula->monto_total) {
                return false;
            }
        }
        
        return true;
    }
}