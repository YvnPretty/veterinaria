@extends('layouts.main')

@section('titulo_pagina', 'Agenda de Citas')

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
.badge-soft-success { background-color: #e6fcf5; color: #20c997; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
.badge-soft-warning { background-color: #fff8e6; color: #f6c23e; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
.badge-soft-danger { background-color: #ffebe9; color: #e74a3b; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
.badge-soft-purple { background-color: #f2eefd; color: #7b61ff; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
</style>

<div class="row mb-4 align-items-center">
    <div class="col-md-6" data-aos="fade-right">
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">{{ Auth::user()->rol === 'usuario' ? 'Mis Citas' : 'Agenda de Citas' }}</h2>
        <p style="color: #6e707e; font-size: 1.05rem; margin-bottom: 0; font-weight: 500;">{{ Auth::user()->rol === 'usuario' ? 'Seguimiento de tus próximas consultas y servicios.' : 'Gestión de consultas y servicios médicos.' }}</p>
    </div>
    <div class="col-md-6 text-right" data-aos="fade-left">
        <a href="{{ route('citas.calendario') }}" class="btn btn-outline-primary mr-2" style="border-radius: 12px; font-weight: 700;">
            <i class="fas fa-calendar mr-2"></i> Ver Calendario
        </a>
        <a href="{{ route('citas.create') }}" class="btn btn-vetcare">
            <i class="fas fa-calendar-plus mr-2"></i> Agendar Nueva Cita
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
                    <th>Fecha y Hora</th>
                    <th>Mascota</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>
                        <div class="font-weight-bold">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y') }}</div>
                        <div class="small text-muted">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('h:i A') }}</div>
                    </td>
                    <td><strong>{{ $cita->paciente->nombre }}</strong></td>
                    <td style="color: #858796;">{{ $cita->motivo }}</td>
                    <td>
                        @switch($cita->estado)
                            @case('pendiente')
                                <span class="badge-soft-warning">Pendiente</span>
                                @break
                            @case('en_proceso')
                                <span class="badge-soft-purple">En Proceso</span>
                                @break
                            @case('completada')
                                <span class="badge-soft-success">Completada</span>
                                @break
                            @case('cancelada')
                                <span class="badge-soft-danger">Cancelada</span>
                                @break
                        @endswitch
                    </td>
                    <td class="text-right">
                        <a href="{{ route('expedientes.index', ['id' => $cita->paciente_id]) }}" class="btn-action edit" title="Ver expediente">
                            <i class="fas fa-folder-open"></i>
                        </a>
                        @if(Auth::user()->rol !== 'usuario')
                        <a href="{{ route('citas.edit', $cita->id) }}" class="btn-action edit" title="Editar / Actualizar Estado">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta cita?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4" style="color: #858796;">No hay citas agendadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
