<?php

namespace App\Http\Controllers;

use App\Models\Apoderado;
use Illuminate\Http\Request;

class ApoderadoController extends Controller
{
    public function index()
    {
        $apoderados = Apoderado::withCount('estudiantes')->get();
        return view('admin.apoderados.index', compact('apoderados'));
    }

    public function create()
    {
        return view('admin.apoderados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'ocupacion' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255'
        ]);

        Apoderado::create($request->all());
        return redirect()->route('apoderados.index')
            ->with('success', 'Apoderado creado exitosamente');
    }

    public function show(Apoderado $apoderado)
    {
        $apoderado->load('estudiantes.gradoEscolar.nivelEducativo');
        return view('admin.apoderados.show', compact('apoderado'));
    }

    public function edit(Apoderado $apoderado)
    {
        return view('admin.apoderados.edit', compact('apoderado'));
    }

    public function update(Request $request, Apoderado $apoderado)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dni' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'ocupacion' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255'
        ]);

        $apoderado->update($request->all());
        return redirect()->route('apoderados.index')
            ->with('success', 'Apoderado actualizado exitosamente');
    }

    public function destroy(Apoderado $apoderado)
    {
        // Verificar si tiene estudiantes asociados
        if ($apoderado->estudiantes()->count() > 0) {
            return redirect()->route('apoderados.index')
                ->with('error', 'No se puede eliminar el apoderado porque tiene estudiantes asociados');
        }

        $apoderado->delete();
        return redirect()->route('apoderados.index')
            ->with('success', 'Apoderado eliminado exitosamente');
    }
}