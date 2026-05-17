<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('paciente')->orderBy('fecha_hora', 'asc')->get();
        return view('modules.citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
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

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente.');
    }

    public function edit(Cita $cita)
    {
        $pacientes = Paciente::all();
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

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
