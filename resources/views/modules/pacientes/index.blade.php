@extends('layouts.main')

@section('titulo_pagina', 'Pacientes')

@section('contenido')
<style>
.vet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.8rem;
    height: 100%;
}
.table-clean th { border-top: none; color: #858796; font-weight: 600; font-size: 0.85rem; padding-bottom: 1rem; border-bottom: 1px solid #f8f9fc; }
.table-clean td { vertical-align: middle; border-top: 1px solid #f8f9fc; padding: 1rem 0.5rem; color: #3a3b45; font-weight: 600; font-size: 0.9rem; }
.btn-vetcare { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 600; padding: 0.5rem 1.5rem; border: none; }
.btn-vetcare:hover { background-color: #512da8; color: white; }
.btn-action { color: #a0a5ba; background: transparent; border: none; margin-right: 5px; transition: color 0.2s;}
.btn-action.edit:hover { color: #1890ff; }
.btn-action.delete:hover { color: #e74a3b; }
</style>

<div class="row mb-4 align-items-center">
    <div class="col-md-6" data-aos="fade-right">
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Pacientes Mascotas</h2>
        <p style="color: #6e707e; font-size: 1.05rem; margin-bottom: 0; font-weight: 500;">Listado de mascotas registradas en la clínica.</p>
    </div>
    <div class="col-md-6 text-right" data-aos="fade-left">
        <a href="{{ route('pacientes.create') }}" class="btn btn-vetcare">
            <i class="fas fa-plus mr-2"></i> Registrar Paciente
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" style="border-radius: 12px; background-color: #e6fcf5; color: #20c997; border: none; font-weight: 600;" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="vet-card" data-aos="fade-up">
    <div class="table-responsive">
        <table class="table table-clean">
            <thead>
                <tr>
                    <th>Mascota</th>
                    <th>Especie/Raza</th>
                    <th>Edad</th>
                    <th>Propietario</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pacientes as $paciente)
                <tr>
                    <td><strong>{{ $paciente->nombre }}</strong></td>
                    <td style="color: #858796;">{{ $paciente->especie }} / {{ $paciente->raza ?? 'N/A' }}</td>
                    <td>{{ $paciente->edad ? $paciente->edad . ' años' : 'N/A' }}</td>
                    <td>
                        <div class="font-weight-bold">{{ $paciente->nombre_propietario }}</div>
                        <div class="small text-muted">{{ $paciente->telefono_propietario }}</div>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn-action edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este paciente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4" style="color: #858796;">No hay pacientes registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
