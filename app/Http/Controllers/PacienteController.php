<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('modules.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('modules.pacientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'nombre_propietario' => 'required|string|max:255',
            'telefono_propietario' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente.');
    }

    public function show(Paciente $paciente)
    {
        return view('modules.pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return view('modules.pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'nombre_propietario' => 'required|string|max:255',
            'telefono_propietario' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente.');
    }
}
