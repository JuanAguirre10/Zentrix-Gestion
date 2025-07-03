<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Curso;
use App\Models\DetalleMatricula;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index(Request $request)
{
    $cursos = \App\Models\Curso::with('nivelEducativo')->orderBy('nombre_curso')->get();
    $cursoSeleccionado = $request->curso_id;
    
    if ($cursoSeleccionado) {
        // Horarios filtrados por curso con información detallada
        $curso = \App\Models\Curso::findOrFail($cursoSeleccionado);
        
        $horarios = Horario::whereHas('detallesMatricula', function($query) use ($cursoSeleccionado) {
            $query->whereHas('curso', function($q) use ($cursoSeleccionado) {
                $q->where('id_curso', $cursoSeleccionado);
            });
        })
        ->with(['detallesMatricula' => function($query) use ($cursoSeleccionado) {
            $query->whereHas('curso', function($q) use ($cursoSeleccionado) {
                $q->where('id_curso', $cursoSeleccionado);
            })->with(['matricula.estudiante', 'curso']);
        }])
        ->get();
        
        // Calcular estadísticas para cada horario
        foreach ($horarios as $horario) {
            $horario->estudiantes_matriculados = $horario->detallesMatricula->count();
            $horario->cupos_disponibles = $horario->cupo_max - $horario->estudiantes_matriculados;
            $horario->porcentaje_ocupacion = $horario->cupo_max > 0 ? 
                round(($horario->estudiantes_matriculados / $horario->cupo_max) * 100, 1) : 0;
        }
        
        return view('admin.horarios.index', compact('horarios', 'cursos', 'cursoSeleccionado', 'curso'));
    } else {
        // Todos los horarios (vista simple)
        $horarios = Horario::orderBy('dia_semana')->orderBy('hora_inicio')->get();
        return view('admin.horarios.index', compact('horarios', 'cursos', 'cursoSeleccionado'));
    }
}

    public function create()
    {
        return view('admin.horarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia_semana' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'cupo_max' => 'nullable|integer|min:1',
            'salon' => 'nullable|string|max:50'
        ]);

        Horario::create($request->all());
        return redirect()->route('horarios.index')
            ->with('success', 'Horario creado exitosamente');
    }

    public function edit(Horario $horario)
    {
        return view('admin.horarios.edit', compact('horario'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'dia_semana' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'cupo_max' => 'nullable|integer|min:1',
            'salon' => 'nullable|string|max:50'
        ]);

        $horario->update($request->all());
        return redirect()->route('horarios.index')
            ->with('success', 'Horario actualizado exitosamente');
    }

    public function destroy(Horario $horario)
    {
        // Verificar si tiene detalles de matrícula asociados
        if ($horario->detallesMatricula()->count() > 0) {
            return redirect()->route('horarios.index')
                ->with('error', 'No se puede eliminar el horario porque tiene matrículas asociadas');
        }

        $horario->delete();
        return redirect()->route('horarios.index')
            ->with('success', 'Horario eliminado exitosamente');
    }
    public function show(Horario $horario) 
{
    $horario->load(['detallesMatricula.matricula.estudiante', 'detallesMatricula.curso']);
    return view('admin.horarios.show', compact('horario')); 
}
}