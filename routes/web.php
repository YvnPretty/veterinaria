<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/',[AuthController::class, 'index'])->name('login');
    Route::get('/registro',[AuthController::class, 'registro'])->name('registro');
    Route::post('/registrar',[AuthController::class,'registrar'])->name('registrar');
    Route::post('/logear',[AuthController::class,'logear'])->name('logear');
});

Route::middleware("auth")->group(function () {
    Route::get('/home',[AuthController::class,'home'])->name('home');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::resource('/usuarios', \App\Http\Controllers\UsuarioController::class);
    
    // Gestión Veterinaria
    Route::resource('pacientes', \App\Http\Controllers\PacienteController::class);
    Route::resource('citas', \App\Http\Controllers\CitaController::class);
    Route::resource('historial', \App\Http\Controllers\HistorialController::class);
    Route::get('expedientes', [\App\Http\Controllers\ExpedienteController::class, 'index'])->name('expedientes.index');
});
