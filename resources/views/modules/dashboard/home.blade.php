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
    padding: 2.5rem;
    margin-bottom: 2rem;
}
.welcome-banner-img {
    position: absolute;
    right: -20px;
    bottom: -20px;
    height: 140%;
    z-index: 1;
}
.welcome-content {
    position: relative;
    z-index: 2;
    max-width: 60%;
}
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.2rem 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    display: inline-flex;
    align-items: center;
    margin-right: 1rem;
    margin-top: 1.5rem;
    min-width: 170px;
}
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-right: 15px;
}
.stat-icon.purple { background-color: #f2eefd; color: #7b61ff; }
.stat-icon.blue { background-color: #e6f7ff; color: #1890ff; }
.stat-icon.green { background-color: #e6fcf5; color: #20c997; }
.stat-value { font-size: 1.5rem; font-weight: 800; color: #1f2d3d; line-height: 1; margin-bottom: 5px; }
.stat-label { font-size: 0.85rem; color: #3a3b45; font-weight: 700; margin-bottom: 2px;}
.stat-sub { font-size: 0.75rem; color: #a0a5ba; }

.vet-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.8rem;
    height: 100%;
}
.vet-card-title {
    font-weight: 800;
    color: #1f2d3d;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

.table-clean th { border-top: none; color: #858796; font-weight: 600; font-size: 0.85rem; padding-bottom: 1rem; border-bottom: 1px solid #f8f9fc; }
.table-clean td { vertical-align: middle; border-top: 1px solid #f8f9fc; padding: 1rem 0.5rem; color: #3a3b45; font-weight: 600; font-size: 0.9rem; }
.badge-soft-success { background-color: #e6fcf5; color: #20c997; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
.badge-soft-warning { background-color: #fff8e6; color: #f6c23e; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
.badge-soft-purple { background-color: #f2eefd; color: #7b61ff; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}

.avatar-circle { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; }
.list-item { display: flex; align-items: center; margin-bottom: 1.5rem; }
.list-item:last-child { margin-bottom: 0; }
.list-info { margin-left: 15px; }
.list-title { font-weight: 700; color: #1f2d3d; font-size: 0.95rem; margin-bottom: 2px; }
.list-desc { font-size: 0.8rem; color: #858796; line-height: 1.3;}
.list-time { font-size: 0.8rem; font-weight: 700; color: #1f2d3d; }

.link-action { color: #7b61ff; font-weight: 600; font-size: 0.85rem; text-decoration: none; }
.link-action:hover { color: #512da8; text-decoration: none; }

@media (max-width: 991px) {
    .welcome-banner-img { opacity: 0.3; }
    .welcome-content { max-width: 100%; }
}
</style>

<div class="row">
    <!-- Main Column (Left) -->
    <div class="col-lg-8">
        
        <!-- Welcome Banner -->
        <div class="welcome-banner shadow-sm">
            <img src="{{ asset('img/dogs_banner.png') }}" alt="Mascotas" class="welcome-banner-img">
            <div class="welcome-content">
                <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 10px; font-size: 1.8rem;">¡Bienvenida, {{ Auth::check() ? Auth::user()->name : 'Dra. Laura' }}!</h2>
                <p style="color: #6e707e; font-size: 1.05rem; margin-bottom: 0; font-weight: 500;">Aquí tienes un resumen de la actividad en tu clínica hoy.</p>
                
                <div class="d-flex flex-wrap">
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <div class="stat-value">8</div>
                            <div class="stat-label">Citas hoy</div>
                            <div class="stat-sub">2 pendientes</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-paw"></i></div>
                        <div>
                            <div class="stat-value">24</div>
                            <div class="stat-label">Pacientes</div>
                            <div class="stat-sub">este mes</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                        <div>
                            <div class="stat-value">15</div>
                            <div class="stat-label">Facturas</div>
                            <div class="stat-sub">pendientes</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Citas de hoy -->
            <div class="col-12 mb-4">
                <div class="vet-card">
                    <div class="vet-card-title">Citas de hoy</div>
                    <div class="table-responsive">
                        <table class="table table-clean">
                            <tbody>
                                <tr>
                                    <td style="color: #1f2d3d;">09:00</td>
                                    <td><strong>Max</strong></td>
                                    <td style="color: #858796;">Consulta general</td>
                                    <td class="text-right"><span class="badge-soft-success">Completada</span></td>
                                </tr>
                                <tr>
                                    <td style="color: #1f2d3d;">10:30</td>
                                    <td><strong>Luna</strong></td>
                                    <td style="color: #858796;">Vacunación</td>
                                    <td class="text-right"><span class="badge-soft-purple">En proceso</span></td>
                                </tr>
                                <tr>
                                    <td style="color: #1f2d3d;">12:00</td>
                                    <td><strong>Rocky</strong></td>
                                    <td style="color: #858796;">Control</td>
                                    <td class="text-right"><span class="badge-soft-warning">Pendiente</span></td>
                                </tr>
                                <tr>
                                    <td style="color: #1f2d3d;">16:00</td>
                                    <td><strong>Milo</strong></td>
                                    <td style="color: #858796;">Consulta general</td>
                                    <td class="text-right"><span class="badge-soft-warning">Pendiente</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <a href="#" class="link-action">Ver todas las citas <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>

            <!-- Servicios -->
            <div class="col-md-6 mb-4">
                <div class="vet-card">
                    <div class="vet-card-title">Servicios más realizados</div>
                    <div class="d-flex justify-content-center align-items-center" style="height: 180px;">
                        <div style="position: relative; width: 140px; height: 140px; border-radius: 50%; background: conic-gradient(#7b61ff 0% 40%, #1890ff 40% 65%, #20c997 65% 85%, #f6c23e 85% 100%); display: flex; justify-content: center; align-items: center;">
                            <div style="width: 80px; height: 80px; background: white; border-radius: 50%;"></div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-2"><span style="font-size: 0.85rem; color:#858796; font-weight:600;"><i class="fas fa-circle mr-2" style="color: #7b61ff!important;"></i> Consultas</span> <span class="font-weight-bold" style="font-size: 0.85rem; color:#1f2d3d;">40%</span></div>
                        <div class="d-flex justify-content-between mb-2"><span style="font-size: 0.85rem; color:#858796; font-weight:600;"><i class="fas fa-circle mr-2" style="color: #1890ff!important;"></i> Vacunación</span> <span class="font-weight-bold" style="font-size: 0.85rem; color:#1f2d3d;">25%</span></div>
                        <div class="d-flex justify-content-between mb-2"><span style="font-size: 0.85rem; color:#858796; font-weight:600;"><i class="fas fa-circle mr-2" style="color: #20c997!important;"></i> Desparasitación</span> <span class="font-weight-bold" style="font-size: 0.85rem; color:#1f2d3d;">20%</span></div>
                        <div class="d-flex justify-content-between"><span style="font-size: 0.85rem; color:#858796; font-weight:600;"><i class="fas fa-circle text-warning mr-2"></i> Cirugías</span> <span class="font-weight-bold" style="font-size: 0.85rem; color:#1f2d3d;">15%</span></div>
                    </div>
                </div>
            </div>

            <!-- Recordatorios -->
            <div class="col-md-6 mb-4">
                <div class="vet-card">
                    <div class="vet-card-title">Recordatorios</div>
                    <div class="list-item mt-2">
                        <div class="stat-icon" style="background: #f8f9fc; width: 42px; height: 42px; color: #858796; font-size: 1.1rem;"><i class="far fa-bell"></i></div>
                        <div class="list-info">
                            <div class="list-title">Recordatorio de vacunas</div>
                            <div class="list-desc">3 pacientes</div>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="stat-icon" style="background: #f8f9fc; width: 42px; height: 42px; color: #858796; font-size: 1.1rem;"><i class="fas fa-shield-alt"></i></div>
                        <div class="list-info">
                            <div class="list-title">Desparasitación mensual</div>
                            <div class="list-desc">5 pacientes</div>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="stat-icon" style="background: #f8f9fc; width: 42px; height: 42px; color: #858796; font-size: 1.1rem;"><i class="far fa-calendar-check"></i></div>
                        <div class="list-info">
                            <div class="list-title">Chequeos anuales</div>
                            <div class="list-desc">2 pacientes</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
        <!-- Próximas Citas -->
        <div class="vet-card mb-4">
            <div class="vet-card-title">Próximas citas</div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info flex-grow-1">
                    <div class="list-time">Mañana, 09:00</div>
                    <div class="list-title">Bella</div>
                    <div class="list-desc">Consulta general</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Cat">
                <div class="list-info flex-grow-1">
                    <div class="list-time">Mañana, 11:00</div>
                    <div class="list-title">Simba</div>
                    <div class="list-desc">Vacunación</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info flex-grow-1">
                    <div class="list-time">Mañana, 17:00</div>
                    <div class="list-title">Nina</div>
                    <div class="list-desc">Control</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="#" class="link-action">Ver calendario completo <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>

        <!-- Pacientes recientes -->
        <div class="vet-card mb-4">
            <div class="vet-card-title">Pacientes recientes</div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info">
                    <div class="list-title">Rocky</div>
                    <div class="list-desc">Golden Retriever<br>2 años</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Cat">
                <div class="list-info">
                    <div class="list-title">Luna</div>
                    <div class="list-desc">Gato<br>1 año</div>
                </div>
            </div>
            <div class="list-item">
                <img src="https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="avatar-circle" alt="Dog">
                <div class="list-info">
                    <div class="list-title">Max</div>
                    <div class="list-desc">Bulldog Francés<br>3 años</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="#" class="link-action">Ver todos los pacientes <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
