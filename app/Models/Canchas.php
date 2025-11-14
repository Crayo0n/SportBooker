<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Canchas extends Model
{
    use HasFactory;

    protected $table = 'canchas_tabla'; 

    protected $fillable = [
        'id_complejo',      
        'nombre',           
        'tipo_deporte',     
        'precio_por_hora',  
        'descripcion',
        'imagen_url',       
        'status',           
    ];


    /**
     * Relación: Una Cancha (Court) pertenece a UN Complejo (Complex).
     */
    public function complejo(): BelongsTo
    {
        return $this->belongsTo(Complejos::class, 'id_complejo');
    }

    /**
     * Relación: Una Cancha (Court) tiene MUCHAS Reservas.
     */
    public function reservations(): HasMany
    {
        
        return $this->hasMany(Reservacion::class, 'cancha_id');
    }

    /**
     * Relación: Una Cancha (Court) puede tener MUCHAS Solicitudes de Reserva Recurrente.
     */
    public function recurringRequests(): HasMany
    {
        return $this->hasMany(Reservaciones_Equipo::class, 'cancha_id');
    }

    /**
     * Relación: Una Cancha (Court) puede tener MUCHOS Bloqueos de Administrador.
     */
    public function adminBlocks(): HasMany
    {
        return $this->hasMany(Admin_bloqueos::class, 'cancha_id');
    }
}