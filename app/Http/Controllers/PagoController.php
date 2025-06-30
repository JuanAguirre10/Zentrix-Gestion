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
    $matriculas = Matricula::with('estudiante')->get();
    return view('admin.pagos.create', compact('matriculas'));
}

   public function store(Request $request)
{
    $request->validate([
        'id_matricula' => 'required|exists:matriculas,id_matricula',
        'monto' => 'required|numeric|min:0',
        'fecha_pago' => 'required|date',
        'metodo_pago' => 'required|string|in:efectivo,tarjeta,transferencia,deposito',
        'comprobante' => 'nullable|string|max:255',
        'estado' => 'required|in:pendiente,completado,anulado',
        'observaciones' => 'nullable|string'
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
    $matriculas = Matricula::all();
    return view('admin.pagos.edit', compact('pago', 'matriculas'));
}

   public function update(Request $request, Pago $pago)
{
    $request->validate([
        'id_matricula' => 'required|exists:matriculas,id_matricula',
        'monto' => 'required|numeric|min:0',
        'fecha_pago' => 'required|date',
        'metodo_pago' => 'required|string|in:efectivo,tarjeta,transferencia,deposito',
        'comprobante' => 'nullable|string|max:255',
        'estado' => 'required|in:pendiente,completado,anulado',
        'observaciones' => 'nullable|string'
    ]);

    $pago->update($request->all());
    return redirect()->route('pagos.show', $pago->id_pago)
        ->with('success', 'Pago actualizado exitosamente');
}

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')
            ->with('success', 'Pago eliminado exitosamente');
    }
    
    
}