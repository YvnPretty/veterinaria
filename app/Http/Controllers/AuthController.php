<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\HistorialMedico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view("modules/auth/login");
    }

    public function registro(){
        return view("modules/auth/registro");
    }

    public function registrar(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'rol' => 'required|in:administrador,veterinario,usuario',
        ]);

        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->rol = $request->rol;
        $item->save();
        return to_route('login');
    }

    public function logear(Request $request) {
        $creadenciales = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($creadenciales)) {
            return to_route('home');
        } else {
            return to_route('login')->with('error', 'Credenciales incorrectas');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return to_route('login');
    }

    public function home() {
        if (Auth::user()->rol === 'administrador') {
            $stats = [
                'usuarios' => User::count(),
                'veterinarios' => User::where('rol', 'veterinario')->count(),
                'pacientes' => Paciente::count(),
                'citasPendientes' => Cita::whereIn('estado', ['pendiente', 'en_proceso'])->count(),
                'consultasMes' => HistorialMedico::whereMonth('fecha', now()->month)->whereYear('fecha', now()->year)->count(),
            ];

            $ultimasCitas = Cita::with('paciente')->orderBy('fecha_hora')->limit(5)->get();
            $ultimosRegistros = HistorialMedico::with(['paciente', 'veterinario'])->orderBy('fecha', 'desc')->limit(5)->get();

            return view('modules/dashboard/admin', compact('stats', 'ultimasCitas', 'ultimosRegistros'));
        }
        
        if (Auth::user()->rol === 'usuario') {
            $pacientes = Paciente::with(['historiales', 'citas'])
                ->where('user_id', Auth::id())
                ->orderBy('nombre')
                ->get();
            $proximasCitas = Cita::with('paciente')
                ->whereHas('paciente', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->where('fecha_hora', '>=', now())
                ->whereIn('estado', ['pendiente', 'en_proceso'])
                ->orderBy('fecha_hora')
                ->limit(5)
                ->get();

            return view('modules/dashboard/usuario', compact('pacientes', 'proximasCitas'));
        }
        
        $stats = [
            'citasHoy' => Cita::whereDate('fecha_hora', today())->count(),
            'pacientes' => Paciente::count(),
            'consultasMes' => HistorialMedico::whereMonth('fecha', now()->month)->whereYear('fecha', now()->year)->count(),
        ];

        $citasHoy = Cita::with('paciente')
            ->whereDate('fecha_hora', today())
            ->orderBy('fecha_hora')
            ->get();
        $citasManana = Cita::with('paciente')
            ->whereDate('fecha_hora', today()->addDay())
            ->orderBy('fecha_hora')
            ->get();
        $altasRecientes = HistorialMedico::with('paciente')
            ->orderBy('fecha', 'desc')
            ->limit(3)
            ->get();

        return view('modules/dashboard/home', compact('stats', 'citasHoy', 'citasManana', 'altasRecientes'));
    }
}
