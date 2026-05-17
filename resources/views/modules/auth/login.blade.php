@extends('layouts.auth')

@section('titulo_pagina', 'Login de usuario')

@section('contenido')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('{{ asset('img/dr_perrito.png') }}'); background-position: center; background-size: cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="sidebar-brand-icon rotate-n-15 mb-3" style="font-size: 3rem; color: #512da8;">
                                        <i class="fas fa-paw"></i>
                                    </div>
                                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                </div>
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <form action="{{ route('logear') }}" method="post" class="user">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Ingresa tu correo electrónico...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Contraseña">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Entrar
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('registro') }}">¡Regístrate aquí!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
