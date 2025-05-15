@extends('layouts.app')

@section('title', 'Centro de Control')

@section('header', 'Centro de Control')

@section('content')
<div class="row animate-fadeIn">
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-primary-gradient">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Estudiantes</div>
                        <div class="stat-value">{{ $total_estudiantes ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('estudiantes.index') }}">
                    <span>Ver detalles</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-success-gradient">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Cursos</div>
                        <div class="stat-value">{{ $total_cursos ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('cursos.index') }}">
                    <span>Ver detalles</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-warning-gradient">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Matrículas</div>
                        <div class="stat-value">{{ $total_matriculas ?? 0 }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('matriculas.index') }}">
                    <span>Ver detalles</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-danger-gradient">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Pagos</div>
                        <div class="stat-value">S/ {{ number_format($total_pagos ?? 0, 2) }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('pagos.index') }}">
                    <span>Ver detalles</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row animate-fadeIn" style="animation-delay: 0.2s;">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="section-title mb-0">Estudiantes recientes</h5>
            </div>
            <div class="card-body">
                @if(isset($estudiantes_recientes) && count($estudiantes_recientes) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Grado</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estudiantes_recientes as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</td>
                                    <td>{{ $estudiante->gradoEscolar->nombre ?? 'N/A' }}</td>
                                    <td>{{ $estudiante->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('estudiantes.show', $estudiante->id_estudiante) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay estudiantes registrados.</p>
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-1"></i> Registrar estudiante
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="section-title mb-0">Pagos recientes</h5>
            </div>
            <div class="card-body">
                @if(isset($pagos_recientes) && count($pagos_recientes) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos_recientes as $pago)
                                <tr>
                                    <td>{{ $pago->matricula->estudiante->nombres ?? 'N/A' }} {{ $pago->matricula->estudiante->apellidos ?? '' }}</td>
                                    <td>S/ {{ number_format($pago->monto, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('pagos.show', $pago->id_pago) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay pagos registrados.</p>
                        <a href="{{ route('pagos.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-1"></i> Registrar pago
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row animate-fadeIn" style="animation-delay: 0.4s;">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="section-title mb-0">Distribución de estudiantes por nivel</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(isset($niveles) && count($niveles) > 0)
                        @foreach($niveles as $nivel)
                            <div class="col-md-4 mb-3">
                                <div class="distribution-card">
                                    <h5 class="level-name">{{ $nivel->nombre }}</h5>
                                    <div class="count">{{ $nivel->estudiantes_count ?? 0 }}</div>
                                    <div class="label">estudiantes</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-4">
                            <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay datos disponibles.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection