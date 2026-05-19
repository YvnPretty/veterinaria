@extends('layouts.main')

@section('titulo_pagina', 'Expedientes Clínicos')

@section('contenido')
<style>
    /* Premium Layout Styling (No Sidebar Mode) */
    .expedientes-container {
        display: flex;
        gap: 1.8rem;
        min-height: calc(100vh - 8rem);
    }
    
    .panel-left {
        flex: 0 0 350px;
        max-width: 350px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .panel-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    /* Search Bar Styling */
    .search-card {
        background: white;
        border-radius: 16px;
        padding: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.015);
        border: 1px solid #eef2f6;
    }
    
    .search-input-wrapper {
        position: relative;
    }
    
    .search-input-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a5ba;
        font-size: 0.95rem;
    }
    
    .search-input {
        border-radius: 12px;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        transition: all 0.2s ease;
    }
    
    .search-input:focus {
        border-color: #7b61ff;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(123, 97, 255, 0.15);
        outline: none;
    }
    
    /* Patient Card List */
    .patient-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        max-height: calc(100vh - 15rem);
        overflow-y: auto;
        padding-right: 4px;
    }
    
    .patient-list::-webkit-scrollbar {
        width: 5px;
    }
    .patient-list::-webkit-scrollbar-track {
        background: transparent;
    }
    .patient-list::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    
    .patient-card {
        background: white;
        border-radius: 16px;
        padding: 1.1rem;
        border: 2px solid transparent;
        box-shadow: 0 4px 12px rgba(0,0,0,0.01);
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none !important;
        display: block;
    }
    
    .patient-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.03);
        border-color: #f2eefd;
    }
    
    .patient-card.active {
        border-color: #7b61ff;
        background-color: #fcfcff;
        box-shadow: 0 8px 20px rgba(123, 97, 255, 0.05);
    }
    
    .patient-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background-color: #f2eefd;
        color: #7b61ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
    }
    
    .patient-card.active .patient-avatar {
        background-color: #7b61ff;
        color: white;
    }
    
    /* Detailed Record Styling */
    .dossier-card {
        background: white;
        border-radius: 24px;
        padding: 1.8rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        border: 1px solid #eef2f6;
    }
    
    .dossier-avatar {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background-color: #f2eefd;
        color: #7b61ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 2.2rem;
        box-shadow: 0 8px 20px rgba(123, 97, 255, 0.1);
    }
    
    .dossier-tag {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        background-color: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }
    
    /* Medical History Timeline */
    .timeline {
        position: relative;
        padding-left: 2.5rem;
        margin-top: 1rem;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 11px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e2e8f0;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
    }
    
    .timeline-badge {
        position: absolute;
        left: -2.5rem;
        top: 4px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #7b61ff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
    
    .timeline-badge i {
        font-size: 0.65rem;
        color: #7b61ff;
    }
    
    .timeline-card {
        background: #fafafc;
        border-radius: 18px;
        padding: 1.5rem;
        border: 1px solid #f1f1f5;
        transition: all 0.2s ease;
    }
    
    .timeline-card:hover {
        background: white;
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        border-color: #e2e8f0;
    }
    
    .timeline-date {
        font-size: 0.8rem;
        font-weight: 800;
        color: #7b61ff;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .timeline-vet {
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        background: #f1f5f9;
        padding: 3px 10px;
        border-radius: 12px;
    }
    
    .clinical-section {
        display: flex;
        gap: 12px;
        margin-top: 1rem;
    }
    
    .clinical-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #fff;
        border: 1px solid #eef2f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7b61ff;
        flex-shrink: 0;
    }
    
    .clinical-text {
        font-size: 0.9rem;
        color: #334155;
        font-weight: 500;
        line-height: 1.5;
    }
    
    .badge-medicamentos {
        background-color: #e6fcf5;
        color: #0ca678;
        border: 1px solid #c3fae8;
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="expedientes-container">
    <!-- Left Column: Search and Pet List -->
    <div class="panel-left" data-aos="fade-right">
        <!-- Search bar -->
        <div class="search-card">
            <form action="{{ route('expedientes.index') }}" method="GET">
                <div class="search-input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" id="patientSearch" class="search-input" placeholder="Buscar mascota o dueño..." value="{{ request('search') }}" autocomplete="off">
                </div>
            </form>
        </div>
        
        <!-- Patients list -->
        <div class="patient-list" id="patientList">
            @forelse($pacientes as $paciente)
            <a href="?id={{ $paciente->id }}" 
               class="patient-card {{ $selectedPaciente && $selectedPaciente->id == $paciente->id ? 'active' : '' }}" 
               data-searchable="{{ strtolower($paciente->nombre . ' ' . $paciente->especie . ' ' . $paciente->raza . ' ' . ($paciente->user ? $paciente->user->name : $paciente->nombre_propietario)) }}">
                <div class="d-flex align-items-center gap-3">
                    <div class="patient-avatar">
                        {{ strtoupper(substr($paciente->nombre, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1 ml-3" style="min-width: 0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="mb-0 text-truncate font-weight-bold" style="color: #1f2d3d; font-size: 0.95rem;">{{ $paciente->nombre }}</h6>
                            <span class="badge badge-pill badge-light font-weight-bold" style="font-size: 0.7rem; color: #7b61ff; background-color: #f2eefd; padding: 4px 8px;">
                                {{ $paciente->historiales->count() }} reg.
                            </span>
                        </div>
                        <p class="mb-0 text-muted small text-truncate mt-1" style="font-weight: 500;">
                            {{ $paciente->especie }} • {{ $paciente->raza ?? 'Sin raza' }}
                        </p>
                        <p class="mb-0 text-muted small text-truncate style='font-size: 0.75rem;'" style="font-size: 0.75rem;">
                            Propietario: {{ $paciente->user ? $paciente->user->name : $paciente->nombre_propietario }}
                        </p>
                    </div>
                </div>
            </a>
            @empty
            <div class="text-center py-4 text-muted">No hay pacientes registrados.</div>
            @endforelse
        </div>
    </div>
    
    <!-- Right Column: Interactive Clinical Dossier -->
    <div class="panel-right" data-aos="fade-up">
        @if($selectedPaciente)
            <!-- Pet dossier card -->
            <div class="dossier-card">
                <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        <div class="dossier-avatar">
                            {{ strtoupper(substr($selectedPaciente->nombre, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <h3 class="mb-0 font-weight-extrabold" style="color: #1f2d3d; font-weight: 800;">{{ $selectedPaciente->nombre }}</h3>
                                <span class="dossier-tag ml-2">{{ $selectedPaciente->especie }}</span>
                                @if($selectedPaciente->raza)
                                <span class="dossier-tag">{{ $selectedPaciente->raza }}</span>
                                @endif
                                @if($selectedPaciente->edad)
                                <span class="dossier-tag">{{ $selectedPaciente->edad }} años</span>
                                @endif
                            </div>
                            
                            <!-- Propietario info -->
                            <div class="d-flex align-items-center mt-2 text-muted flex-wrap" style="gap: 15px; font-size: 0.9rem; font-weight: 600;">
                                <span>
                                    <i class="fas fa-user-circle mr-1 text-primary"></i> 
                                    Dueño: <strong>{{ $selectedPaciente->user ? $selectedPaciente->user->name : $selectedPaciente->nombre_propietario }}</strong>
                                </span>
                                @if($selectedPaciente->user ? $selectedPaciente->user->email : $selectedPaciente->telefono_propietario)
                                <span>
                                    <i class="fas fa-phone mr-1 text-success"></i> 
                                    Contacto: <strong>{{ $selectedPaciente->user ? $selectedPaciente->user->telefono : $selectedPaciente->telefono_propietario }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($selectedPaciente->observaciones)
                <div class="mt-4 p-3 bg-light rounded-lg" style="border-left: 4px solid #7b61ff; border-radius: 12px;">
                    <h6 class="font-weight-bold mb-1" style="color: #1f2d3d; font-size: 0.85rem;"><i class="fas fa-info-circle mr-1 text-primary"></i> Observaciones Generales:</h6>
                    <p class="mb-0 text-muted small" style="line-height: 1.4; font-weight: 500;">{{ $selectedPaciente->observaciones }}</p>
                </div>
                @endif
            </div>
            
            <!-- Clinical History Timeline dossier -->
            <div class="dossier-card flex-grow-1">
                <h4 class="font-weight-extrabold mb-4" style="color: #1f2d3d; font-weight: 800;">
                    <i class="fas fa-history mr-2 text-primary"></i> Expediente Clínico Completo
                </h4>
                
                @if($selectedPaciente->historiales->isNotEmpty())
                    <div class="timeline">
                        @foreach($selectedPaciente->historiales as $registro)
                        <div class="timeline-item">
                            <div class="timeline-badge">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            
                            <div class="timeline-card">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                    <span class="timeline-date">{{ \Carbon\Carbon::parse($registro->fecha)->format('d \d\e F, Y') }}</span>
                                    <span class="timeline-vet">
                                        <i class="fas fa-user-md mr-1"></i> Veterinario: {{ $registro->veterinario->name }}
                                    </span>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="clinical-section">
                                            <div class="clinical-icon" title="Diagnóstico">
                                                <i class="fas fa-notes-medical"></i>
                                            </div>
                                            <div>
                                                <h6 class="font-weight-bold mb-1" style="color: #1f2d3d; font-size: 0.85rem;">Diagnóstico</h6>
                                                <p class="clinical-text mb-0">{{ $registro->diagnostico }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="clinical-section">
                                            <div class="clinical-icon" title="Tratamiento">
                                                <i class="fas fa-band-aid"></i>
                                            </div>
                                            <div>
                                                <h6 class="font-weight-bold mb-1" style="color: #1f2d3d; font-size: 0.85rem;">Tratamiento / Procedimiento</h6>
                                                <p class="clinical-text mb-0">{{ $registro->tratamiento }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($registro->medicamentos)
                                <div class="badge-medicamentos">
                                    <i class="fas fa-pills"></i>
                                    <span><strong>Receta:</strong> {{ $registro->medicamentos }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-folder-open fa-3x mb-3 text-light"></i>
                        <p class="font-weight-bold">Este paciente aún no registra consultas en su historial médico.</p>
                        <a href="{{ route('historial.create') }}" class="btn btn-vetcare btn-sm mt-2">
                            <i class="fas fa-plus mr-1"></i> Agregar Primera Consulta
                        </a>
                    </div>
                @endif
            </div>
        @else
            <!-- Select patient empty state -->
            <div class="dossier-card flex-grow-1 d-flex flex-column align-items-center justify-content-center py-5 text-center">
                <i class="fas fa-folder-open fa-4x mb-4 text-light" style="color: #e2e8f0 !important;"></i>
                <h4 class="font-weight-bold" style="color: #1f2d3d;">Expedientes Clínicos Digitales</h4>
                <p class="text-muted max-width-400 mt-2" style="font-weight: 500;">
                    Seleccione un paciente de la lista de la izquierda para acceder a su expediente clínico completo, incluyendo datos de propietario, diagnósticos, tratamientos y recetas de consultas previas.
                </p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('patientSearch');
        const patientList = document.getElementById('patientList');
        const cards = patientList.getElementsByClassName('patient-card');
        
        const filterCards = (query) => {
            for (let card of cards) {
                const searchable = card.getAttribute('data-searchable');
                if (searchable.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        };

        // Run initial filter if there is a search value loaded from server
        if (searchInput.value) {
            filterCards(searchInput.value.toLowerCase().trim());
        }
        
        searchInput.addEventListener('input', function(e) {
            filterCards(e.target.value.toLowerCase().trim());
        });
    });
</script>
@endsection
