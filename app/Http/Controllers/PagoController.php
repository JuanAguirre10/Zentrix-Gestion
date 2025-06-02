<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Matricula;
use App\Models\MetodoPago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with(['matricula.estudiante', 'metodoPago'])->get();
        return view('admin.pagos.index', compact('pagos'));
    }

    public function create()
    {
        $matriculas = Matricula::with('estudiante')->where('estado', 'activa')->get();
        $metodos_pago = MetodoPago::all();
        return view('admin.pagos.create', compact('matriculas', 'metodos_pago'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_matricula' => 'required|exists:matriculas,id_matricula',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'id_metodo_pago' => 'required|exists:metodos_pago,id_metodo_pago',
            'comprobante' => 'nullable|string|max:255',
            'estado' => 'required|in:pendiente,completado,anulado'
        ]);

        Pago::create($request->all());
        return redirect()->route('pagos.index')
            ->with('success', 'Pago registrado exitosamente');
    }

    public function show(Pago $pago)
{
    $pago->load(['matricula.estudiante.apoderado', 'matricula.estudiante.gradoEscolar', 'matricula.pagos']);
    return view('admin.pagos.show', compact('pago'));
}

    public function edit(Pago $pago)
    {
        $matriculas = Matricula::with('estudiante')->get();
        $metodos_pago = MetodoPago::all();
        return view('admin.pagos.edit', compact('pago', 'matriculas', 'metodos_pago'));
    }

    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'id_matricula' => 'required|exists:matriculas,id_matricula',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'id_metodo_pago' => 'required|exists:metodos_pago,id_metodo_pago',
            'comprobante' => 'nullable|string|max:255',
            'estado' => 'required|in:pendiente,completado,anulado'
        ]);

        $pago->update($request->all());
        return redirect()->route('pagos.index')
            ->with('success', 'Pago actualizado exitosamente');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')
            ->with('success', 'Pago eliminado exitosamente');
    }
}