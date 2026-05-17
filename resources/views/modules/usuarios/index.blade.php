@extends('layouts.main')

@section('titulo_pagina', 'Gestión de Usuarios')

@section('contenido')
<style>
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
.badge-soft-purple { background-color: #f2eefd; color: #7b61ff; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
.btn-vetcare { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 600; padding: 0.5rem 1.5rem; border: none; }
.btn-vetcare:hover { background-color: #512da8; color: white; }
.btn-action { color: #a0a5ba; background: transparent; border: none; margin-right: 5px; transition: color 0.2s;}
.btn-action.edit:hover { color: #1890ff; }
.btn-action.delete:hover { color: #e74a3b; }
</style>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 style="font-weight: 800; color: #1f2d3d; margin-bottom: 0;">Usuarios</h2>
        <p style="color: #6e707e; font-size: 1.05rem; margin-bottom: 0; font-weight: 500;">Administra el acceso al sistema.</p>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('usuarios.create') }}" class="btn btn-vetcare">
            <i class="fas fa-plus mr-2"></i> Nuevo Usuario
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px; background-color: #e6fcf5; color: #20c997; border: none; font-weight: 600;" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="vet-card">
    <div class="table-responsive">
        <table class="table table-clean">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha de Creación</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td><strong>{{ $usuario->name }}</strong></td>
                    <td style="color: #858796;">{{ $usuario->email }}</td>
                    <td>
                        @if($usuario->rol == 'administrador')
                            <span class="badge-soft-purple">Administrador</span>
                        @elseif($usuario->rol == 'usuario')
                            <span class="badge-soft-info" style="background-color: #e6f7ff; color: #1890ff; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;">Usuario</span>
                        @else
                            <span class="badge-soft-success">Veterinario</span>
                        @endif
                    </td>
                    <td style="color: #858796;">{{ $usuario->created_at->format('d M, Y') }}</td>
                    <td class="text-right">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4" style="color: #858796;">No hay usuarios registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
