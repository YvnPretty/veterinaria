@extends('layouts.main')

@section('titulo_pagina', 'Agendar Cita')

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
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Agendar Nueva Cita</h2>
    </div>
</div>

<div class="vet-card" data-aos="fade-up">
    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="paciente_id" class="form-label">Seleccionar Paciente</label>
                <select class="form-control form-control-vet @error('paciente_id') is-invalid @enderror" id="paciente_id" name="paciente_id" required>
                    <option value="" disabled selected>Seleccione un paciente...</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                            {{ $paciente->nombre }} (Propietario: {{ $paciente->nombre_propietario }})
                        </option>
                    @endforeach
                </select>
                @error('paciente_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                <input type="datetime-local" class="form-control form-control-vet @error('fecha_hora') is-invalid @enderror" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora') }}" required>
                @error('fecha_hora')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="motivo" class="form-label">Motivo de la Cita</label>
                <input type="text" class="form-control form-control-vet @error('motivo') is-invalid @enderror" id="motivo" name="motivo" placeholder="Ej: Vacunación, Consulta General" value="{{ old('motivo') }}" required>
                @error('motivo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="estado" class="form-label">Estado Inicial</label>
                <select class="form-control form-control-vet @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                    <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="notas" class="form-label">Notas Adicionales</label>
                <textarea class="form-control form-control-vet @error('notas') is-invalid @enderror" id="notas" name="notas" rows="3" placeholder="Información relevante para la cita...">{{ old('notas') }}</textarea>
                @error('notas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mt-4 text-right">
            <a href="{{ route('citas.index') }}" class="btn btn-secondary-vet mr-2">Cancelar</a>
            <button type="submit" class="btn btn-vetcare">Agendar Cita</button>
        </div>
    </form>
</div>
@endsection
