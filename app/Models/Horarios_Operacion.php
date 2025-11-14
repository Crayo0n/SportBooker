<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horarios_Operacion extends Model
{
    use HasFactory;

    protected $table = 'horarios_operacion_tabla'; 

   
    protected $fillable = [
        'id_complejo',   
        'dia_semana',           
        'hora_apertura', 
        'hora_cierre',   
        'status',       // booleano (1 = cerrado, 0 = abierto)
    ];

    /**
     * Relación: Un Horario de Operación pertenece a UN Complejo.
     */
    public function complex(): BelongsTo
    {
        return $this->belongsTo(Complejos::class, 'id_complejo');
    }
}