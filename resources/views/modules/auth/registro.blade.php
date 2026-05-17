@extends('layouts.auth')

@section('titulo_pagina', 'Registro de usuario')

@section('contenido')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-register-image" style="background-image: url('{{ asset('img/dr_perrito.png') }}'); background-position: center; background-size: cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="sidebar-brand-icon rotate-n-15 mb-3" style="font-size: 3rem; color: #512da8;">
                                        <i class="fas fa-paw"></i>
                                    </div>
                                    <h1 class="h4 text-gray-900 mb-4">¡Crea una cuenta!</h1>
                                </div>

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('registrar') }}" method="post" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Nombre completo">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Correo electrónico">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control rounded-pill" style="height: 3.2rem; padding: 0.5rem 1.5rem;" name="rol" id="rol">
                                            <option value="" disabled selected>Selecciona un rol...</option>
                                            <option value="veterinario">Veterinario</option>
                                            <option value="administrador">Administrador</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Registrar Cuenta
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">¿Ya tienes una cuenta? ¡Inicia sesión!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
