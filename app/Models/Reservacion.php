<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservacion extends Model
{
    use HasFactory;

    protected $table = 'reservaciones_tabla';

    protected $fillable = [
        'user_id',       
        'cancha_id',        
        'hora_inicio',     
        'hora_fin',        
        'precio_total',     
        'metodo_pago',      
        'pago_estatus',     
        'reservacion_estatus',  
    ];

    protected $casts = [
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];


    /**
     * Relación: Una Reserva pertenece a UN Usuario (Cliente).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Una Reserva pertenece a UNA Cancha.
     */
    public function cancha(): BelongsTo
    {
        return $this->belongsTo(Canchas::class, 'cancha_id');
    }
}