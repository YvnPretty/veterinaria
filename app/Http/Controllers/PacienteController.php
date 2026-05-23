<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('user')
            ->when(Auth::user()->rol === 'usuario', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('nombre')
            ->get();

        return view('modules.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        abort_if(Auth::user()->rol === 'usuario', 403);

        $usuarios = User::where('rol', 'usuario')->get();
        return view('modules.pacientes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->rol === 'usuario', 403);

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
        if (Auth::user()->rol === 'usuario') {
            abort_unless($paciente->user_id === Auth::id(), 403);
        }

        $usuarios = User::where('rol', 'usuario')->get();
        return view('modules.pacientes.edit', compact('paciente', 'usuarios'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        if (Auth::user()->rol === 'usuario') {
            abort_unless($paciente->user_id === Auth::id(), 403);
        }

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
        if (Auth::user()->rol === 'usuario') {
            abort_unless($paciente->user_id === Auth::id(), 403);
        }

        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente.');
    }
}
