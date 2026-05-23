@extends('layouts.main')

@section('titulo_pagina', 'Registrar Paciente')

@section('contenido')
<style>
.vet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.5rem; /* Ajustado para móviles */
}
@media (min-width: 768px) {
    .vet-card { padding: 2rem; }
}
.form-control-vet {
    border-radius: 12px;
    padding: 0.8rem 1rem; /* Mayor área de toque */
    border: 1px solid #e3e6f0;
    color: #3a3b45;
    height: auto;
    font-size: 1rem;
}
.form-control-vet:focus {
    border-color: #7b61ff;
    box-shadow: 0 0 0 0.2rem rgba(123, 97, 255, 0.25);
}
.form-label {
    font-weight: 700;
    color: #1f2d3d;
    margin-bottom: 0.5rem;
    display: block;
}
.btn-vetcare { 
    background-color: #7b61ff; 
    color: white; 
    border-radius: 12px; 
    font-weight: 700; 
    padding: 0.8rem 1.5rem; 
    border: none;
    width: 100%; /* Full width en móvil */
}
@media (min-width: 576px) {
    .btn-vetcare { width: auto; }
}
.btn-vetcare:hover { background-color: #512da8; color: white; }
.btn-secondary-vet { 
    background-color: #f8f9fc; 
    color: #858796; 
    border-radius: 12px; 
    font-weight: 700; 
    padding: 0.8rem 1.5rem; 
    border: 1px solid #e3e6f0;
    width: 100%;
    margin-bottom: 0.5rem;
}
@media (min-width: 576px) {
    .btn-secondary-vet { width: auto; margin-bottom: 0; }
}
.btn-secondary-vet:hover { background-color: #eaecf4; color: #3a3b45; }

/* Ajuste para que el select no se corte */
select.form-control-vet {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
}
.owner-select-panel {
    background-color: #f8f9fc;
    border: 1px dashed #d1d3e2;
    border-radius: 14px;
    padding: 1rem;
}
.dark-mode .owner-select-panel {
    background-color: #0f172a;
    border-color: #475569;
}
.dark-mode select.form-control-vet option {
    background-color: #0f172a;
    color: #f8fafc;
}
</style>

<div class="row mb-4 align-items-center" data-aos="fade-right">
    <div class="col-12">
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 5px; font-size: 1.75rem;">Registrar Paciente</h2>
        <p class="text-muted">Completa los datos para el ingreso clínico.</p>
    </div>
</div>

<div class="vet-card mb-5" data-aos="fade-up">
    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf
        
        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-paw mr-2"></i> Datos de la Mascota</h5>
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre de la Mascota</label>
                <input type="text" class="form-control form-control-vet @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required placeholder="Ej: Max">
                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-12 col-sm-6 col-md-3 mb-3">
                <label for="especie" class="form-label">Especie</label>
                <select class="form-control form-control-vet @error('especie') is-invalid @enderror" id="especie" name="especie" required>
                    <option value="" disabled selected>Elegir...</option>
                    <option value="Perro" {{ old('especie') == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ old('especie') == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ old('especie') == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ old('especie') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('especie') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-12 col-sm-6 col-md-3 mb-3">
                <label for="raza" class="form-label">Raza</label>
                <input type="text" class="form-control form-control-vet @error('raza') is-invalid @enderror" id="raza" name="raza" value="{{ old('raza') }}" placeholder="Ej: Beagle">
                @error('raza') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-sm-4 col-md-2 mb-3">
                <label for="edad" class="form-label">Edad (años)</label>
                <input type="number" class="form-control form-control-vet @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad') }}" min="0">
                @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-sm-8 col-md-10 mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control form-control-vet @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones" rows="2" placeholder="Alergias, comportamiento, etc.">{{ old('observaciones') }}</textarea>
                @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <hr class="my-4">
        
        <h5 class="mb-4 text-primary font-weight-bold"><i class="fas fa-user mr-2"></i> Información del Propietario</h5>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="owner-select-panel">
                    <label for="user_id" class="form-label">¿Dueño ya registrado en VetCare?</label>
                    <select class="form-control form-control-vet @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                        <option value="" selected>-- No, registrar datos manualmente abajo --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} ({{ $usuario->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="nombre_propietario" class="form-label">Nombre del Dueño (Manual)</label>
                <input type="text" class="form-control form-control-vet @error('nombre_propietario') is-invalid @enderror" id="nombre_propietario" name="nombre_propietario" value="{{ old('nombre_propietario') }}" placeholder="Si no está registrado">
                @error('nombre_propietario') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="telefono_propietario" class="form-label">Teléfono</label>
                <input type="text" class="form-control form-control-vet @error('telefono_propietario') is-invalid @enderror" id="telefono_propietario" name="telefono_propietario" value="{{ old('telefono_propietario') }}" placeholder="Ej: 1234567890">
                @error('telefono_propietario') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="mt-4 d-flex flex-column flex-sm-row justify-content-end">
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary-vet mr-sm-2 order-2 order-sm-1">Cancelar</a>
            <button type="submit" class="btn btn-vetcare order-1 order-sm-2">Registrar Paciente</button>
        </div>
    </form>
</div>
@endsection
