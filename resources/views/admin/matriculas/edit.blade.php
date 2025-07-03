@extends('layouts.app')

@section('title', 'Editar Matrícula')

@section('header', 'Editar Matrícula')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Formulario de Edición</h5>
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

        <form action="{{ route('matriculas.update', $matricula->id_matricula) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_estudiante" class="form-label">Estudiante</label>
                    <select class="form-select" id="id_estudiante" name="id_estudiante" required>
                        <option value="">Seleccionar...</option>
                        @foreach($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id_estudiante }}" 
                                {{ old('id_estudiante', $matricula->id_estudiante) == $estudiante->id_estudiante ? 'selected' : '' }}>
                                {{ $estudiante->nombres }} {{ $estudiante->apellidos }} - {{ $estudiante->gradoEscolar->nombre_grado ?? 'Sin grado' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fecha_registro" class="form-label">Fecha de Matrícula</label>
                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" 
                           value="{{ old('fecha_registro', $matricula->fecha_matricula) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="descuento" class="form-label">Descuento (%)</label>
                    <input type="number" class="form-control" id="descuento" name="descuento" 
                           value="{{ old('descuento', $matricula->descuento_porcentaje) }}" min="0" max="100" step="0.1">
                </div>
            </div>

            <!-- Cursos Matriculados -->
            <div class="mb-3">
                <label class="form-label">Cursos Matriculados</label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaCursos">
                        <thead class="table-light">
                            <tr>
                                <th>Curso</th>
                                <th>Horario</th>
                                <th>Precio (S/)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($matricula->detallesMatricula as $index => $detalle)
                                <tr id="fila{{ $index }}">
                                    <td>
                                        <select class="form-select curso-select" name="cursos[]" required>
                                            <option value="">Seleccionar...</option>
                                            @foreach($cursos as $curso)
                                                <option value="{{ $curso->id_curso }}" 
                                                    data-precio="{{ $curso->precio }}"
                                                    {{ $detalle->id_curso == $curso->id_curso ? 'selected' : '' }}>
                                                    {{ $curso->nombre_curso }} - {{ $curso->nivelEducativo->nombre_nivel ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select" name="horarios[]" required>
                                            <option value="">Seleccionar...</option>
                                            @foreach($horarios as $horario)
                                                <option value="{{ $horario->id_horario }}"
                                                    {{ $detalle->id_horario == $horario->id_horario ? 'selected' : '' }}>
                                                    {{ $horario->dia_semana }} {{ date('H:i', strtotime($horario->hora_inicio)) }} - {{ date('H:i', strtotime($horario->hora_fin)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text">S/</span>
                                            <input type="number" step="0.01" min="0" class="form-control monto-input" 
                                                   name="montos[]" value="{{ $detalle->precio_curso }}" required>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr id="fila0">
                                    <td>
                                        <select class="form-select curso-select" name="cursos[]" required>
                                            <option value="">Seleccionar...</option>
                                            @foreach($cursos as $curso)
                                                <option value="{{ $curso->id_curso }}" data-precio="{{ $curso->precio }}">
                                                    {{ $curso->nombre_curso }} - {{ $curso->nivelEducativo->nombre_nivel ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-select" name="horarios[]" required>
                                            <option value="">Seleccionar...</option>
                                            @foreach($horarios as $horario)
                                                <option value="{{ $horario->id_horario }}">
                                                    {{ $horario->dia_semana }} {{ date('H:i', strtotime($horario->hora_inicio)) }} - {{ date('H:i', strtotime($horario->hora_fin)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text">S/</span>
                                            <input type="number" step="0.01" min="0" class="form-control monto-input" 
                                                   name="montos[]" value="0.00" required>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success btn-sm" id="agregarCurso">
                        <i class="fas fa-plus me-1"></i> Agregar Curso
                    </button>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="activa" {{ old('estado', $matricula->estado) == 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="finalizada" {{ old('estado', $matricula->estado) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                        <option value="cancelada" {{ old('estado', $matricula->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        <option value="suspendida" {{ old('estado', $matricula->estado) == 'suspendida' ? 'selected' : '' }}>Suspendida</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="notas" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="notas" name="notas" rows="3">{{ old('notas', $matricula->observaciones) }}</textarea>
                </div>
            </div>

            <!-- Resumen de pagos -->
            <div class="mb-3">
                <h6>Estado de Pagos</h6>
                @php
                    $totalPagado = $matricula->pagos->where('estado', 'completado')->sum('monto');
                    $porcentajePagado = $matricula->monto_total > 0 ? ($totalPagado / $matricula->monto_total) * 100 : 0;
                    $saldoPendiente = $matricula->monto_total - $totalPagado;
                @endphp
                
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" 
                         style="width: {{ $porcentajePagado }}%" 
                         aria-valuenow="{{ $porcentajePagado }}" aria-valuemin="0" aria-valuemax="100">
                         {{ number_format($porcentajePagado, 1) }}%
                    </div>
                </div>
                
                <div class="row text-center">
                    <div class="col-4">
                        <small class="text-muted">Total</small><br>
                        <strong>S/ {{ number_format($matricula->monto_total, 2) }}</strong>
                    </div>
                    <div class="col-4">
                        <small class="text-muted">Pagado</small><br>
                        <strong class="text-success">S/ {{ number_format($totalPagado, 2) }}</strong>
                    </div>
                    <div class="col-4">
                        <small class="text-muted">Pendiente</small><br>
                        <strong class="text-danger">S/ {{ number_format($saldoPendiente, 2) }}</strong>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('matriculas.show', $matricula) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Matrícula
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Contador para identificar filas
    let contadorFilas = {{ count($matricula->detallesMatricula) }};
    
    // Función para agregar una nueva fila de curso
    document.getElementById('agregarCurso').addEventListener('click', function() {
        const tabla = document.getElementById('tablaCursos').getElementsByTagName('tbody')[0];
        const nuevaFila = tabla.insertRow();
        nuevaFila.id = 'fila' + contadorFilas;
        
        // Contenido de la nueva fila
        nuevaFila.innerHTML = `
            <td>
                <select class="form-select curso-select" name="cursos[]" required>
                    <option value="">Seleccionar...</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id_curso }}" data-precio="{{ $curso->precio }}">
                            {{ $curso->nombre_curso }} - {{ $curso->nivelEducativo->nombre_nivel ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-select" name="horarios[]" required>
                    <option value="">Seleccionar...</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id_horario }}">
                            {{ $horario->dia_semana }} {{ date('H:i', strtotime($horario->hora_inicio)) }} - {{ date('H:i', strtotime($horario->hora_fin)) }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text">S/</span>
                    <input type="number" step="0.01" min="0" class="form-control monto-input" name="montos[]" value="0.00" required>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        
        contadorFilas++;
        actualizarEventos();
    });
    
    // Función para eliminar una fila
    function eliminarFila(boton) {
        const filas = document.getElementById('tablaCursos').getElementsByTagName('tbody')[0].rows;
        if (filas.length > 1) {
            const fila = boton.closest('tr');
            fila.parentNode.removeChild(fila);
        } else {
            alert('Debe mantener al menos un curso');
        }
    }
    
    // Función para actualizar eventos en todas las filas
    function actualizarEventos() {
        document.querySelectorAll('.curso-select').forEach(select => {
            select.addEventListener('change', function() {
                const fila = this.closest('tr');
                const precioInput = fila.querySelector('.monto-input');
                const opcionSeleccionada = this.options[this.selectedIndex];
                
                if (opcionSeleccionada.value !== '') {
                    const precio = opcionSeleccionada.getAttribute('data-precio');
                    precioInput.value = precio;
                } else {
                    precioInput.value = '0.00';
                }
            });
        });
    }
    
    // Inicializar eventos
    actualizarEventos();
</script>
@endsection