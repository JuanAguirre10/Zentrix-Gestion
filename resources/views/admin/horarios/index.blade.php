@extends('layouts.app')

@section('title', 'Listado de Horarios')

@section('header', 'Gestión de Horarios')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Horarios</h5>
        <a href="{{ route('horarios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Horario
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
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Salón</th>
                        <th>Cupo Máximo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($horarios as $horario)
                    <tr>
                        <td>{{ $horario->id_horario }}</td>
                        <td>{{ $horario->dia_semana }}</td>
                        <td>{{ date('H:i', strtotime($horario->hora_inicio)) }}</td>
                        <td>{{ date('H:i', strtotime($horario->hora_fin)) }}</td>
                        <td>{{ $horario->salon ?? 'No asignado' }}</td>
                        <td>{{ $horario->cupo_max ?? 'Sin límite' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('horarios.edit', $horario->id_horario) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('horarios.destroy', $horario->id_horario) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este horario?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay horarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection