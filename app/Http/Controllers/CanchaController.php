<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Canchas;
use App\Models\Complejos;
use App\Models\Reservacion;

class CanchaController extends Controller
{
    /**
     * Función privada para obtener el complejo del admin logueado.
     * Esto evita repetir código.
     */
    private function getAdminComplex()
    {
        $adminUser = Auth::user();
        return $adminUser->complex; 
    }

    /**
     * READ : Muestra TODAS las canchas del admin logueado.
     */
    public function index()
    {
        $complejo = $this->getAdminComplex();
        if (!$complejo) {
            return response()->json(['error' => 'No tienes un complejo asignado.'], 403);
        }

        $canchas = $complejo->canchas; 

        return response()->json([
            'mensaje' => 'Canchas de ' . $complejo->nombre,
            'total' => $canchas->count(),
            'canchas' => $canchas
        ]);
    }

    /**
     * CREATE: Crea una nueva cancha ASIGNADA a este admin.
     */
    public function store()
    {
        $complejo = $this->getAdminComplex();
        if (!$complejo) {
            return response()->json(['error' => 'No tienes un complejo asignado.'], 403);
        }

        // Datos de prueba (en la vida real vendrían de un formulario)
        $datosPrueba = [
            'id_complejo' => $complejo->id, 
            'nombre' => 'Cancha de Voleibol (Test)',
            'tipo_deporte' => 'Voleibol',
            'precio_por_hora' => 250.00,
            'status' => 'Disponible'
        ];

        $nuevaCancha = Canchas::create($datosPrueba);

        return response()->json([
            'mensaje' => 'Nueva cancha creada con éxito',
            'cancha' => $nuevaCancha
        ], 201);
    }

    /**
     * UPDATE : Edita una cancha específica.
     */
    public function update($id)
    {
        $complejo = $this->getAdminComplex();
        $cancha = Canchas::find($id);

        if (!$cancha) {
            return response()->json(['error' => 'Esa cancha no existe.'], 404);
        }

        // Checamos si la cancha (ej. ID 5) pertenece al complejo del admin logueado
        if ($cancha->id_complejo !== $complejo->id) {
            return response()->json(['error' => 'No tienes permiso para editar esta cancha.'], 403);
        }

        // Datos de prueba para actualizar
        $cancha->nombre = 'Cancha de Voleibol (EDITADA)';
        $cancha->precio_por_hora = 300.00;
        $cancha->save();

        return response()->json([
            'mensaje' => 'Cancha actualizada con éxito',
            'cancha' => $cancha
        ]);
    }

    /**
     * DELETE : Elimina una cancha específica.
     */
    public function destroy($id)
    {
        $complejo = $this->getAdminComplex();
        $cancha = Canchas::find($id);

        if (!$cancha) {
            return response()->json(['error' => 'Esa cancha no existe.'], 404);
        }

        if ($cancha->id_complejo !== $complejo->id) {
            return response()->json(['error' => 'No tienes permiso para borrar esta cancha.'], 403);
        }

        //  No borrar si tiene reservas futuras
        $tieneReservas = Reservacion::where('cancha_id', $id)
                            ->where('hora_inicio', '>', now()) 
                            ->exists();
        
        if ($tieneReservas) {
            return response()->json([
                'error' => 'No puedes borrar esta cancha, tiene reservas futuras activas.'
            ], 400);
        }

        $cancha->delete();

        return response()->json(['mensaje' => 'Cancha eliminada con éxito.']);
    }
}