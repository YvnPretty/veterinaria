@extends('layouts.main')

@section('titulo_pagina', 'Editar Perfil')

@section('contenido')
<style>
.profile-form-card { background: white; border: 1px solid #eef2f6; border-radius: 20px; padding: 1.8rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
.profile-preview { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #f2eefd; }
.form-control-vet { border-radius: 12px; padding: 0.75rem 1rem; border: 1px solid #e3e6f0; color: #3a3b45; }
.form-label { font-weight: 700; color: #1f2d3d; }
.btn-vetcare { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 700; padding: 0.75rem 1.5rem; border: none; }
.btn-vetcare:hover { background-color: #512da8; color: white; }
.btn-secondary-vet { background-color: #f8f9fc; color: #858796; border-radius: 12px; font-weight: 700; padding: 0.75rem 1.5rem; border: 1px solid #e3e6f0; }
.dark-mode .profile-form-card { background-color: #1e293b; border-color: #334155; }
</style>

@php
    $canEditIdentity = Auth::user()->rol === 'administrador' || (Auth::id() === $user->id && Auth::user()->rol === 'usuario');
@endphp

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Editar Perfil</h2>
        <p class="text-muted mb-0">Actualiza la foto del perfil{{ $canEditIdentity ? ' y los datos principales.' : '.' }}</p>
    </div>
</div>

<div class="profile-form-card">
    <form action="{{ route('perfil.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex align-items-center mb-4 flex-wrap">
            <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil actual" class="profile-preview mr-4 mb-3 mb-sm-0">
            <div class="flex-grow-1">
                <label for="profile_photo" class="form-label">Foto de perfil</label>
                <input type="file" class="form-control form-control-vet @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo" accept="image/*">
                <small class="text-muted">JPG, PNG o WEBP. Máximo 2 MB.</small>
                @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        @if($canEditIdentity)
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-vet @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control form-control-vet @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        @else
            <div class="alert alert-info" style="border-radius: 12px;">
                Tu rol mantiene nombre y correo gestionados por administración. Aquí puedes actualizar tu foto.
            </div>
        @endif

        <div class="mt-4 text-right">
            <a href="{{ route('perfil.show', $user) }}" class="btn btn-secondary-vet mr-2">Cancelar</a>
            <button type="submit" class="btn btn-vetcare">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
