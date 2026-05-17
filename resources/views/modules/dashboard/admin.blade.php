@extends('layouts.main')

@section('titulo_pagina', 'Dashboard Administrador')

@section('contenido')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4" data-aos="fade-right">
    <h1 class="h3 mb-0 text-gray-800" style="font-weight: 800; font-size: calc(1.2rem + 0.5vw);">Consola de Administración</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-2 mt-sm-0" style="border-radius: 10px; font-weight: 700;">
        <i class="fas fa-file-pdf fa-sm text-white-50 mr-1"></i> Auditoría
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">14</div>
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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ingresos (Mes)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$45,000</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="card border-left-info shadow h-100 py-2" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Carga Servidor</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto"><div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">22%</div></div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 22%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-server fa-2x text-gray-200"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="400">
        <div class="card border-left-warning shadow h-100 py-2" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tickets</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-200"></i></div>
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
                        <p class="text-muted" style="line-height: 1.6;">Tienes acceso total a la configuración del sistema, gestión de personal médico y auditoría financiera. Revisa los últimos reportes para asegurar el correcto funcionamiento de la clínica.</p>
                        <div class="mt-4">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-danger px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                <i class="fas fa-users-cog mr-2"></i> Gestionar Staff
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
@endsection
