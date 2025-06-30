@extends('layouts.app')

@section('title', 'Listado de Cursos')

@section('header', 'Gestión de Cursos')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Cursos</h5>
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Curso
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
                        <th>Nombre</th>
                        <th>Nivel</th>
                        <th>Duración</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cursos as $curso)
                    <tr> 
                        <td>{{ $curso->id_curso }}</td>
                        <td>{{ $curso->nombre_curso ?? 'N/A' }}</td>
                        <td>{{ $curso->nivelEducativo->nombre_nivel ?? 'N/A' }}</td>
                        <td>{{ $curso->duracion ?? 'No especificado' }}</td>
                        <td>S/ {{ number_format($curso->precio, 2) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('cursos.show', $curso->id_curso) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('cursos.edit', $curso->id_curso) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                    
                                </a>
                                <form action="{{ route('cursos.destroy', $curso->id_curso) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay cursos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection