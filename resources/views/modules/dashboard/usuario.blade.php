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
    padding: 2.5rem;
    margin-bottom: 2rem;
}
.welcome-banner-img {
    position: absolute;
    right: -10px;
    bottom: -10px;
    height: 120%;
    z-index: 1;
    opacity: 0.8;
}
.welcome-content {
    position: relative;
    z-index: 2;
    max-width: 65%;
}
.pet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.5rem;
    transition: transform 0.2s;
    border: 1px solid #f1f3f9;
}
.pet-card:hover {
    transform: translateY(-5px);
}
.pet-avatar {
    width: 70px;
    height: 70px;
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
        <div class="welcome-banner shadow-sm animate__animated animate__fadeIn">
            <img src="{{ asset('img/dogs_banner.png') }}" alt="Mascotas" class="welcome-banner-img">
            <div class="welcome-content">
                <h2 style="font-weight: 800; color: #003366; margin-bottom: 10px; font-size: 1.8rem;">¡Hola, {{ Auth::user()->name }}!</h2>
                <p style="color: #4a5568; font-size: 1.05rem; margin-bottom: 1.5rem; font-weight: 500;">Bienvenido de nuevo a VetCare. Aquí puedes ver el estado de tus mascotas y sus próximas citas.</p>
                <a href="#" class="btn btn-primary px-4 py-2 animate__animated animate__pulse animate__infinite" style="border-radius: 12px; font-weight: 700;">
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
            <h4 style="font-weight: 800; color: #1f2d3d;">Mis Mascotas</h4>
            <a href="#" class="text-primary font-weight-bold">Ver todas</a>
        </div>
        
        <div class="row">
            <!-- Pet 1 -->
            <div class="col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="pet-card">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" class="pet-avatar" alt="Mascota">
                        <div class="ml-3">
                            <h5 class="mb-0 font-weight-bold">Bella</h5>
                            <span class="text-muted small">Golden Retriever • 3 años</span>
                        </div>
                    </div>
                    <div class="bg-light p-3 rounded" style="border-radius: 12px!important;">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small text-muted">Próxima Vacuna:</span>
                            <span class="small font-weight-bold">15 Jun 2026</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="small text-muted">Último Peso:</span>
                            <span class="small font-weight-bold">24.5 kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pet 2 -->
            <div class="col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="pet-card">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" class="pet-avatar" alt="Mascota">
                        <div class="ml-3">
                            <h5 class="mb-0 font-weight-bold">Simba</h5>
                            <span class="text-muted small">Gato Persa • 1 año</span>
                        </div>
                    </div>
                    <div class="bg-light p-3 rounded" style="border-radius: 12px!important;">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small text-muted">Próxima Vacuna:</span>
                            <span class="small font-weight-bold">Mañana</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="small text-muted">Último Peso:</span>
                            <span class="small font-weight-bold">4.2 kg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Próximas Citas -->
        <div class="card border-0 shadow-sm rounded-lg mb-4" style="border-radius: 20px;" data-aos="fade-up" data-aos-delay="300">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-4">Próximas Citas</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th>Fecha</th>
                                <th>Mascota</th>
                                <th>Servicio</th>
                                <th class="text-right">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-top">
                                <td class="py-3">
                                    <div class="font-weight-bold">17 Mayo, 2026</div>
                                    <div class="small text-muted">11:00 AM</div>
                                </td>
                                <td class="py-3">Simba</td>
                                <td class="py-3">Vacunación Anual</td>
                                <td class="py-3 text-right">
                                    <span class="badge badge-pill badge-warning px-3 py-2">Confirmada</span>
                                </td>
                            </tr>
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
                <p class="mb-0 op-8">Mantener a tu mascota hidratada durante los días calurosos ayuda a prevenir golpes de calor. ¡No olvides su plato de agua!</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;" data-aos="fade-left" data-aos-delay="200">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-4">Atención al Cliente</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light rounded-circle p-3 mr-3 text-primary">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <div class="small text-muted">Teléfono de Urgencias</div>
                        <div class="font-weight-bold">+1 234 567 890</div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-light rounded-circle p-3 mr-3 text-success">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="small text-muted">WhatsApp</div>
                        <div class="font-weight-bold">Chatea con nosotros</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
