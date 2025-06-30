<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\NivelEducativo;
use App\Models\TemaCurso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('nivelEducativo')->get();
        return view('admin.cursos.index', compact('cursos'));
    }

    public function create()
    {
        $niveles = NivelEducativo::all();
        return view('admin.cursos.create', compact('niveles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'id_nivel' => 'required|exists:niveles_edu,id_nivel',
            'duracion' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        Curso::create($request->all());
        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado exitosamente');
    }

    public function show(Curso $curso)
{
    $curso->load(['nivelEducativo']);
    return view('admin.cursos.show', compact('curso'));
}

    public function edit(Curso $curso)
    {
        $niveles = NivelEducativo::all();
        return view('admin.cursos.edit', compact('curso', 'niveles'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'id_nivel' => 'required|exists:niveles_edu,id_nivel',
            'duracion' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        $curso->update($request->all());
        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado exitosamente');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado exitosamente');
    }

    // Métodos adicionales para temas
    public function temas(Curso $curso)
    {
        return view('admin.cursos.temas', compact('curso'));
    }

    public function storeTema(Request $request, Curso $curso)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer|min:0'
        ]);

        $tema = new TemaCurso();
        $tema->titulo = $request->titulo;
        $tema->descripcion = $request->descripcion;
        $tema->orden = $request->orden ?? 0;
        $tema->id_curso = $curso->id_curso;
        $tema->save();

        return redirect()->route('cursos.temas', $curso->id_curso)
            ->with('success', 'Tema agregado exitosamente');
    }

    public function destroyTema(Curso $curso, TemaCurso $tema)
    {
        $tema->delete();
        return redirect()->route('cursos.temas', $curso->id_curso)
            ->with('success', 'Tema eliminado exitosamente');
    }
}