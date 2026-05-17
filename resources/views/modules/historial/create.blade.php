@extends('layouts.main')

@section('titulo_pagina', 'Nuevo Registro Médico')

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
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Nuevo Registro Médico</h2>
    </div>
</div>

<div class="vet-card" data-aos="fade-up">
    <form action="{{ route('historial.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="paciente_id" class="form-label">Paciente</label>
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
                <label for="fecha" class="form-label">Fecha de la Consulta</label>
                <input type="date" class="form-control form-control-vet @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                @error('fecha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="diagnostico" class="form-label">Diagnóstico</label>
                <textarea class="form-control form-control-vet @error('diagnostico') is-invalid @enderror" id="diagnostico" name="diagnostico" rows="3" required placeholder="Describa el estado de salud detectado...">{{ old('diagnostico') }}</textarea>
                @error('diagnostico')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="tratamiento" class="form-label">Tratamiento / Procedimiento</label>
                <textarea class="form-control form-control-vet @error('tratamiento') is-invalid @enderror" id="tratamiento" name="tratamiento" rows="3" required placeholder="Describa las acciones realizadas...">{{ old('tratamiento') }}</textarea>
                @error('tratamiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="medicamentos" class="form-label">Medicamentos Recetados</label>
                <textarea class="form-control form-control-vet @error('medicamentos') is-invalid @enderror" id="medicamentos" name="medicamentos" rows="2" placeholder="Lista de fármacos y dosis...">{{ old('medicamentos') }}</textarea>
                @error('medicamentos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mt-4 text-right">
            <a href="{{ route('historial.index') }}" class="btn btn-secondary-vet mr-2">Cancelar</a>
            <button type="submit" class="btn btn-vetcare">Guardar Registro</button>
        </div>
    </form>
</div>
@endsection
