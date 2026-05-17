@extends('layouts.main')

@section('titulo_pagina', 'Dashboard Veterinario')

@section('contenido')
<style>
/* Custom styles for VetCare Dashboard */
.welcome-banner {
    background-color: #fdfaf6;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    padding: 1.5rem;
    margin-bottom: 2rem;
}
@media (min-width: 768px) {
    .welcome-banner { padding: 2.5rem; }
}
.welcome-banner-img {
    position: absolute;
    right: -20px;
    bottom: -20px;
    height: 140%;
    z-index: 1;
    opacity: 0.2; /* Menos opaco en móvil */
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
    .welcome-content { max-width: 60%; }
}
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1rem 1.25rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    display: flex;
    align-items: center;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    margin-top: 1rem;
    flex: 1 1 140px; /* Responsive stats */
}
.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 12px;
}
.stat-icon.purple { background-color: #f2eefd; color: #7b61ff; }
.stat-icon.blue { background-color: #e6f7ff; color: #1890ff; }
.stat-icon.green { background-color: #e6fcf5; color: #20c997; }
.stat-value { font-size: 1.25rem; font-weight: 800; color: #1f2d3d; line-height: 1; margin-bottom: 3px; }
.stat-label { font-size: 0.75rem; color: #3a3b45; font-weight: 700; margin-bottom: 2px;}
.stat-sub { font-size: 0.65rem; color: #a0a5ba; }

.vet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.5rem;
    height: 100%;
}
.vet-card-title {
    font-weight: 800;
    color: #1f2d3d;
    font-size: 1rem;
    margin-bottom: 1.25rem;
}

.table-clean th { border-top: none; color: #858796; font-weight: 600; font-size: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid #f8f9fc; }
.table-clean td { vertical-align: middle; border-top: 1px solid #f8f9fc; padding: 0.75rem 0.5rem; color: #3a3b45; font-weight: 600; font-size: 0.85rem; }
.badge-soft-success { background-color: #e6fcf5; color: #20c997; padding: 5px 10px; border-radius: 20px; font-weight: 700; font-size: 0.7rem;}
.badge-soft-warning { background-color: #fff8e6; color: #f6c23e; padding: 5px 10px; border-radius: 20px; font-weight: 700; font-size: 0.7rem;}
.badge-soft-purple { background-color: #f2eefd; color: #7b61ff; padding: 5px 10px; border-radius: 20px; font-weight: 700; font-size: 0.7rem;}

.avatar-circle { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
.list-item { display: flex; align-items: center; margin-bottom: 1.25rem; }
.list-info { margin-left: 12px; }
.list-title { font-weight: 700; color: #1f2d3d; font-size: 0.9rem; margin-bottom: 1px; }
.list-desc { font-size: 0.75rem; color: #858796; line-height: 1.2;}
.list-time { font-size: 0.75rem; font-weight: 700; color: #1f2d3d; }

.link-action { color: #7b61ff; font-weight: 700; font-size: 0.8rem; text-decoration: none; }
</style>

<div class="row">
    <!-- Main Column (Left) -->
    <div class="col-lg-8">
        
        <!-- Welcome Banner -->
        <div class="welcome-banner shadow-sm" data-aos="fade-down">
            <img src="{{ asset('img/dogs_banner.png') }}" alt="Mascotas" class="welcome-banner-img">
            <div class="welcome-content">
                <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 10px; font-size: calc(1.3rem + 0.8vw);">¡Bienvenida, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Doc' }}!</h2>
                <p style="color: #6e707e; font-size: 0.95rem; margin-bottom: 0; font-weight: 500;">Resumen de la clínica para hoy.</p>
                
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                        <div class="stat-icon purple"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <div class="stat-value">8</div>
                            <div class="stat-label">Citas hoy</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                        <div class="stat-icon blue"><i class="fas fa-paw"></i></div>
                        <div>
                            <div class="stat-value">24</div>
                            <div class="stat-label">Pacientes</div>
                        </div>
                    </div>
                    
                    <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                        <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                        <div>
                            <div class="stat-value">15</div>
                            <div class="stat-label">Facturas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Citas de hoy -->
            <div class="col-12 mb-4" data-aos="fade-up">
                <div class="vet-card">
                    <div class="vet-card-title">Citas de hoy</div>
                    <div class="table-responsive">
                        <table class="table table-clean" style="min-width: 350px;">
                            <tbody>
                                <tr>
                                    <td>09:00</td>
                                    <td><strong>Max</strong></td>
                                    <td class="text-muted d-none d-sm-table-cell">Consulta</td>
                                    <td class="text-right"><span class="badge-soft-success">OK</span></td>
                                </tr>
                                <tr>
                                    <td>10:30</td>
                                    <td><strong>Luna</strong></td>
                                    <td class="text-muted d-none d-sm-table-cell">Vacunas</td>
                                    <td class="text-right"><span class="badge-soft-purple">En curso</span></td>
                                </tr>
                                <tr>
                                    <td>12:00</td>
                                    <td><strong>Rocky</strong></td>
                                    <td class="text-muted d-none d-sm-table-cell">Control</td>
                                    <td class="text-right"><span class="badge-soft-warning">Pend.</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('citas.index') }}" class="link-action">Ver agenda <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>

            <!-- Servicios -->
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="vet-card">
                    <div class="vet-card-title">Servicios</div>
                    <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                        <div style="position: relative; width: 120px; height: 120px; border-radius: 50%; background: conic-gradient(#7b61ff 0% 40%, #1890ff 40% 65%, #20c997 65% 85%, #f6c23e 85% 100%); display: flex; justify-content: center; align-items: center;">
                            <div style="width: 70px; height: 70px; background: white; border-radius: 50%;"></div>
                        </div>
                    </div>
                    <div class="mt-3 small">
                        <div class="d-flex justify-content-between mb-1"><span class="text-muted"><i class="fas fa-circle mr-2" style="color: #7b61ff;"></i> Consultas</span> <span class="font-weight-bold">40%</span></div>
                        <div class="d-flex justify-content-between"><span class="text-muted"><i class="fas fa-circle mr-2" style="color: #1890ff;"></i> Otros</span> <span class="font-weight-bold">60%</span></div>
                    </div>
                </div>
            </div>

            <!-- Recordatorios -->
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="vet-card">
                    <div class="vet-card-title">Recordatorios</div>
                    <div class="list-item mt-2">
                        <div class="stat-icon" style="background: #f8f9fc; width: 35px; height: 35px; color: #858796;"><i class="far fa-bell"></i></div>
                        <div class="list-info">
                            <div class="list-title">Vacunas</div>
                            <div class="list-desc">3 pacientes</div>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="stat-icon" style="background: #f8f9fc; width: 35px; height: 35px; color: #858796;"><i class="fas fa-shield-alt"></i></div>
                        <div class="list-info">
                            <div class="list-title">Controles</div>
                            <div class="list-desc">5 pacientes</div>
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
            <div class="vet-card-title">Próximas citas</div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info flex-grow-1">
                    <div class="list-time">Mañana, 09:00</div>
                    <div class="list-title">Bella</div>
                    <div class="list-desc">Consulta general</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" class="avatar-circle" alt="Cat">
                <div class="list-info flex-grow-1">
                    <div class="list-time">Mañana, 11:00</div>
                    <div class="list-title">Simba</div>
                    <div class="list-desc">Vacunación</div>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('citas.index') }}" class="link-action small">Ver todas las citas <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>

        <!-- Pacientes recientes -->
        <div class="vet-card mb-4" data-aos="fade-left" data-aos-delay="200">
            <div class="vet-card-title">Pacientes recientes</div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info">
                    <div class="list-title">Rocky</div>
                    <div class="list-desc">Golden Retriever</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" class="avatar-circle" alt="Cat">
                <div class="list-info">
                    <div class="list-title">Luna</div>
                    <div class="list-desc">Gato</div>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('pacientes.index') }}" class="link-action small">Ver todos <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
