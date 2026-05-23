@extends('layouts.main')

@section('titulo_pagina', 'Perfil')

@section('contenido')
<style>
.profile-shell { display: grid; grid-template-columns: 320px 1fr; gap: 1.5rem; }
.profile-card, .profile-panel { background: white; border: 1px solid #eef2f6; border-radius: 20px; padding: 1.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
.profile-photo { width: 128px; height: 128px; border-radius: 50%; object-fit: cover; border: 4px solid #f2eefd; }
.role-pill { display: inline-flex; align-items: center; border-radius: 999px; padding: 6px 12px; font-weight: 800; font-size: 0.75rem; background: #f2eefd; color: #7b61ff; text-transform: capitalize; }
.pet-mini-card { border: 1px solid #eef2f6; border-radius: 16px; padding: 1rem; height: 100%; background: #fafbff; }
.pet-avatar { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background: #7b61ff; color: white; font-weight: 800; }
.btn-vetcare { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 700; padding: 0.65rem 1.25rem; border: none; }
.btn-vetcare:hover { background-color: #512da8; color: white; }
.dark-mode .profile-card, .dark-mode .profile-panel, .dark-mode .pet-mini-card { background-color: #1e293b; border-color: #334155; color: #cbd5e1; }
@media (max-width: 991.98px) { .profile-shell { grid-template-columns: 1fr; } }
</style>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px;" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
@endif

<div class="profile-shell">
    <aside class="profile-card text-center">
        <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil" class="profile-photo mb-3">
        <h3 class="font-weight-bold mb-1" style="color: #1f2d3d;">{{ $user->name }}</h3>
        <div class="text-muted mb-3">{{ $user->email }}</div>
        <span class="role-pill mb-4"><i class="fas fa-user-tag mr-2"></i>{{ $user->rol }}</span>
        <div>
            <a href="{{ route('perfil.edit', $user) }}" class="btn btn-vetcare btn-block">
                <i class="fas fa-camera mr-2"></i> Editar Perfil
            </a>
        </div>
    </aside>

    <section class="profile-panel">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <div>
                <h2 class="font-weight-bold mb-1" style="color: #1f2d3d;">Información del Perfil</h2>
                <p class="text-muted mb-0">Datos visibles dentro del sistema veterinario.</p>
            </div>
            @if(Auth::user()->rol === 'administrador')
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary mt-3 mt-md-0" style="border-radius: 12px; font-weight: 700;">
                    <i class="fas fa-users mr-2"></i> Ver usuarios
                </a>
            @endif
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="text-muted small font-weight-bold text-uppercase">Nombre</div>
                <div class="font-weight-bold">{{ $user->name }}</div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="text-muted small font-weight-bold text-uppercase">Correo</div>
                <div class="font-weight-bold">{{ $user->email }}</div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="text-muted small font-weight-bold text-uppercase">Rol</div>
                <div class="font-weight-bold text-capitalize">{{ $user->rol }}</div>
            </div>
        </div>

        @if($user->rol === 'usuario')
            <hr>
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h4 class="font-weight-bold mb-0" style="color: #1f2d3d;">Mascotas del Cliente</h4>
                @if(Auth::user()->rol !== 'usuario')
                    <a href="{{ route('pacientes.create') }}" class="btn btn-sm btn-vetcare mt-2 mt-sm-0">
                        <i class="fas fa-plus mr-1"></i> Registrar mascota
                    </a>
                @endif
            </div>
            <div class="row">
                @forelse($user->pacientes as $paciente)
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('expedientes.index', ['id' => $paciente->id]) }}" class="text-decoration-none">
                            <div class="pet-mini-card">
                                <div class="d-flex align-items-center">
                                    <div class="pet-avatar">{{ strtoupper(substr($paciente->nombre, 0, 1)) }}</div>
                                    <div class="ml-3">
                                        <div class="font-weight-bold text-gray-900">{{ $paciente->nombre }}</div>
                                        <div class="small text-muted">{{ $paciente->especie }} {{ $paciente->raza ? '• ' . $paciente->raza : '' }}</div>
                                    </div>
                                </div>
                                <div class="small text-muted mt-3">
                                    {{ $paciente->historiales->count() }} registros clínicos · {{ $paciente->citas->count() }} citas
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-4">Este cliente aún no tiene mascotas registradas.</div>
                    </div>
                @endforelse
            </div>
        @else
            <div class="text-muted">
                Este perfil pertenece al equipo de la clínica. Desde aquí solo se gestiona la foto de perfil; la edición administrativa se conserva en Gestión de Usuarios.
            </div>
        @endif
    </section>
</div>
@endsection
