<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Importamos las clases para las relaciones
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cancha;

class Complejos extends Model
{
    use HasFactory;

    protected $table = 'complejos_tabla';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_user_id', 
        'nombre',        
        'direccion',     
        'numero_contacto',      
        'imagen_url',    
        'descripcion', 
        'status',
    ];


    /**
     * Relación: Un Complejo pertenece a UN Usuario (Admin).
     */
    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    /**
     * Relación: Un Complejo tiene MUCHAS Canchas .
     */
    public function canchas(): HasMany
    {
        return $this->hasMany(Canchas::class, 'id_complejo'); 
    }

    /**
     * Relación: Un Complejo  tiene MUCHOS Horarios de Operación.
     */
    public function operatingHours(): HasMany
    {
        return $this->hasMany(Horarios_Operacion::class, 'id_complejo'); 
    }
}