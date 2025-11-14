<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canchas; 

class CanchaController extends Controller
{
    /**
     * 1. LISTAR CANCHAS 
     * Devuelve la lista de canchas en formato JSON.
     */
    public function index()
    {
        // Trae todas las canchas de la base de datos
        $canchas = Cancha::all(); 

        return response()->json([
            'mensaje' => 'Lista de canchas cargada correctamente',
            'total' => $canchas->count(),
            'datos' => $canchas
        ], 200);
    }

    /**
     * 2. CREAR CANCHA 
     * Recibe datos y crea una nueva cancha.
     */
    public function store(Request $request)
    {
        // A. Validamos los datos 
        $validated = $request->validate([
            'id_complejo' => 'required|integer', 
            'nombre' => 'required|string|max:255',
            'tipo_deporte' => 'required|string',
            'precio_por_hora' => 'required|numeric',
        ]);

        // B. Guardamos en la Base de Datos
        $nuevaCancha = Cancha::create([
            'id_complejo' => $validated['id_complejo'],
            'nombre' => $validated['nombre'],
            'tipo_deporte' => $validated['tipo_deporte'],
            'precio_por_hora' => $validated['precio_por_hora'],
            'status' => 'Disponible' 
        ]);

        // C. Respondemos con éxito
        return response()->json([
            'mensaje' => '¡Cancha creada con éxito!',
            'datos' => $nuevaCancha
        ], 201);
    }
}