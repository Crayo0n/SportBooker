<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Muestra el formulario con los datos del usuario.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('perfil.editar', compact('user'));
    }

    /**
     * Procesa la actualización de datos.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validaciones
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // 2. Actualizar datos básicos
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->phone_number = $request->telefono;

        // 3. Actualizar contraseña (solo si el campo no está vacío)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Tu perfil ha sido actualizado correctamente.');
    }
}