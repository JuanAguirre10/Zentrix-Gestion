@extends('layouts.app')

@section('title', 'Detalles de Apoderado')

@section('header', 'Detalles de Apoderado')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Información del Apoderado</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Nombre completo:</strong> {{ $apoderado->nombres }} {{ $apoderado->apellidos }}</p>
                <p><strong>DNI:</strong> {{ $apoderado->dni ?? 'No registrado' }}</p>
                <p><strong>Teléfono:</strong> {{ $apoderado->telefono ?? 'No registrado' }}</p>
                <p><strong>Celular:</strong> {{ $apoderado->celular ?? 'No registrado' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Email:</strong> {{ $apoderado->email ?? 'No registrado' }}</p>
                <p><strong>Ocupación:</strong> {{ $apoderado->ocupacion ?? 'No registrado' }}</p>
                <p><strong>Dirección:</strong> {{ $apoderado->direccion ?? 'No registrado' }}</p>
                <p><strong>Estudiantes a cargo:</strong> {{ $apoderado->estudiantes->count() }}</p>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('apoderados.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
            <div>
                <a href="{{ route('apoderados.edit', $apoderado->id_apoderado) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>

@if($apoderado->estudiantes->count() > 0)
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Estudiantes a cargo</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Grado</th>
                        <th>Nivel</th>
                        <th>Centro de Estudios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apoderado->estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</td>
                        <td>{{ $estudiante->gradoEscolar->nombre ?? 'N/A' }}</td>
                        <td>{{ $estudiante->gradoEscolar->nivelEducativo->nombre ?? 'N/A' }}</td>
                        <td>{{ $estudiante->centro_estudios ?? 'No registrado' }}</td>
                        <td>
                            <a href="{{ route('estudiantes.show', $estudiante->id_estudiante) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection