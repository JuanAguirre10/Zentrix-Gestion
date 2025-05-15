@extends('layouts.app')

@section('title', 'Listado de Matrículas')

@section('header', 'Gestión de Matrículas')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Matrículas</h5>
        <a href="{{ route('matriculas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nueva Matrícula
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
                        <th>Fecha Registro</th>
                        <th>Cursos</th>
                        <th>Estado</th>
                        <th>Costo Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matriculas as $matricula)
                    <tr>
                        <td>{{ $matricula->id_matricula }}</td>
                        <td>{{ $matricula->estudiante->nombres ?? 'N/A' }} {{ $matricula->estudiante->apellidos ?? '' }}</td>
                        <td>{{ date('d/m/Y', strtotime($matricula->fecha_registro)) }}</td>
                        <td>
                            <span class="badge bg-info">{{ $matricula->detallesMatricula->count() }}</span>
                        </td>
                        <td>
                            @if($matricula->estado == 'activa')
                                <span class="badge bg-success">Activa</span>
                            @elseif($matricula->estado == 'finalizada')
                                <span class="badge bg-secondary">Finalizada</span>
                            @else
                                <span class="badge bg-danger">Cancelada</span>
                            @endif
                        </td>
                        <td>S/ {{ number_format($matricula->costo_total, 2) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('matriculas.show', $matricula->id_matricula) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('matriculas.edit', $matricula->id_matricula) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('matriculas.destroy', $matricula->id_matricula) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta matrícula?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay matrículas registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection