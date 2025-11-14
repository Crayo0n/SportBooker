<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservaciones_Equipo extends Model
{
    use HasFactory;

    protected $table = 'reservaciones_equipos_tabla';

    protected $fillable = [
        'user_id',   
        'cancha_id',    
        'dia_semana',   
        'hora_inicio',  
        'hora_fin',     
        'fecha_inicio', 
        'fecha_fin',    
        'reservacion_estatus',       
    ];

    
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Cancha::class, 'cancha_id');
    }
}