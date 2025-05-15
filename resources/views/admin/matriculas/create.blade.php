@extends('layouts.app')

@section('title', 'Nueva Matrícula')

@section('header', 'Registrar Nueva Matrícula')

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

        <form action="{{ route('matriculas.store') }}" method="POST" id="formularioMatricula">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_estudiante" class="form-label">Estudiante</label>
                    <select class="form-select" id="id_estudiante" name="id_estudiante" required>
                        <option value="">Seleccionar...</option>
                        @foreach($estudiantes as $estudiante)
                            <option value="{{ $estudiante->id_estudiante }}" {{ old('id_estudiante') == $estudiante->id_estudiante ? 'selected' : '' }}>
                                {{ $estudiante->nombres }} {{ $estudiante->apellidos }} - {{ $estudiante->gradoEscolar->nombre ?? 'Sin grado' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value="{{ old('fecha_registro', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="descuento" class="form-label">Descuento (%)</label>
                    <input type="number" class="form-control" id="descuento" name="descuento" value="{{ old('descuento', 0) }}" min="0" max="100" step="0.1">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Cursos a Matricular</label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaCursos">
                        <thead class="table-light">
                            <tr>
                                <th>Curso</th>
                                <th>Horario</th>
                                <th>Monto (S/)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="fila0">
                                <td>
                                    <select class="form-select curso-select" name="cursos[]" required>
                                        <option value="">Seleccionar...</option>
                                        @foreach($cursos as $curso)
                                            <option value="{{ $curso->id_curso }}" data-precio="{{ $curso->precio }}">
                                                {{ $curso->nombre }} - {{ $curso->nivelEducativo->nombre ?? 'N/A' }}
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
                            </tr>
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
                <div class="col-md-6">
                    <label for="notas" class="form-label">Notas</label>
                    <textarea class="form-control" id="notas" name="notas" rows="3">{{ old('notas') }}</textarea>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Resumen</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotal">S/ 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Descuento:</span>
                                <span id="montoDescuento">S/ 0.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span id="total">S/ 0.00</span>
                            </div>
                            <input type="hidden" name="costo_total" id="costo_total" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
    // Contador para identificar filas
    let contadorFilas = 1;
    
    // Función para agregar una nueva fila de curso
    document.getElementById('agregarCurso').addEventListener('click', function() {
        const tabla = document.getElementById('tablaCursos').getElementsByTagName('tbody')[0];
        const nuevaFila = tabla.insertRow();
        nuevaFila.id = 'fila' + contadorFilas;
        
        // Clonar el contenido de la primera fila
        const primeraFila = document.getElementById('fila0');
        nuevaFila.innerHTML = primeraFila.innerHTML;
        
        // Limpiar los valores seleccionados
        nuevaFila.querySelector('.curso-select').value = '';
        nuevaFila.querySelector('select[name="horarios[]"]').value = '';
        nuevaFila.querySelector('.monto-input').value = '0.00';
        
        contadorFilas++;
        
        // Actualizar eventos en la nueva fila
        actualizarEventos();
    });
    
    // Función para eliminar una fila
    function eliminarFila(boton) {
        // No eliminar si solo queda una fila
        const filas = document.getElementById('tablaCursos').getElementsByTagName('tbody')[0].rows;
        if (filas.length > 1) {
            const fila = boton.closest('tr');
            fila.parentNode.removeChild(fila);
            calcularTotal();
        } else {
            alert('Debe mantener al menos un curso');
        }
    }
    
    // Función para actualizar eventos en todas las filas
    function actualizarEventos() {
        // Actualizar eventos de selección de curso
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
                
                calcularTotal();
            });
        });
        
        // Actualizar eventos de cambio de monto
        document.querySelectorAll('.monto-input').forEach(input => {
            input.addEventListener('change', calcularTotal);
        });
    }
    
    // Calcular el total
    function calcularTotal() {
        let subtotal = 0;
        document.querySelectorAll('.monto-input').forEach(input => {
            subtotal += parseFloat(input.value || 0);
        });
        
        const descuentoPorcentaje = parseFloat(document.getElementById('descuento').value || 0);
        const montoDescuento = subtotal * (descuentoPorcentaje / 100);
        const total = subtotal - montoDescuento;
        
        document.getElementById('subtotal').textContent = 'S/ ' + subtotal.toFixed(2);
        document.getElementById('montoDescuento').textContent = 'S/ ' + montoDescuento.toFixed(2);
        document.getElementById('total').textContent = 'S/ ' + total.toFixed(2);
        document.getElementById('costo_total').value = total.toFixed(2);
    }
    
    // Evento de cambio en el descuento
    document.getElementById('descuento').addEventListener('change', calcularTotal);
    
    // Inicializar eventos
    actualizarEventos();
    
    // Validar formulario antes de enviar
    document.getElementById('formularioMatricula').addEventListener('submit', function(e) {
        const montos = document.querySelectorAll('.monto-input');
        let total = 0;
        
        montos.forEach(input => {
            total += parseFloat(input.value || 0);
        });
        
        if (total <= 0) {
            e.preventDefault();
            alert('El monto total debe ser mayor a cero');
        }
    });
</script>
@endsection