<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return redirect()->route('perfil.show', Auth::id());
    }

    public function show(User $user)
    {
        $this->authorizeProfileAccess($user);

        $user->load(['pacientes.historiales', 'pacientes.citas']);

        return view('modules.perfil.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorizeProfileAccess($user);

        return view('modules.perfil.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeProfileAccess($user);

        $authUser = Auth::user();
        $canEditIdentity = $authUser->rol === 'administrador' || ($authUser->id === $user->id && $authUser->rol === 'usuario');

        $rules = [
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        if ($canEditIdentity) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)];
        }

        $request->validate($rules);

        $data = [];

        if ($canEditIdentity) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
        }

        if ($request->hasFile('profile_photo')) {
            $directory = public_path('img/perfiles');

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $filename = 'perfil_' . $user->id . '_' . time() . '.' . $request->file('profile_photo')->extension();
            $request->file('profile_photo')->move($directory, $filename);

            $data['profile_photo'] = 'img/perfiles/' . $filename;
        }

        $user->update($data);

        return redirect()->route('perfil.show', $user)->with('success', 'Perfil actualizado correctamente.');
    }

    private function authorizeProfileAccess(User $user): void
    {
        abort_unless(Auth::user()->rol === 'administrador' || Auth::id() === $user->id, 403);
    }
}
