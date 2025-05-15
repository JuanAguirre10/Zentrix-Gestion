@extends('layouts.app')

@section('title', 'Listado de Pagos')

@section('header', 'Gestión de Pagos')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Pagos</h5>
        <a href="{{ route('pagos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Pago
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estudiante</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Método de Pago</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id_pago }}</td>
                        <td>{{ $pago->matricula->estudiante->nombres ?? 'N/A' }} {{ $pago->matricula->estudiante->apellidos ?? '' }}</td>
                        <td>{{ date('d/m/Y', strtotime($pago->fecha_pago)) }}</td>
                        <td>S/ {{ number_format($pago->monto, 2) }}</td>
                        <td>{{ $pago->metodoPago->nombre ?? 'N/A' }}</td>
                        <td>
                            @if($pago->estado == 'completado')
                                <span class="badge bg-success">Completado</span>
                            @elseif($pago->estado == 'pendiente')
                                <span class="badge bg-warning">Pendiente</span>
                            @else
                                <span class="badge bg-danger">Anulado</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('pagos.show', $pago->id_pago) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pagos.edit', $pago->id_pago) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pagos.destroy', $pago->id_pago) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este pago?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay pagos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection