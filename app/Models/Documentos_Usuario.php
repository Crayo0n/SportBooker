<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documentos_Usuario extends Model
{
    use HasFactory;

    protected $table = 'documentos_usuarios_tabla';

    protected $fillable = [
        'user_id',          
        'tipo',   
        'file_path',     
    ];

    /**
     * Relación: Un Documento pertenece a UN Usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}