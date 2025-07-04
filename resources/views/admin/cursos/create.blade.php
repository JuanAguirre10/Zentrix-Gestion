@extends('layouts.app')

@section('title', 'Nuevo Curso')

@section('header', 'Registrar Nuevo Curso')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Formulario de Registro</h5>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cursos.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="nombre" class="form-label">Nombre del Curso</label>
                    <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" value="{{ old('nombre_curso') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="id_nivel" class="form-label">Nivel Educativo</label>
                    <select class="form-select" id="id_nivel" name="id_nivel" required>
                        <option value="">Seleccionar...</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id_nivel }}" {{ old('id_nivel') == $nivel->id_nivel ? 'selected' : '' }}>
                                {{ $nivel->nombre_nivel }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="duracion" class="form-label">Duración</label>
                    <input type="text" class="form-control" id="duracion" name="duracion" value="{{ old('duracion') }}" placeholder="Ej: 3 meses, 12 semanas">
                </div>
                <div class="col-md-4">
                    <label for="precio" class="form-label">Precio (S/)</label>
                    <div class="input-group">
                        <span class="input-group-text">S/</span>
                        <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" value="{{ old('precio', '0.00') }}" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection