@extends('layouts.main')

@section('titulo_pagina', 'Calendario de Citas')

@section('contenido')
<style>
.calendar-toolbar, .calendar-grid { background: white; border: 1px solid #eef2f6; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
.calendar-toolbar { padding: 1.25rem 1.5rem; margin-bottom: 1.25rem; }
.calendar-grid { overflow: hidden; }
.calendar-head, .calendar-body { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); }
.calendar-head div { padding: 0.85rem; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #eef2f6; background: #f8fafc; }
.calendar-day { min-height: 135px; padding: 0.75rem; border-right: 1px solid #eef2f6; border-bottom: 1px solid #eef2f6; background: #fff; }
.calendar-day:nth-child(7n) { border-right: none; }
.calendar-day.muted { background: #f8fafc; color: #94a3b8; }
.day-number { font-weight: 800; color: #1f2d3d; margin-bottom: 0.5rem; }
.appointment-chip { display: block; border-radius: 10px; padding: 0.45rem 0.55rem; margin-bottom: 0.45rem; background: #f2eefd; color: #512da8; font-size: 0.75rem; font-weight: 700; text-decoration: none !important; }
.appointment-chip:hover { background: #7b61ff; color: white; }
.quick-add { color: #7b61ff; font-size: 0.75rem; font-weight: 800; }
.btn-vetcare { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 700; padding: 0.55rem 1.1rem; border: none; }
.btn-vetcare:hover { background-color: #512da8; color: white; }
.dark-mode .calendar-toolbar, .dark-mode .calendar-grid, .dark-mode .calendar-day { background-color: #1e293b; border-color: #334155; }
.dark-mode .calendar-head div, .dark-mode .calendar-day.muted { background-color: #0f172a; border-color: #334155; }
@media (max-width: 767.98px) { .calendar-head { display: none; } .calendar-body { grid-template-columns: 1fr; } .calendar-day { min-height: auto; border-right: none; } }
</style>

<div class="calendar-toolbar d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h2 class="font-weight-bold mb-1" style="color: #1f2d3d;">Calendario de Citas</h2>
        <p class="text-muted mb-0">Visualiza espacios ocupados antes de agendar nuevas consultas.</p>
    </div>
    <div class="d-flex align-items-center mt-3 mt-md-0" style="gap: 0.5rem;">
        <a href="{{ route('citas.calendario', ['month' => $currentMonth->copy()->subMonth()->format('Y-m')]) }}" class="btn btn-light" style="border-radius: 12px;"><i class="fas fa-chevron-left"></i></a>
        <strong style="min-width: 170px; text-align: center;">{{ ucfirst($currentMonth->translatedFormat('F Y')) }}</strong>
        <a href="{{ route('citas.calendario', ['month' => $currentMonth->copy()->addMonth()->format('Y-m')]) }}" class="btn btn-light" style="border-radius: 12px;"><i class="fas fa-chevron-right"></i></a>
        <a href="{{ route('citas.create') }}" class="btn btn-vetcare ml-2"><i class="fas fa-plus mr-1"></i> Nueva cita</a>
    </div>
</div>

<div class="calendar-grid">
    <div class="calendar-head">
        <div>Lunes</div><div>Martes</div><div>Miércoles</div><div>Jueves</div><div>Viernes</div><div>Sábado</div><div>Domingo</div>
    </div>
    <div class="calendar-body">
        @foreach($calendarDays as $day)
            @php
                $key = $day->format('Y-m-d');
                $dayCitas = $citas->get($key, collect());
            @endphp
            <div class="calendar-day {{ $day->month !== $currentMonth->month ? 'muted' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="day-number">{{ $day->format('d') }}</div>
                    @if(Auth::user()->rol !== 'usuario')
                        <a class="quick-add" href="{{ route('citas.create', ['fecha' => $key]) }}">Agendar</a>
                    @endif
                </div>
                @forelse($dayCitas as $cita)
                    <a href="{{ Auth::user()->rol === 'usuario' ? route('expedientes.index', ['id' => $cita->paciente_id]) : route('citas.edit', $cita) }}" class="appointment-chip">
                        {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('H:i') }} · {{ $cita->paciente->nombre }}
                        <div class="small" style="font-weight: 600;">{{ Str::limit($cita->motivo, 28) }}</div>
                    </a>
                @empty
                    <div class="small text-muted">Disponible</div>
                @endforelse
            </div>
        @endforeach
    </div>
</div>
@endsection
