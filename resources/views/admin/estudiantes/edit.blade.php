@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('header', 'Editar Estudiante')

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

        <form action="{{ route('estudiantes.update', $estudiante->id_estudiante) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres', $estudiante->nombres) }}" required>
                </div>