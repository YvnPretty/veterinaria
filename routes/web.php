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
    Route::get('/perfil', [\App\Http\Controllers\ProfileController::class, 'index'])->name('perfil.index');
    Route::get('/perfil/{user}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/{user}/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/{user}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('perfil.update');
    Route::resource('/usuarios', \App\Http\Controllers\UsuarioController::class);
    
    // Gestión Veterinaria
    Route::resource('pacientes', \App\Http\Controllers\PacienteController::class);
    Route::get('citas/calendario', [\App\Http\Controllers\CitaController::class, 'calendario'])->name('citas.calendario');
    Route::resource('citas', \App\Http\Controllers\CitaController::class);
    Route::resource('historial', \App\Http\Controllers\HistorialController::class);
    Route::get('expedientes', [\App\Http\Controllers\ExpedienteController::class, 'index'])->name('expedientes.index');

    // Rutas para Diagnóstico y Tratamiento de Consultas
    Route::get('expedientes/{paciente_id}/consultas/{consulta_id}/diagnostico', [\App\Http\Controllers\ExpedienteController::class, 'diagnostico'])->name('expedientes.consultas.diagnostico');
    Route::post('expedientes/{paciente_id}/consultas/{consulta_id}/diagnostico', [\App\Http\Controllers\ExpedienteController::class, 'guardarDiagnostico'])->name('expedientes.consultas.diagnostico.guardar');

    Route::get('expedientes/{paciente_id}/consultas/{consulta_id}/tratamiento', [\App\Http\Controllers\ExpedienteController::class, 'tratamiento'])->name('expedientes.consultas.tratamiento');
    Route::post('expedientes/{paciente_id}/consultas/{consulta_id}/tratamiento', [\App\Http\Controllers\ExpedienteController::class, 'guardarTratamiento'])->name('expedientes.consultas.tratamiento.guardar');

    // Rutas para Antecedentes e Historial
    Route::get('expedientes/{paciente_id}/antecedentes/alergias', [\App\Http\Controllers\ExpedienteController::class, 'alergias'])->name('expedientes.antecedentes.alergias');
    Route::post('expedientes/{paciente_id}/antecedentes/alergias', [\App\Http\Controllers\ExpedienteController::class, 'guardarAlergias'])->name('expedientes.antecedentes.alergias.guardar');

    Route::get('expedientes/{paciente_id}/antecedentes/lesiones', [\App\Http\Controllers\ExpedienteController::class, 'lesiones'])->name('expedientes.antecedentes.lesiones');
    Route::post('expedientes/{paciente_id}/antecedentes/lesiones', [\App\Http\Controllers\ExpedienteController::class, 'guardarLesiones'])->name('expedientes.antecedentes.lesiones.guardar');

    Route::get('expedientes/{paciente_id}/antecedentes/patologicos', [\App\Http\Controllers\ExpedienteController::class, 'patologicos'])->name('expedientes.antecedentes.patologicos');
    Route::post('expedientes/{paciente_id}/antecedentes/patologicos', [\App\Http\Controllers\ExpedienteController::class, 'guardarPatologicos'])->name('expedientes.antecedentes.patologicos.guardar');

    Route::get('expedientes/{paciente_id}/historial/alimentacion', [\App\Http\Controllers\ExpedienteController::class, 'alimentacion'])->name('expedientes.historial.alimentacion');
    Route::post('expedientes/{paciente_id}/historial/alimentacion', [\App\Http\Controllers\ExpedienteController::class, 'guardarAlimentacion'])->name('expedientes.historial.alimentacion.guardar');
});
