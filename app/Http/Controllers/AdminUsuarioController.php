<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complejos; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Roles;

class AdminUsuarioController extends Controller
{
    /**
     * LISTA DE ADMINISTRADORES
     */
    public function index()
    {
        // 1. Buscamos el Rol de Admin de Cancha (ID 2 en tu seeder)
        // O buscamos por nombre para ser seguros
        $rolAdmin = Roles::where('nombre', 'AdminCancha')->first();

        // 2. Traemos todos los usuarios con ese rol
        $admins = User::where('role_id', $rolAdmin->id)
                      ->orderBy('created_at', 'desc')
                      ->get();

        // 3. Métricas para las tarjetas
        $totalAdmins = $admins->count();
        $activos = $admins->where('status', 'Aprobado')->count(); // O 'Activo', según tu BD
        $inactivos = $admins->where('status', '!=', 'Aprobado')->count();

        return view('dashboards.superadmin', compact('admins', 'totalAdmins', 'activos', 'inactivos'));
    }


    /**
     * MOSTRAR FORMULARIO DE CREACIÓN
     */
    public function create()
    {
        // Traemos todos los complejos para que el SuperAdmin elija cuál asignar
        $complejos = Complejos::all();
        
        return view('superadmin.crear-admin-cancha', compact('complejos'));
    }

    /**
     * GUARDAR NUEVO ADMINISTRADOR
     */
    public function store(Request $request)
    {
        // 1. Validación
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'apellido'    => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'telefono'    => 'required',
            'password'    => 'required|min:8',
            'id_complejo' => 'required|exists:complejos_tabla,id', 
        ]);

        // 2. Buscar el Rol de AdminCancha
        $rolAdmin = Roles::where('nombre', 'AdminCancha')->first();

        // 3. Crear el Usuario
        $nuevoAdmin = User::create([
            'role_id'  => $rolAdmin->id ?? 2,
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'phone_number' => $request->telefono,
            'password' => Hash::make($request->password),
            'status'   => 'Aprobado' 
        ]);

        // 4. Asignar el Complejo al nuevo Admin
        // Buscamos el complejo seleccionado y le ponemos el ID del nuevo usuario
        $complejo = Complejos::find($request->id_complejo);
        
       
        $complejo->admin_user_id = $nuevoAdmin->id;
        $complejo->save();

        return redirect('/superadmin/admins')
            ->with('success', 'Administrador creado y asignado al complejo correctamente.');

    }


    /**
     * MOSTRAR FORMULARIO DE EDICIÓN
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $complejos = Complejos::all(); // Para poder cambiarlo de complejo si es necesario

        return view('superadmin.editar-admin-cancha', compact('admin', 'complejos'));
    }

    /**
     * ACTUALIZAR ADMINISTRADOR
     */
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // 1. Validación
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'apellido'    => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $admin->id,
            'telefono'    => 'required',
            'id_complejo' => 'required|exists:complejos_tabla,id',
            'status'      => 'required|string', // Para activar/desactivar acceso
            'password'    => 'nullable|min:8',  // Opcional
        ]);

        // 2. Preparar datos a actualizar
        $data = [
            'nombre'      => $request->nombre,
            'apellido'    => $request->apellido,
            'email'       => $request->email,
            'telefono'    => $request->telefono,
            'id_complejo' => $request->id_complejo,
            'status'      => $request->status,
        ];

        // 3. Solo actualizamos password si escribieron algo
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 4. Ejecutar actualización
        $admin->update($data);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Datos del administrador actualizados correctamente.');
    }

    /**
     * ELIMINAR ADMINISTRADOR
     */
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        
        // Validación de seguridad: No borrarte a ti mismo si eres SuperAdmin
        if ($admin->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $admin->delete();

        return back()->with('success', 'Administrador eliminado correctamente.');
    }
}