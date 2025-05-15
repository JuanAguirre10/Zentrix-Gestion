@extends('layouts.app')

@section('title', 'Listado de Apoderados')

@section('header', 'Gestión de Apoderados')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Apoderados</h5>
        <a href="{{ route('apoderados.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Apoderado
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
                        <th>Teléfono/Celular</th>
                        <th>Email</th>
                        <th>Estudiantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apoderados as $apoderado)
                    <tr>
                        <td>{{ $apoderado->id_apoderado }}</td>
                        <td>{{ $apoderado->nombres }}</td>
                        <td>{{ $apoderado->apellidos }}</td>
                        <td>{{ $apoderado->dni ?? 'N/A' }}</td>
                        <td>{{ $apoderado->celular ?? $apoderado->telefono ?? 'N/A' }}</td>
                        <td>{{ $apoderado->email ?? 'N/A' }}</td>
                        <td><span class="badge bg-info">{{ $apoderado->estudiantes_count }}</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('apoderados.show', $apoderado->id_apoderado) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('apoderados.edit', $apoderado->id_apoderado) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('apoderados.destroy', $apoderado->id_apoderado) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este apoderado?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay apoderados registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection