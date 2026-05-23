<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpedienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Paciente::with(['user', 'historiales.veterinario', 'citas']);

        if (Auth::user()->rol === 'usuario') {
            $query->where('user_id', Auth::id());
        }

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('especie', 'like', "%{$search}%")
                  ->orWhere('raza', 'like', "%{$search}%")
                  ->orWhere('nombre_propietario', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $pacientes = $query->get();

        // Check if a specific patient ID was requested
        $selectedPaciente = null;
        if ($request->has('id')) {
            $selectedPaciente = Paciente::with(['user', 'historiales.veterinario', 'citas'])
                ->when(Auth::user()->rol === 'usuario', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->find($request->input('id'));
        } elseif ($pacientes->isNotEmpty()) {
            // Default to the first patient in the list
            $selectedPaciente = $pacientes->first();
        }

        return view('modules.expedientes.index', compact('pacientes', 'selectedPaciente'));
    }

    // Diagnóstico
    public function diagnostico($paciente_id, $consulta_id)
    {
        $selectedPaciente = Paciente::findOrFail($paciente_id);
        $selectedConsulta = HistorialMedico::findOrFail($consulta_id);
        return view('modules.expedientes.diagnostico', compact('selectedPaciente', 'selectedConsulta'));
    }

    public function guardarDiagnostico(Request $request, $paciente_id, $consulta_id)
    {
        $request->validate([
            'diagnostico' => 'required|string',
        ]);

        $consulta = HistorialMedico::findOrFail($consulta_id);
        $consulta->diagnostico = $request->input('diagnostico');
        $consulta->save();

        return redirect()->back()->with('success', 'Diagnóstico guardado correctamente.');
    }

    // Tratamiento
    public function tratamiento($paciente_id, $consulta_id)
    {
        $selectedPaciente = Paciente::findOrFail($paciente_id);
        $selectedConsulta = HistorialMedico::findOrFail($consulta_id);
        return view('modules.expedientes.tratamiento', compact('selectedPaciente', 'selectedConsulta'));
    }

    public function guardarTratamiento(Request $request, $paciente_id, $consulta_id)
    {
        $request->validate([
            'tratamiento' => 'required|string',
        ]);

        $consulta = HistorialMedico::findOrFail($consulta_id);
        $consulta->tratamiento = $request->input('tratamiento');
        $consulta->save();

        return redirect()->back()->with('success', 'Tratamiento guardado correctamente.');
    }

    // Antecedentes de Alergias
    public function alergias($paciente_id)
    {
        $selectedPaciente = Paciente::findOrFail($paciente_id);
        return view('modules.expedientes.alergias', compact('selectedPaciente'));
    }

    public function guardarAlergias(Request $request, $paciente_id)
    {
        $request->validate([
            'antecedentes_alergias' => 'required|string',
        ]);

        $paciente = Paciente::findOrFail($paciente_id);
        $paciente->antecedentes_alergias = $request->input('antecedentes_alergias');
        $paciente->save();

        return redirect()->back()->with('success', 'Antecedentes de Alergias guardados correctamente.');
    }

    // Antecedentes de Lesiones
    public function lesiones($paciente_id)
    {
        $selectedPaciente = Paciente::findOrFail($paciente_id);
        return view('modules.expedientes.lesiones', compact('selectedPaciente'));
    }

    public function guardarLesiones(Request $request, $paciente_id)
    {
        $request->validate([
            'antecedentes_lesiones' => 'required|string',
        ]);

        $paciente = Paciente::findOrFail($paciente_id);
        $paciente->antecedentes_lesiones = $request->input('antecedentes_lesiones');
        $paciente->save();

        return redirect()->back()->with('success', 'Antecedentes de Lesiones guardados correctamente.');
    }

    // Antecedentes Patológicos
    public function patologicos($paciente_id)
    {
        $selectedPaciente = Paciente::findOrFail($paciente_id);
        return view('modules.expedientes.patologicos', compact('selectedPaciente'));
    }

    public function guardarPatologicos(Request $request, $paciente_id)
    {
        $request->validate([
            'antecedentes_patologicos' => 'required|string',
        ]);

        $paciente = Paciente::findOrFail($paciente_id);
        $paciente->antecedentes_patologicos = $request->input('antecedentes_patologicos');
        $paciente->save();

        return redirect()->back()->with('success', 'Antecedentes Patológicos guardados correctamente.');
    }

    // Historial de Alimentación
    public function alimentacion($paciente_id)
    {
        $selectedPaciente = Paciente::findOrFail($paciente_id);
        return view('modules.expedientes.alimentacion', compact('selectedPaciente'));
    }

    public function guardarAlimentacion(Request $request, $paciente_id)
    {
        $request->validate([
            'historial_alimentacion' => 'required|string',
        ]);

        $paciente = Paciente::findOrFail($paciente_id);
        $paciente->historial_alimentacion = $request->input('historial_alimentacion');
        $paciente->save();

        return redirect()->back()->with('success', 'Historial de Alimentación guardado correctamente.');
    }
}
