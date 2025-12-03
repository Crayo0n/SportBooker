<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Documentos_Usuario; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB; 

class RegistroController extends Controller
{
    public function showOcasional()
    {
        return view('auth.registro-usuario-ocasional');
    }



    public function storeOcasional(Request $request)
    {
        // 1. VALIDACIÓN 
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

        // 4. REDIRECCIONAR CON MENSAJE
        return redirect()->route('login')
            ->with('status', '¡Registro exitoso! Tu cuenta está en revisión. Te notificaremos cuando sea aprobada.');
    }


    /**
     * MOSTRAR FORMULARIO RECURRENTE
     */
    public function showRecurrente()
    {
        return view('auth.registrer-recurrente');
    }

    /**
     * PROCESAR REGISTRO RECURRENTE
     */
    public function storeRecurrente(Request $request)
    {
        // 1. VALIDACIÓN EXTENDIDA
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'apellido'    => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8|confirmed',
            'telefono'    => 'required',
            'curp'        => 'required|string|size:18|unique:users,curp', 
            
            // Documentos específicos del Recurrente
            'archivo_ine'        => 'required|file|max:5120',
            'archivo_dom'        => 'required|file|max:5120',
            'archivo_oficio'     => 'required|file|max:5120',
            'archivo_roster'     => 'required|file|max:5120',
            'archivo_medico'     => 'required|file|max:10240', 
        ]);

        DB::transaction(function () use ($request) {
        
        $rol = \App\Models\Roles::where('nombre', 'ClienteRecurrente')->first();

        // Crear Usuario
        $user = \App\Models\User::create([
            'role_id'  => $rol->id ?? 4,
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone_number' => $request->telefono,
            'curp'     => $request->curp,
            'status'   => 'PendienteVerificacion'
        ]);

        // Guardar Archivos
        $documentos = [
            'archivo_ine'    => 'INE',
            'archivo_dom'    => 'ComprobanteDomicilio',
            'archivo_oficio' => 'OficioPeticion',
            'archivo_roster' => 'RosterLiga',
            'archivo_medico' => 'CertificadoMedico'
        ];

        foreach ($documentos as $inputName => $tipoDoc) {
            if ($request->hasFile($inputName)) {
                $path = $request->file($inputName)->store('documentos', 'local');
                
                Documentos_Usuario::create([
                    'user_id' => $user->id,
                    'tipo' => $tipoDoc, 
                    'file_path' => $path, 
                ]);
            }
        }

    }); 

        return redirect()->route('login')
            ->with('status', '¡Solicitud de equipo enviada! Revisaremos tu documentación detalladamente.');
    }
}