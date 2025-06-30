@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        
        <!-- Contenido Principal -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Detalles de la Matrícula</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                        <a href="{{ route('matriculas.edit', $matricula) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('pagos.create') }}?matricula={{ $matricula->id_matricula }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nuevo Pago
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información de la Matrícula -->
            <div class="row">
                <!-- Datos de la Matrícula -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Información de la Matrícula</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID Matrícula:</strong></td>
                                    <td>{{ $matricula->id_matricula }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Registro:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Costo Total:</strong></td>
                                    <td>
                                        <span class="h3 text-primary">
                                            S/ {{ number_format($matricula->monto_total ?? 0, 2) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Descuento:</strong></td>
                                    <td>
                                        @if($matricula->descuento_porcentaje > 0)
                                            <span class="text-success">{{ $matricula->descuento_porcentaje }}%</span>
                                        @else
                                            <span class="text-muted">Sin descuento</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        {{ ucfirst($matricula->estado) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Creación:</strong></td>
                                    <td>{{ $matricula->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $matricula->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Resumen Visual -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Resumen Financiero</h5>
                        </div>
                        <div class="card-body text-center">
                            @php
                                $totalPagado = $matricula->pagos->where('estado', 'completado')->sum('monto');
                                $montoTotal = $matricula->monto_total ?? 0;
                                $porcentajePagado = $montoTotal > 0 ? ($totalPagado / $montoTotal) * 100 : 0;
                                $saldoPendiente = max(0, $montoTotal - $totalPagado);
                                $excesoPagado = $totalPagado > $montoTotal ? $totalPagado - $montoTotal : 0;
                                $porcentajeParaBarra = min(100, $porcentajePagado);
                            @endphp
                            
                            <div class="mb-3">
                                <i class="fas fa-dollar-sign fa-3x text-success"></i>
                            </div>
                            <h2 class="text-primary">S/ {{ number_format($montoTotal, 2) }}</h2>
                            <p class="text-muted">Costo Total</p>
                            
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: {{ $porcentajeParaBarra }}%" 
                                     aria-valuenow="{{ $porcentajeParaBarra }}" aria-valuemin="0" aria-valuemax="100">
                                     {{ number_format($porcentajePagado, 1) }}%
                                </div>
                            </div>
                            
                            <div class="row text-center">
                                <div class="col-4">
                                    <small class="text-muted">Pagado</small><br>
                                    <strong class="text-success">S/ {{ number_format($totalPagado, 2) }}</strong>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">Pendiente</small><br>
                                    <strong class="text-danger">S/ {{ number_format($saldoPendiente, 2) }}</strong>
                                </div>
                                @if($excesoPagado > 0)
                                <div class="col-4">
                                    <small class="text-muted">Exceso</small><br>
                                    <strong class="text-warning">S/ {{ number_format($excesoPagado, 2) }}</strong>
                                </div>
                                @endif
                            </div>
                            
                            @if($excesoPagado > 0)
                                <div class="alert alert-warning mt-2">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Pagos en exceso:</strong> Se pagó S/ {{ number_format($excesoPagado, 2) }} más del costo total.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Información de Tiempo -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Información Temporal</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $fechaMatricula = \Carbon\Carbon::parse($matricula->fecha_matricula ?? $matricula->created_at);
                                $diasTranscurridos = (int) $fechaMatricula->diffInDays(now());
                            @endphp
                            
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td><strong>Hace:</strong></td>
                                    <td>{{ $fechaMatricula->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Días:</strong></td>
                                    <td>{{ $diasTranscurridos }} días</td>
                                </tr>
                                <tr>
                                    <td><strong>Mes:</strong></td>
                                    <td>{{ $fechaMatricula->translatedFormat('F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Día de la semana:</strong></td>
                                    <td>{{ $fechaMatricula->translatedFormat('l') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Estudiante -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Estudiante</h5>
                        </div>
                        <div class="card-body">
                            @if($matricula->estudiante)
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Nombres:</strong></td>
                                                <td>{{ $matricula->estudiante->nombres }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Apellidos:</strong></td>
                                                <td>{{ $matricula->estudiante->apellidos }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>DNI:</strong></td>
                                                <td>{{ $matricula->estudiante->dni ?? 'No registrado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Fecha de Nacimiento:</strong></td>
                                                <td>
                                                    @if($matricula->estudiante->fecha_nacimiento)
                                                        {{ \Carbon\Carbon::parse($matricula->estudiante->fecha_nacimiento)->format('d/m/Y') }}
                                                    @else
                                                        No registrada
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Grado Escolar:</strong></td>
                                                <td>{{ $matricula->estudiante->gradoEscolar->nombre_grado ?? 'No asignado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nivel Educativo:</strong></td>
                                                <td>{{ $matricula->estudiante->gradoEscolar->nivelEducativo->nombre_nivel ?? 'No asignado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Teléfono:</strong></td>
                                                <td>{{ $matricula->estudiante->telefono ?? 'No registrado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td>{{ $matricula->estudiante->email ?? 'No registrado' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Información del Apoderado -->
                                @if($matricula->estudiante->apoderado)
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6><i class="fas fa-user-tie"></i> Apoderado</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-borderless table-sm">
                                                    <tr>
                                                        <td><strong>Nombres:</strong></td>
                                                        <td>{{ $matricula->estudiante->apoderado->nombres }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Apellidos:</strong></td>
                                                        <td>{{ $matricula->estudiante->apoderado->apellidos }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>DNI:</strong></td>
                                                        <td>{{ $matricula->estudiante->apoderado->dni ?? 'No registrado' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-borderless table-sm">
                                                    <tr>
                                                        <td><strong>Teléfono:</strong></td>
                                                        <td>{{ $matricula->estudiante->apoderado->telefono ?? 'No registrado' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Email:</strong></td>
                                                        <td>{{ $matricula->estudiante->apoderado->email ?? 'No registrado' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Dirección:</strong></td>
                                                        <td>{{ $matricula->estudiante->apoderado->direccion ?? 'No registrada' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="text-right mt-3">
                                    <a href="{{ route('estudiantes.show', $matricula->estudiante) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-user"></i> Ver Perfil Completo del Estudiante
                                    </a>
                                    @if($matricula->estudiante->apoderado)
                                        <a href="{{ route('apoderados.show', $matricula->estudiante->apoderado) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-user-tie"></i> Ver Apoderado
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    No se encontró información del estudiante asociado.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cursos Matriculados -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-book"></i> Cursos Matriculados</h5>
                        </div>
                        <div class="card-body">
                            @if($matricula->detallesMatricula && $matricula->detallesMatricula->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Curso</th>
                                                <th>Nivel</th>
                                                <th>Horario</th>
                                                <th>Monto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($matricula->detallesMatricula as $detalle)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $detalle->curso->nombre_curso ?? 'N/A' }}</strong><br>
                                                        <small class="text-muted">{{ $detalle->curso->descripcion ?? '' }}</small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">
                                                            {{ $detalle->curso->nivelEducativo->nombre_nivel ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($detalle->horario)
                                                            <strong>{{ $detalle->horario->dia_semana }}</strong><br>
                                                            <small>{{ $detalle->horario->hora_inicio }} - {{ $detalle->horario->hora_fin }}</small>
                                                        @else
                                                            <span class="text-muted">Sin horario</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-success font-weight-bold">
                                                            S/ {{ number_format($detalle->subtotal, 2) }}
                                                        </span>
                                                        @if($detalle->descuento_aplicado > 0)
                                                            <br><small class="text-info">
                                                                Desc: S/ {{ number_format($detalle->descuento_aplicado, 2) }}
                                                            </small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('cursos.show', $detalle->curso) }}" class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-eye"></i> Ver
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-info">
                                                <th colspan="3">Total</th>
                                                <th>
                                                    <span class="h5 text-success">
                                                        S/ {{ number_format($matricula->detallesMatricula->sum('subtotal'), 2) }}
                                                    </span>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    No hay cursos registrados para esta matrícula.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de Pagos -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-money-bill-wave"></i> Historial de Pagos</h5>
                        </div>
                        <div class="card-body">
                            @if($matricula->pagos && $matricula->pagos->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Método</th>
                                                <th>Estado</th>
                                                <th>Comprobante</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($matricula->pagos as $pago)
                                                <tr>
                                                    <td>{{ $pago->id_pago }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                                    <td>
                                                        <span class="text-success font-weight-bold">
                                                            S/ {{ number_format($pago->monto, 2) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @switch($pago->metodo_pago)
                                                            @case('efectivo')
                                                                <span class="badge badge-success">Efectivo</span>
                                                                @break
                                                            @case('tarjeta')
                                                                <span class="badge badge-info">Tarjeta</span>
                                                                @break
                                                            @case('transferencia')
                                                                <span class="badge badge-warning">Transferencia</span>
                                                                @break
                                                            @case('deposito')
                                                                <span class="badge badge-primary">Depósito</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-secondary">{{ ucfirst($pago->metodo_pago) }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @switch($pago->estado)
                                                            @case('completado')
                                                                <span class="badge badge-success">
                                                                    <i class="fas fa-check-circle"></i> Completado
                                                                </span>
                                                                @break
                                                            @case('pendiente')
                                                                <span class="badge badge-warning">
                                                                    <i class="fas fa-clock"></i> Pendiente
                                                                </span>
                                                                @break
                                                            @case('anulado')
                                                                <span class="badge badge-danger">
                                                                    <i class="fas fa-times-circle"></i> Anulado
                                                                </span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-light">{{ ucfirst($pago->estado) }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @if($pago->comprobante)
                                                            <span class="badge badge-info">{{ $pago->comprobante }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pagos.show', $pago) }}" class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-eye"></i> Ver
                                                        </a>
                                                        @if($pago->estado !== 'anulado')
                                                            <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-outline-warning btn-sm">
                                                                <i class="fas fa-edit"></i> Editar
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-success">
                                                <th colspan="2">Total Pagado</th>
                                                <th>
                                                    <span class="h5 text-success">
                                                        S/ {{ number_format($matricula->pagos->where('estado', 'completado')->sum('monto'), 2) }}
                                                    </span>
                                                </th>
                                                <th colspan="4"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    No hay pagos registrados para esta matrícula.
                                    <a href="{{ route('pagos.create') }}?matricula={{ $matricula->id_matricula }}" class="btn btn-success btn-sm ml-2">
                                        <i class="fas fa-plus"></i> Registrar Primer Pago
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notas/Observaciones -->
            @if($matricula->observaciones)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Observaciones</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $matricula->observaciones }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Botones de Acción -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="{{ route('matriculas.edit', $matricula) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar Matrícula
                            </a>
                            
                            <a href="{{ route('pagos.create') }}?matricula={{ $matricula->id_matricula }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Registrar Pago
                            </a>
                            
                            <button class="btn btn-info" onclick="imprimirMatricula()">
                                <i class="fas fa-print"></i> Imprimir Matrícula
                            </button>
                            
                            <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Volver al Listado
                            </a>
                            
                            @if($matricula->estado !== 'cancelada')
                                <form action="{{ route('matriculas.destroy', $matricula) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta matrícula? Esta acción no se puede deshacer.')">
                                        <i class="fas fa-trash"></i> Eliminar Matrícula
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function imprimirMatricula() {
    window.print();
}
</script>

<style>
@media print {
    .sidebar, .btn-toolbar, .card:last-child {
        display: none !important;
    }
}
</style>
@endsection