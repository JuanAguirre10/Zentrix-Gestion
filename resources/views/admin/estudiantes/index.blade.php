@extends('layouts.app')

@section('title', 'Listado de Estudiantes')

@section('header', 'Gestión de Estudiantes')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Estudiantes</h5>
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Estudiante
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
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Grado</th>
                        <th>Nivel</th>
                        <th>Apoderado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->id_estudiante }}</td>
                        <td>{{ $estudiante->nombres }}</td>
                        <td>{{ $estudiante->apellidos }}</td>
                        <td>{{ $estudiante->dni ?? 'N/A' }}</td>
                        <td>{{ $estudiante->gradoEscolar->nombre ?? 'N/A' }}</td>
                        <td>{{ $estudiante->gradoEscolar->nivelEducativo->nombre ?? 'N/A' }}</td>
                        <td>{{ $estudiante->apoderado->nombres ?? 'N/A' }} {{ $estudiante->apoderado->apellidos ?? '' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('estudiantes.show', $estudiante->id_estudiante) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('estudiantes.edit', $estudiante->id_estudiante) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('estudiantes.destroy', $estudiante->id_estudiante) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay estudiantes registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection