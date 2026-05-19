<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Paciente::with(['user', 'historiales.veterinario']);

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
            $selectedPaciente = Paciente::with(['user', 'historiales.veterinario'])
                ->find($request->input('id'));
        } elseif ($pacientes->isNotEmpty()) {
            // Default to the first patient in the list
            $selectedPaciente = $pacientes->first();
        }

        return view('modules.expedientes.index', compact('pacientes', 'selectedPaciente'));
    }
}
