<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\DetalleMatricula;
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Horario;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with(['estudiante', 'detallesMatricula.curso'])->get();
        return view('admin.matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        $estudiantes = Estudiante::with('gradoEscolar.nivelEducativo')->get();
        $cursos = Curso::with('nivelEducativo')->get();
        $horarios = Horario::all();
        return view('admin.matriculas.create', compact('estudiantes', 'cursos', 'horarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_estudiante' => 'required|exists:estudiantes,id_estudiante',
            'fecha_registro' => 'required|date',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'costo_total' => 'required|numeric|min:0',
            'cursos' => 'required|array|min:1',
            'cursos.*' => 'exists:cursos,id_curso',
            'horarios' => 'required|array|min:1',
            'horarios.*' => 'exists:horarios,id_horario',
            'montos' => 'required|array|min:1',
            'montos.*' => 'numeric|min:0',
            'notas' => 'nullable|string'
        ]);

        // Crear la matrícula
        $matricula = new Matricula();
        $matricula->id_estudiante = $request->id_estudiante;
        $matricula->fecha_registro = $request->fecha_registro;
        $matricula->descuento = $request->descuento ?? 0;
        $matricula->costo_total = $request->costo_total;
        $matricula->notas = $request->notas;
        $matricula->estado = 'activa';
        $matricula->save();

        // Crear los detalles de matrícula
        foreach ($request->cursos as $key => $curso_id) {
            $detalle = new DetalleMatricula();
            $detalle->id_matricula = $matricula->id_matricula;
            $detalle->id_curso = $curso_id;
            $detalle->id_horario = $request->horarios[$key];
            $detalle->monto = $request->montos[$key];
            $detalle->save();
        }

        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula creada exitosamente');
    }

    public function show(Matricula $matricula)
    {
        $matricula->load(['estudiante.apoderado', 'detallesMatricula.curso', 'detallesMatricula.horario', 'pagos']);
        return view('admin.matriculas.show', compact('matricula'));
    }

    public function edit(Matricula $matricula)
    {
        $estudiantes = Estudiante::all();
        $cursos = Curso::all();
        $horarios = Horario::all();
        $matricula->load(['detallesMatricula.curso', 'detallesMatricula.horario']);
        return view('admin.matriculas.edit', compact('matricula', 'estudiantes', 'cursos', 'horarios'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'id_estudiante' => 'required|exists:estudiantes,id_estudiante',
            'fecha_registro' => 'required|date',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'costo_total' => 'required|numeric|min:0',
            'estado' => 'required|in:activa,finalizada,cancelada',
            'notas' => 'nullable|string'
        ]);

        $matricula->update($request->all());
        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula actualizada exitosamente');
    }

    public function destroy(Matricula $matricula)
    {
        // Verificar si tiene pagos asociados
        if ($matricula->pagos()->count() > 0) {
            return redirect()->route('matriculas.index')
                ->with('error', 'No se puede eliminar la matrícula porque tiene pagos asociados');
        }

        // Eliminar los detalles de matrícula
        $matricula->detallesMatricula()->delete();
        
        // Eliminar la matrícula
        $matricula->delete();
        
        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula eliminada exitosamente');
    }
}