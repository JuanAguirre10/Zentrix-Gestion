@extends('layouts.app')

@section('title', 'Detalles del Curso')

@section('header', 'Detalles del Curso')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Información del Curso</h5>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nombre del Curso:</strong></td>
                        <td>{{ $curso->nombre_curso }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nivel Educativo:</strong></td>
                        <td>{{ $curso->nivelEducativo->nombre_nivel ?? 'No asignado' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Duración:</strong></td>
                        <td>{{ $curso->duracion ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Precio:</strong></td>
                        <td>S/ {{ number_format($curso->precio, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Estado:</strong></td>
                        <td>
                            @if($curso->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Fecha de Creación:</strong></td>
                        <td>{{ $curso->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($curso->descripcion)
        <div class="row mt-3">
            <div class="col-12">
                <h6>Descripción:</h6>
                <p class="text-muted">{{ $curso->descripcion }}</p>
            </div>
        </div>
        @endif

        <div class="row mt-4">
            <div class="col-12">
                <div class="btn-group" role="group">
                    <a href="{{ route('cursos.edit', $curso->id_curso) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                    <form action="{{ route('cursos.destroy', $curso->id_curso) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                            <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection