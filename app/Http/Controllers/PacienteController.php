<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('user')->get();
        return view('modules.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $usuarios = User::where('rol', 'usuario')->get();
        return view('modules.pacientes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'nombre_propietario' => 'required_without:user_id|nullable|string|max:255',
            'telefono_propietario' => 'required_without:user_id|nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente.');
    }

    public function edit(Paciente $paciente)
    {
        $usuarios = User::where('rol', 'usuario')->get();
        return view('modules.pacientes.edit', compact('paciente', 'usuarios'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'nombre_propietario' => 'required_without:user_id|nullable|string|max:255',
            'telefono_propietario' => 'required_without:user_id|nullable|string|max:255',
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
