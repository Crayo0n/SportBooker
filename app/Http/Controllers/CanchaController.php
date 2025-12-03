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
            return view('dashboard.admin-empty');
        }

        $canchas = $complejo->canchas; 

        return view('admin-Cancha.index', compact('canchas', 'complejo'));
    }


    public function create()
    {
        return view('admin-Cancha.crear-cancha');
    }

    /**
     * CREATE: Crea una nueva cancha ASIGNADA a este admin.
     */
    public function store(Request $request)
    {
        $complejo = $this->getAdminComplex();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_deporte' => 'required|string',
            'precio_por_hora' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        Canchas::create([
            'id_complejo' => $complejo->id,
            'nombre' => $request->nombre,
            'tipo_deporte' => $request->tipo_deporte,
            'precio_por_hora' => $request->precio_por_hora,
            'descripcion' => $request->descripcion,
            'status' => 'Disponible'
        ]);

        return redirect()->route('admin.canchas.index')->with('success', 'Cancha creada exitosamente.');
    }

    /**
     * UPDATE : Edita una cancha específica.
     */
    public function edit($id)
    {
        $complejo = $this->getAdminComplex();
        $cancha = Canchas::findOrFail($id);

        // Seguridad: Verificar propiedad
        if ($cancha->id_complejo !== $complejo->id) {
            abort(403, 'No tienes permiso para editar esta cancha.');
        }

        return view('admin-Cancha.editar-cancha', compact('cancha'));
    }


    /**
     * 5. ACTUALIZAR CANCHA
     */
    public function update(Request $request, $id)
    {
        $cancha = Canchas::findOrFail($id);
        $complejo = $this->getAdminComplex();

        if ($cancha->id_complejo !== $complejo->id) { abort(403); }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_deporte' => 'required|string',
            'precio_por_hora' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $cancha->update($request->only(['nombre', 'tipo_deporte', 'precio_por_hora', 'descripcion', 'status']));

        return redirect()->route('admin.canchas.index')->with('success', 'Cancha actualizada.');
    }

    /**
     * DELETE : Elimina una cancha específica.
     */
    public function destroy($id)
    {
        $cancha = Cancha::findOrFail($id);
        $complejo = $this->getAdminComplex();

        if ($cancha->id_complejo !== $complejo->id) { abort(403); }

        // Regla: No borrar si hay reservas futuras
        $tieneReservas = Reservacion::where('cancha_id', $id)
                            ->where('hora_inicio', '>', now())
                            ->where('reservacion_estatus', '!=', 'Cancelada')
                            ->exists();
        
        if ($tieneReservas) {
            return back()->with('error', 'No puedes eliminar esta cancha porque tiene reservas futuras activas.');
        }

        $cancha->delete();

        return redirect()->route('admin.canchas.index')->with('success', 'Cancha eliminada.');
    }


    public function catalogo()
    {
        // 1. Traemos todas las canchas que estén "Disponibles"
        $canchas = Canchas::where('status', 'Disponible')->with('complejo')->get();

        // 2. Retornamos la vista (que crearemos en el siguiente paso)
        return view('cancha-detalle', compact('canchas'));
    }

    public function detalle()
    {
        // Traemos las canchas activas
        $canchas = Canchas::where('status', 'Disponible')->get();

        // Retornamos la vista pasando los datos
        return view('cancha-detalle', compact('canchas'));
    }

}