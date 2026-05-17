@extends('layouts.main')

@section('titulo_pagina', 'Registrar Paciente')

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
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Registrar Paciente</h2>
    </div>
</div>

<div class="vet-card" data-aos="fade-up">
    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf
        
        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-paw mr-2"></i> Información de la Mascota</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre de la Mascota</label>
                <input type="text" class="form-control form-control-vet @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="especie" class="form-label">Especie</label>
                <select class="form-control form-control-vet @error('especie') is-invalid @enderror" id="especie" name="especie" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Perro" {{ old('especie') == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ old('especie') == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ old('especie') == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ old('especie') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('especie')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="raza" class="form-label">Raza</label>
                <input type="text" class="form-control form-control-vet @error('raza') is-invalid @enderror" id="raza" name="raza" value="{{ old('raza') }}">
                @error('raza')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-3">
                <label for="edad" class="form-label">Edad (años)</label>
                <input type="number" class="form-control form-control-vet @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad') }}" min="0">
                @error('edad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-10 mb-3">
                <label for="observaciones" class="form-label">Observaciones iniciales</label>
                <textarea class="form-control form-control-vet @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones" rows="2">{{ old('observaciones') }}</textarea>
                @error('observaciones')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">
        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-user mr-2"></i> Información del Propietario</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre_propietario" class="form-label">Nombre Completo del Dueño</label>
                <input type="text" class="form-control form-control-vet @error('nombre_propietario') is-invalid @enderror" id="nombre_propietario" name="nombre_propietario" value="{{ old('nombre_propietario') }}" required>
                @error('nombre_propietario')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono_propietario" class="form-label">Teléfono de Contacto</label>
                <input type="text" class="form-control form-control-vet @error('telefono_propietario') is-invalid @enderror" id="telefono_propietario" name="telefono_propietario" value="{{ old('telefono_propietario') }}" required>
                @error('telefono_propietario')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mt-4 text-right">
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary-vet mr-2">Cancelar</a>
            <button type="submit" class="btn btn-vetcare">Registrar Paciente</button>
        </div>
    </form>
</div>
@endsection
