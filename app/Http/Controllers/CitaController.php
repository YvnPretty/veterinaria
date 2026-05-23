<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('paciente')
            ->when(Auth::user()->rol === 'usuario', function ($query) {
                $query->whereHas('paciente', function ($pacienteQuery) {
                    $pacienteQuery->where('user_id', Auth::id());
                });
            })
            ->orderBy('fecha_hora', 'asc')
            ->get();

        return view('modules.citas.index', compact('citas'));
    }

    public function calendario(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $currentMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $startCalendar = $currentMonth->copy()->startOfWeek(Carbon::MONDAY);
        $endCalendar = $currentMonth->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $citas = Cita::with('paciente')
            ->when(Auth::user()->rol === 'usuario', function ($query) {
                $query->whereHas('paciente', function ($pacienteQuery) {
                    $pacienteQuery->where('user_id', Auth::id());
                });
            })
            ->whereBetween('fecha_hora', [$startCalendar, $endCalendar])
            ->orderBy('fecha_hora')
            ->get()
            ->groupBy(function ($cita) {
                return Carbon::parse($cita->fecha_hora)->format('Y-m-d');
            });

        $calendarDays = [];
        $cursor = $startCalendar->copy();

        while ($cursor <= $endCalendar) {
            $calendarDays[] = $cursor->copy();
            $cursor->addDay();
        }

        return view('modules.citas.calendario', compact('calendarDays', 'currentMonth', 'citas'));
    }

    public function create()
    {
        $pacientes = Paciente::when(Auth::user()->rol === 'usuario', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('nombre')->get();

        return view('modules.citas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
            'notas' => 'nullable|string',
        ]);

        if (Auth::user()->rol === 'usuario') {
            abort_unless(Paciente::where('id', $request->paciente_id)->where('user_id', Auth::id())->exists(), 403);
        }

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente.');
    }

    public function edit(Cita $cita)
    {
        if (Auth::user()->rol === 'usuario') {
            abort_unless($cita->paciente && $cita->paciente->user_id === Auth::id(), 403);
        }

        $pacientes = Paciente::when(Auth::user()->rol === 'usuario', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('nombre')->get();

        return view('modules.citas.edit', compact('cita', 'pacientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
            'notas' => 'nullable|string',
        ]);

        if (Auth::user()->rol === 'usuario') {
            abort_unless($cita->paciente && $cita->paciente->user_id === Auth::id(), 403);
            abort_unless(Paciente::where('id', $request->paciente_id)->where('user_id', Auth::id())->exists(), 403);
        }

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        if (Auth::user()->rol === 'usuario') {
            abort_unless($cita->paciente && $cita->paciente->user_id === Auth::id(), 403);
        }

        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
