<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Documentos_Usuario; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 

class RegistroController extends Controller
{
    public function storeOcasional(Request $request)
    {
        // 1. VALIDACIÓN (Backend puro)
        // Revisamos que manden texto y ARCHIVOS reales (max 5MB = 5120KB)
        $request->validate([
            'nombre'      => 'required|string',
            'apellido'    => 'required|string',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8',
            'telefono'    => 'required',
            'archivo_ine' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', 
            'archivo_dom' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // 2. CREAR EL USUARIO (Pendiente de Verificación)
        // Buscamos el ID del rol 'ClienteOcasional'
        $rol = Roles::where('nombre', 'ClienteOcasional')->first();

        $user = User::create([
            'role_id'  => $rol->id ?? 3, 
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->telefono,
            'status'   => 'PendienteVerificacion' 
        ]);

        // 3. MANEJO DE ARCHIVOS 
        
        // A. Guardar INE
        if ($request->hasFile('archivo_ine')) {
            // Esto guarda el archivo en la carpeta 'storage/app/private/documentos'
            // Laravel genera un nombre único automáticamente.
            $pathIne = $request->file('archivo_ine')->store('documentos', 'local');

            // Guardamos la referencia en la BD
            Documentos_Usuario::create([
                'user_id'        => $user->id,
                'tipo' => 'INE',
                'file_path'   => $pathIne,
                'status_verificacion' => 'Pendiente'
            ]);
        }

        // B. Guardar Comprobante
        if ($request->hasFile('archivo_dom')) {
            $pathDom = $request->file('archivo_dom')->store('documentos', 'local');

            Documentos_Usuario::create([
                'user_id'        => $user->id,
                'tipo' => 'ComprobanteDomicilio',
                'file_path'   => $pathDom,
                'status_verificacion' => 'Pendiente'
            ]);
        }

        // 4. RESPUESTA JSON
        return response()->json([
            'mensaje' => 'Usuario registrado y documentos subidos.',
            'usuario_id' => $user->id,
            'status' => $user->status,
            'documentos_guardados' => 2
        ]);
    }
}