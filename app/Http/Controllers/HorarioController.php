<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::all();
        return view('admin.horarios.index', compact('horarios'));
    }

    public function create()
    {
        return view('admin.horarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia_semana' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
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
            'dia_semana' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
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
}