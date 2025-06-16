<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Apoderado;
use App\Models\GradoEscolar;
use App\Models\NivelEducativo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstudianteController extends Controller
{
    // ✅ CONSTRUCTOR AL INICIO DE LA CLASE
    public function __construct()
    {
        // Aplicar middleware a todas las funciones
        $this->middleware(['auth', 'active']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('role:admin,teacher')->only(['index', 'show']);
       
        
    }

    public function index()
    {
        $estudiantes = Estudiante::with(['apoderado', 'gradoEscolar.nivelEducativo'])->get();
        return view('admin.estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $apoderados = Apoderado::all();
        $grados = GradoEscolar::with('nivelEducativo')->get();
        return view('admin.estudiantes.create', compact('apoderados', 'grados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'id_apoderado' => 'required|exists:apoderados,id_apoderado',
            'id_grado' => 'required|exists:grados_escolar,id_grado',
            'centro_estudios' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string'
        ]);

        Estudiante::create($request->all());
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante creado exitosamente');
    }

    public function show(Estudiante $estudiante)
    {
        $estudiante->load(['apoderado', 'gradoEscolar.nivelEducativo', 'matriculas.detallesMatricula.curso']);
        return view('admin.estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $apoderados = Apoderado::all();
        $grados = GradoEscolar::with('nivelEducativo')->get();
        return view('admin.estudiantes.edit', compact('estudiante', 'apoderados', 'grados'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'id_apoderado' => 'required|exists:apoderados,id_apoderado',
            'id_grado' => 'required|exists:grados_escolar,id_grado',
            'centro_estudios' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string'
        ]);

        $estudiante->update($request->all());
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado exitosamente');
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado exitosamente');
    }
}