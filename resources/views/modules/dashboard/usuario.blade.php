@extends('layouts.main')

@section('titulo_pagina', 'Mi Dashboard - Cliente')

@section('contenido')
<style>
/* Custom styles for User/Client Dashboard */
.welcome-banner {
    background-color: #f0f7ff;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    padding: 1.5rem; /* Ajustado para móvil */
    margin-bottom: 2rem;
}
@media (min-width: 768px) {
    .welcome-banner { padding: 2.5rem; }
}
.welcome-banner-img {
    position: absolute;
    right: -10px;
    bottom: -10px;
    height: 120%;
    z-index: 1;
    opacity: 0.3; /* Menos opaco en móvil para no tapar texto */
}
@media (min-width: 768px) {
    .welcome-banner-img { opacity: 0.8; }
}
.welcome-content {
    position: relative;
    z-index: 2;
    max-width: 100%; /* Full width en móvil */
}
@media (min-width: 768px) {
    .welcome-content { max-width: 65%; }
}
.pet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.25rem;
    transition: transform 0.2s;
    border: 1px solid #f1f3f9;
    height: 100%;
}
.pet-card:hover {
    transform: translateY(-5px);
}
.pet-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.status-badge {
    font-size: 0.7rem;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 700;
}
</style>

<div class="row">
    <div class="col-12" data-aos="fade-down">
        <!-- Welcome Banner -->
        <div class="welcome-banner animate__animated animate__fadeIn">
            <img src="{{ asset('img/dogs_banner.png') }}" alt="Mascotas" class="welcome-banner-img">
            <div class="welcome-content">
                <h2 style="font-weight: 800; margin-bottom: 10px; font-size: calc(1.3rem + 1vw);">¡Hola, {{ Auth::user()->name }}!</h2>
                <p style="font-size: 1rem; margin-bottom: 1.5rem; font-weight: 500;">Bienvenido a VetCare. Aquí puedes ver el estado de tus mascotas.</p>
                <a href="{{ route('citas.create') }}" class="btn btn-primary px-4 py-2 animate__animated animate__pulse animate__infinite" style="border-radius: 12px; font-weight: 700; width: 100%; max-width: 250px;">
                    <i class="fas fa-calendar-plus mr-2"></i> Agendar nueva cita
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Mis Mascotas Section -->
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4" data-aos="fade-right">
            <h4 style="font-weight: 800; color: #1f2d3d; font-size: 1.25rem;">Mis Mascotas</h4>
            <a href="{{ route('pacientes.index') }}" class="text-primary font-weight-bold small">Ver todas</a>
        </div>
        
        <div class="row">
            @forelse($pacientes as $paciente)
                @php
                    $proximaCita = $paciente->citas
                        ->filter(function ($cita) {
                            return in_array($cita->estado, ['pendiente', 'en_proceso'])
                                && \Carbon\Carbon::parse($cita->fecha_hora)->greaterThanOrEqualTo(now());
                        })
                        ->sortBy('fecha_hora')
                        ->first();
                    $ultimoRegistro = $paciente->historiales->first();
                @endphp
                <div class="col-12 col-sm-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ 100 + ($loop->index * 100) }}">
                    <a href="{{ route('expedientes.index', ['id' => $paciente->id]) }}" class="text-decoration-none">
                        <div class="pet-card">
                            <div class="d-flex align-items-center mb-3">
                                <div class="pet-avatar d-flex align-items-center justify-content-center bg-primary text-white font-weight-bold" style="font-size: 1.4rem;">
                                    {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <h5 class="mb-0 font-weight-bold text-gray-900" style="font-size: 1.1rem;">{{ $paciente->nombre }}</h5>
                                    <span class="text-muted small">{{ $paciente->especie }} {{ $paciente->raza ? '• ' . $paciente->raza : '' }} {{ $paciente->edad ? '• ' . $paciente->edad . ' años' : '' }}</span>
                                </div>
                            </div>
                            <div class="bg-light p-3 rounded" style="border-radius: 12px!important;">
                                <div class="d-flex justify-content-between mb-1 small">
                                    <span class="text-muted">Próxima cita:</span>
                                    <span class="font-weight-bold">{{ $proximaCita ? \Carbon\Carbon::parse($proximaCita->fecha_hora)->format('d/m/Y') : 'Sin cita' }}</span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span class="text-muted">Última consulta:</span>
                                    <span class="font-weight-bold">{{ $ultimoRegistro ? \Carbon\Carbon::parse($ultimoRegistro->fecha)->format('d/m/Y') : 'Sin registro' }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 mb-4">
                    <div class="pet-card text-center text-muted">
                        <i class="fas fa-paw fa-2x mb-3 text-light"></i>
                        <p class="font-weight-bold mb-0">Aún no tienes mascotas registradas.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Próximas Citas -->
        <div class="card border-0 shadow-sm rounded-lg mb-4" style="border-radius: 20px;" data-aos="fade-up" data-aos-delay="300">
            <div class="card-body p-3 p-md-4">
                <h5 class="font-weight-bold mb-4" style="font-size: 1.1rem;">Próximas Citas</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle" style="min-width: 400px;">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th>Fecha</th>
                                <th>Mascota</th>
                                <th>Servicio</th>
                                <th class="text-right">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proximasCitas as $cita)
                                <tr class="border-top">
                                    <td class="py-3">
                                        <div class="font-weight-bold small">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y') }}</div>
                                        <div class="small text-muted">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('h:i A') }}</div>
                                    </td>
                                    <td class="py-3 small">{{ $cita->paciente->nombre }}</td>
                                    <td class="py-3 small">{{ $cita->motivo }}</td>
                                    <td class="py-3 text-right">
                                        <span class="badge badge-pill badge-warning px-2 py-1 small">{{ str_replace('_', ' ', ucfirst($cita->estado)) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-top">
                                    <td colspan="4" class="py-4 text-center text-muted small font-weight-bold">No tienes citas próximas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Tips & Info -->
    <div class="col-lg-4">
        <div class="card border-0 bg-gradient-primary text-white shadow-sm mb-4" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);" data-aos="fade-left">
            <div class="card-body p-4">
                <i class="fas fa-lightbulb fa-2x mb-3 text-warning"></i>
                <h5 class="font-weight-bold">Tip del día</h5>
                <p class="mb-0 small op-8">Mantener a tu mascota hidratada ayuda a prevenir golpes de calor. ¡No olvides su agua!</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;" data-aos="fade-left" data-aos-delay="200">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-4" style="font-size: 1.1rem;">Atención al Cliente</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded-circle p-3 mr-3 text-primary">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <div class="small text-muted small">Urgencias</div>
                        <div class="font-weight-bold small">+1 234 567 890</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-light rounded-circle p-3 mr-3 text-success">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="small text-muted small">WhatsApp</div>
                        <div class="font-weight-bold small">Chatea con nosotros</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
