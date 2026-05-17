@extends('layouts.main')

@section('titulo_pagina', 'Editar Paciente')

@section('contenido')
<style>
.vet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.8rem;
}
.form-control-vet {
    border-radius: 12px;
    padding: 0.75rem 1rem;
    border: 1px solid #e3e6f0;
    color: #3a3b45;
}
.form-control-vet:focus {
    border-color: #7b61ff;
    box-shadow: 0 0 0 0.2rem rgba(123, 97, 255, 0.25);
}
.form-label {
    font-weight: 600;
    color: #1f2d3d;
    margin-bottom: 0.5rem;
}
.btn-vetcare { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 600; padding: 0.75rem 1.5rem; border: none; }
.btn-vetcare:hover { background-color: #512da8; color: white; }
.btn-secondary-vet { background-color: #f8f9fc; color: #858796; border-radius: 12px; font-weight: 600; padding: 0.75rem 1.5rem; border: 1px solid #e3e6f0; }
.btn-secondary-vet:hover { background-color: #eaecf4; color: #3a3b45; }
</style>

<div class="row mb-4 align-items-center" data-aos="fade-right">
    <div class="col-md-6">
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Editar Paciente</h2>
    </div>
</div>

<div class="vet-card" data-aos="fade-up">
    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-paw mr-2"></i> Información de la Mascota</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre de la Mascota</label>
                <input type="text" class="form-control form-control-vet @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $paciente->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="especie" class="form-label">Especie</label>
                <select class="form-control form-control-vet @error('especie') is-invalid @enderror" id="especie" name="especie" required>
                    <option value="Perro" {{ old('especie', $paciente->especie) == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ old('especie', $paciente->especie) == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ old('especie', $paciente->especie) == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ old('especie', $paciente->especie) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('especie')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="raza" class="form-label">Raza</label>
                <input type="text" class="form-control form-control-vet @error('raza') is-invalid @enderror" id="raza" name="raza" value="{{ old('raza', $paciente->raza) }}">
                @error('raza')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-3">
                <label for="edad" class="form-label">Edad (años)</label>
                <input type="number" class="form-control form-control-vet @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad', $paciente->edad) }}" min="0">
                @error('edad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-10 mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control form-control-vet @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones" rows="2">{{ old('observaciones', $paciente->observaciones) }}</textarea>
                @error('observaciones')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">
        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-user mr-2"></i> Información del Propietario</h5>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="user_id" class="form-label">Seleccionar Dueño Registrado (Opcional)</label>
                <select class="form-control form-control-vet @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                    <option value="">-- Dueño no registrado en el sistema --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('user_id', $paciente->user_id) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name }} ({{ $usuario->email }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Si seleccionas un dueño registrado, los campos de abajo son opcionales.</small>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="nombre_propietario" class="form-label">Nombre del Dueño (Manual)</label>
                <input type="text" class="form-control form-control-vet @error('nombre_propietario') is-invalid @enderror" id="nombre_propietario" name="nombre_propietario" value="{{ old('nombre_propietario', $paciente->nombre_propietario) }}">
                @error('nombre_propietario')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono_propietario" class="form-label">Teléfono de Contacto</label>
                <input type="text" class="form-control form-control-vet @error('telefono_propietario') is-invalid @enderror" id="telefono_propietario" name="telefono_propietario" value="{{ old('telefono_propietario', $paciente->telefono_propietario) }}">
                @error('telefono_propietario')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mt-4 text-right">
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary-vet mr-2">Cancelar</a>
            <button type="submit" class="btn btn-vetcare">Actualizar Paciente</button>
        </div>
    </form>
</div>
@endsection
