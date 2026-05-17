@extends('layouts.main')

@section('titulo_pagina', 'Dashboard Veterinario')

@section('contenido')
<style>
/* Custom styles for VetCare Dashboard */
.welcome-banner {
    background: linear-gradient(135deg, #fdfaf6 0%, #fff5f0 100%);
    border-radius: 24px;
    position: relative;
    overflow: hidden;
    padding: 2rem;
    margin-bottom: 2.5rem;
    border: 1px solid #f9ebe0;
}
@media (min-width: 768px) {
    .welcome-banner { padding: 3rem; }
}
.welcome-banner-img {
    position: absolute;
    right: -20px;
    bottom: -20px;
    height: 140%;
    z-index: 1;
    opacity: 0.15;
}
@media (min-width: 768px) {
    .welcome-banner-img { opacity: 1; }
}
.welcome-content {
    position: relative;
    z-index: 2;
    max-width: 100%;
}
@media (min-width: 992px) {
    .welcome-content { max-width: 65%; }
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 1.25rem 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    display: flex;
    align-items: center;
    border: 1px solid #f1f5f9;
    height: 100%;
}
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    margin-right: 15px;
    flex-shrink: 0;
}
.stat-icon.purple { background-color: #f2eefd; color: #7b61ff; }
.stat-icon.blue { background-color: #e6f7ff; color: #1890ff; }
.stat-icon.green { background-color: #e6fcf5; color: #20c997; }

.stat-value { font-size: 1.5rem; font-weight: 800; color: #1e293b; line-height: 1; margin-bottom: 4px; }
.stat-label { font-size: 0.85rem; color: #64748b; font-weight: 700; }

.vet-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    padding: 1.75rem;
    height: 100%;
    border: 1px solid #f1f5f9;
}
.vet-card-title {
    font-weight: 800;
    color: #1e293b;
    font-size: 1.15rem;
    margin-bottom: 1.75rem;
}

.table-clean th { 
    border-top: none; 
    color: #94a3b8; 
    font-weight: 700; 
    font-size: 0.8rem; 
    padding-bottom: 1.25rem; 
    border-bottom: 1px solid #f1f5f9; 
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.table-clean td { 
    vertical-align: middle; 
    border-top: 1px solid #f8fafc; 
    padding: 1.25rem 0.5rem; 
    color: #334155; 
    font-weight: 600; 
    font-size: 0.95rem; 
}

.badge-soft-success { background-color: #e6fcf5; color: #20c997; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 0.75rem;}
.badge-soft-warning { background-color: #fff8e6; color: #f6c23e; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 0.75rem;}
.badge-soft-purple { background-color: #f2eefd; color: #7b61ff; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 0.75rem;}

.avatar-circle { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
.list-item { display: flex; align-items: center; margin-bottom: 1.5rem; }
.list-info { margin-left: 15px; }
.list-title { font-weight: 700; color: #1e293b; font-size: 0.95rem; margin-bottom: 2px; }
.list-desc { font-size: 0.8rem; color: #64748b; line-height: 1.4;}
.list-time { font-size: 0.8rem; font-weight: 800; color: #7b61ff; margin-bottom: 2px; }

.link-action { color: #7b61ff; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.2s; }
.link-action:hover { color: #512da8; padding-left: 5px; }
</style>

<div class="row">
    <!-- Main Column (Left) -->
    <div class="col-lg-8 mb-4">
        
        <!-- Welcome Banner -->
        <div class="welcome-banner shadow-sm" data-aos="fade-down">
            <img src="{{ asset('img/dogs_banner.png') }}" alt="Mascotas" class="welcome-banner-img">
            <div class="welcome-content">
                <h2 style="font-weight: 800; color: #1e293b; margin-bottom: 12px; font-size: calc(1.5rem + 1vw);">¡Hola, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Doc' }}!</h2>
                <p style="color: #475569; font-size: 1.1rem; margin-bottom: 0; font-weight: 500; line-height: 1.5;">Tienes una jornada activa hoy. Aquí está el resumen de tu clínica.</p>
                
                <div class="row mt-4">
                    <div class="col-6 col-md-4 mb-3" data-aos="zoom-in" data-aos-delay="100">
                        <div class="stat-card">
                            <div class="stat-icon purple"><i class="fas fa-calendar-alt"></i></div>
                            <div>
                                <div class="stat-value">8</div>
                                <div class="stat-label">Citas</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3" data-aos="zoom-in" data-aos-delay="200">
                        <div class="stat-card">
                            <div class="stat-icon blue"><i class="fas fa-paw"></i></div>
                            <div>
                                <div class="stat-value">24</div>
                                <div class="stat-label">Pacientes</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3" data-aos="zoom-in" data-aos-delay="300">
                        <div class="stat-card">
                            <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                            <div>
                                <div class="stat-value">15</div>
                                <div class="stat-label">Facturas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Citas de hoy -->
            <div class="col-12 mb-4" data-aos="fade-up">
                <div class="vet-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="vet-card-title mb-0">Citas de hoy</h5>
                        <a href="{{ route('citas.index') }}" class="link-action">Agenda <i class="fas fa-chevron-right ml-1 small"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-clean">
                            <tbody>
                                <tr>
                                    <td><span class="text-primary font-weight-bold">09:00</span></td>
                                    <td><strong>Max</strong></td>
                                    <td class="text-muted d-none d-sm-table-cell">Consulta General</td>
                                    <td class="text-right"><span class="badge-soft-success">Completada</span></td>
                                </tr>
                                <tr>
                                    <td><span class="text-primary font-weight-bold">10:30</span></td>
                                    <td><strong>Luna</strong></td>
                                    <td class="text-muted d-none d-sm-table-cell">Vacunación</td>
                                    <td class="text-right"><span class="badge-soft-purple">En curso</span></td>
                                </tr>
                                <tr>
                                    <td><span class="text-primary font-weight-bold">12:00</span></td>
                                    <td><strong>Rocky</strong></td>
                                    <td class="text-muted d-none d-sm-table-cell">Control Semanal</td>
                                    <td class="text-right"><span class="badge-soft-warning">Pendiente</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Servicios -->
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="vet-card">
                    <h5 class="vet-card-title">Servicios Populares</h5>
                    <div class="d-flex justify-content-center align-items-center py-3">
                        <div style="position: relative; width: 140px; height: 140px; border-radius: 50%; background: conic-gradient(#7b61ff 0% 40%, #1890ff 40% 65%, #20c997 65% 85%, #f6c23e 85% 100%); display: flex; justify-content: center; align-items: center; box-shadow: inset 0 0 15px rgba(0,0,0,0.05);">
                            <div style="width: 90px; height: 90px; background: white; border-radius: 50%;"></div>
                        </div>
                    </div>
                    <div class="mt-4 px-2">
                        <div class="d-flex justify-content-between mb-2 small"><span class="text-muted"><i class="fas fa-circle mr-2" style="color: #7b61ff;"></i> Consultas</span> <span class="font-weight-bold">40%</span></div>
                        <div class="d-flex justify-content-between mb-2 small"><span class="text-muted"><i class="fas fa-circle mr-2" style="color: #1890ff;"></i> Vacunas</span> <span class="font-weight-bold">25%</span></div>
                        <div class="d-flex justify-content-between small"><span class="text-muted"><i class="fas fa-circle mr-2" style="color: #20c997;"></i> Otros</span> <span class="font-weight-bold">35%</span></div>
                    </div>
                </div>
            </div>

            <!-- Recordatorios -->
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="vet-card">
                    <h5 class="vet-card-title">Recordatorios</h5>
                    <div class="list-item">
                        <div class="stat-icon" style="background: #f8fafc; color: #64748b;"><i class="far fa-bell"></i></div>
                        <div class="list-info">
                            <div class="list-title">Vacunas Pendientes</div>
                            <div class="list-desc text-danger font-weight-bold">3 pacientes hoy</div>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="stat-icon" style="background: #f8fafc; color: #64748b;"><i class="fas fa-shield-alt"></i></div>
                        <div class="list-info">
                            <div class="list-title">Controles de Peso</div>
                            <div class="list-desc">5 pacientes este mes</div>
                        </div>
                    </div>
                    <div class="list-item mb-0">
                        <div class="stat-icon" style="background: #f8fafc; color: #64748b;"><i class="far fa-calendar-check"></i></div>
                        <div class="list-info">
                            <div class="list-title">Cirugías Agendadas</div>
                            <div class="list-desc">1 para mañana</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
        <!-- Próximas Citas -->
        <div class="vet-card mb-4" data-aos="fade-left">
            <h5 class="vet-card-title">Mañana</h5>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info flex-grow-1">
                    <div class="list-time">09:00 AM</div>
                    <div class="list-title">Bella</div>
                    <div class="list-desc">Control Post-Operación</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Cat">
                <div class="list-info flex-grow-1">
                    <div class="list-time">11:30 AM</div>
                    <div class="list-title">Simba</div>
                    <div class="list-desc">Triple Felina</div>
                </div>
            </div>
            <div class="mt-4 pt-2">
                <a href="{{ route('citas.index') }}" class="btn btn-outline-primary btn-block" style="border-width: 2px;">Ver Calendario</a>
            </div>
        </div>

        <!-- Pacientes recientes -->
        <div class="vet-card mb-4" data-aos="fade-left" data-aos-delay="200">
            <h5 class="vet-card-title">Altas Recientes</h5>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info">
                    <div class="list-title">Rocky</div>
                    <div class="list-desc">Golden Retriever • Sano</div>
                </div>
            </div>
            <div class="list-item mb-0">
                <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Cat">
                <div class="list-info">
                    <div class="list-title">Luna</div>
                    <div class="list-desc">Gato Común • Controlado</div>
                </div>
            </div>
            <div class="mt-4 pt-2 text-center">
                <a href="{{ route('pacientes.index') }}" class="link-action font-weight-bold">Base de Datos Completa <i class="fas fa-database ml-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
