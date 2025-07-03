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
    // Obtener todos los apoderados excepto "Sin Apoderado"
    $apoderados = Apoderado::where('id_apoderado', '!=', 1)
                          ->orderBy('nombres', 'asc')
                          ->get();
    
    // Obtener el apoderado "Sin Apoderado" para ponerlo primero
    $sinApoderado = Apoderado::find(1);
    
    // Crear la colección final con "Sin Apoderado" primero
    $apoderadosCompletos = collect([$sinApoderado])->concat($apoderados);
    
    // Obtener grados con la columna correcta
    $grados = GradoEscolar::select('id_grado', 'nombre_grado', 'descripcion', 'id_nivel')
                          ->where('activo', 1)
                          ->orderBy('nombre_grado', 'asc')
                          ->get();
    
    return view('admin.estudiantes.create', compact('apoderadosCompletos', 'grados'));
}

    public function store(Request $request)
    {
        $request->validate([
        'nombres' => 'required|string|max:100',
        'apellidos' => 'required|string|max:100',
        'dni' => 'nullable|string|max:20',
        'fecha_nacimiento' => 'nullable|date',
        'id_apoderado' => 'nullable|exists:apoderados,id_apoderado',
        'id_grado' => 'required|exists:grados_escolar,id_grado',
        'centro_estudios' => 'nullable|string|max:255',
        'observaciones' => 'nullable|string'
    ]);

    // Si no se selecciona apoderado o se selecciona "Sin Apoderado", asignar ID 1
    if (!$request->id_apoderado || $request->id_apoderado == 1) {
        $request->merge(['id_apoderado' => 1]);
    }

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
    // Obtener todos los apoderados excepto "Sin Apoderado"
    $apoderados = Apoderado::where('id_apoderado', '!=', 1)
                          ->orderBy('nombres', 'asc')
                          ->get();
    
    // Obtener el apoderado "Sin Apoderado" para ponerlo primero
    $sinApoderado = Apoderado::find(1);
    
    // Crear la colección final con "Sin Apoderado" primero
    $apoderadosCompletos = collect([$sinApoderado])->concat($apoderados);
    
    // Obtener grados con la columna correcta
    $grados = GradoEscolar::select('id_grado', 'nombre_grado', 'descripcion', 'id_nivel')
                          ->where('activo', 1)
                          ->orderBy('nombre_grado', 'asc')
                          ->get();
    
    return view('admin.estudiantes.edit', compact('estudiante', 'apoderadosCompletos', 'grados'));
}

    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
        'nombres' => 'required|string|max:100',
        'apellidos' => 'required|string|max:100',
        'dni' => 'nullable|string|max:20',
        'fecha_nacimiento' => 'nullable|date',
        'id_apoderado' => 'nullable|exists:apoderados,id_apoderado',
        'id_grado' => 'required|exists:grados_escolar,id_grado',
        'centro_estudios' => 'nullable|string|max:255',
        'observaciones' => 'nullable|string'
    ]);

    // Si no se selecciona apoderado o se selecciona "Sin Apoderado", asignar ID 1
    if (!$request->id_apoderado || $request->id_apoderado == 1) {
        $request->merge(['id_apoderado' => 1]);
    }

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