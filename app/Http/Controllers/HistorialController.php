<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $historiales = HistorialMedico::with(['paciente', 'veterinario'])->orderBy('fecha', 'desc')->get();
        return view('modules.historial.index', compact('historiales'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('modules.historial.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'medicamentos' => 'nullable|string',
        ]);

        HistorialMedico::create([
            'paciente_id' => $request->paciente_id,
            'veterinario_id' => Auth::id(),
            'fecha' => $request->fecha,
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'medicamentos' => $request->medicamentos,
        ]);

        return redirect()->route('historial.index')->with('success', 'Registro médico agregado exitosamente.');
    }

    public function edit(HistorialMedico $historial)
    {
        $pacientes = Paciente::all();
        return view('modules.historial.edit', compact('historial', 'pacientes'));
    }

    public function update(Request $request, HistorialMedico $historial)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'medicamentos' => 'nullable|string',
        ]);

        $historial->update($request->all());

        return redirect()->route('historial.index')->with('success', 'Registro médico actualizado exitosamente.');
    }

    public function destroy(HistorialMedico $historial)
    {
        $historial->delete();
        return redirect()->route('historial.index')->with('success', 'Registro médico eliminado exitosamente.');
    }
}
