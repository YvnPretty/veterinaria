@extends('layouts.main')

@section('titulo_pagina', 'Dashboard Administrador')

@section('contenido')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4" data-aos="fade-right">
    <h1 class="h3 mb-0 text-gray-800" style="font-weight: 800; font-size: calc(1.2rem + 0.5vw);">Consola de Administración</h1>
    <a href="{{ route('expedientes.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-2 mt-sm-0" style="border-radius: 10px; font-weight: 700;">
        <i class="fas fa-folder-open fa-sm text-white-50 mr-1"></i> Expedientes
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Stat Cards -->
    <div class="col-xl-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
        <div class="card border-left-danger shadow h-100 py-2" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Usuarios</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['usuarios'] }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
        <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pacientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pacientes'] }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-paw fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="card border-left-info shadow h-100 py-2" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #0f766e; font-weight: 800;">Consultas del mes</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto"><div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $stats['consultasMes'] }}</div></div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ min(100, $stats['consultasMes'] * 12) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-notes-medical fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="400">
        <div class="card border-left-warning shadow h-100 py-2" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Citas activas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['citasPendientes'] }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar-check fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Message -->
<div class="row">
    <div class="col-12 mb-4" data-aos="fade-up">
        <div class="card shadow" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="card-header py-3 bg-gradient-danger border-0">
                <h6 class="m-0 font-weight-bold text-white">Consola de Control Central</h6>
            </div>
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h4 class="font-weight-bold text-gray-900 mb-3">¡Bienvenido de nuevo, {{ Auth::user()->name }}!</h4>
                        <p class="text-muted" style="line-height: 1.6;">Tienes acceso total a usuarios, pacientes, agenda e historial clínico. El sistema ya cruza propietarios, expedientes y consultas para revisar la operación de la clínica desde un solo lugar.</p>
                        <div class="mt-4">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-danger px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                <i class="fas fa-users-cog mr-2"></i> Gestionar Staff
                            </a>
                            <a href="{{ route('citas.index') }}" class="btn btn-outline-danger px-4 py-2 ml-2" style="border-radius: 10px; font-weight: 700;">
                                <i class="fas fa-calendar-alt mr-2"></i> Ver Agenda
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 d-none d-lg-block text-center">
                        <i class="fas fa-user-shield fa-8x text-gray-100"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4" data-aos="fade-up">
        <div class="card shadow h-100" style="border-radius: 20px; border: none;">
            <div class="card-header py-3 bg-white border-0">
                <h6 class="m-0 font-weight-bold text-gray-900">Agenda Operativa</h6>
            </div>
            <div class="card-body">
                @forelse($ultimasCitas as $cita)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <div>
                            <div class="font-weight-bold text-gray-900">{{ $cita->paciente->nombre }}</div>
                            <div class="small text-muted">{{ $cita->motivo }}</div>
                        </div>
                        <div class="text-right">
                            <div class="small font-weight-bold text-primary">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m h:i A') }}</div>
                            <div class="small text-muted">{{ str_replace('_', ' ', $cita->estado) }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No hay citas registradas.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card shadow h-100" style="border-radius: 20px; border: none;">
            <div class="card-header py-3 bg-white border-0">
                <h6 class="m-0 font-weight-bold text-gray-900">Actividad Clínica Reciente</h6>
            </div>
            <div class="card-body">
                @forelse($ultimosRegistros as $registro)
                    <div class="py-2 border-bottom">
                        <div class="d-flex justify-content-between">
                            <div class="font-weight-bold text-gray-900">{{ $registro->paciente->nombre }}</div>
                            <div class="small text-primary font-weight-bold">{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</div>
                        </div>
                        <div class="small text-muted">{{ Str::limit($registro->diagnostico, 95) }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No hay consultas registradas.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
