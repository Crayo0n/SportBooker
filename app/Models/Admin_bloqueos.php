<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin_bloqueos extends Model
{
    use HasFactory;

    protected $table = 'bloqueos_admin_tabla';

    protected $fillable = [
        'cancha_id',          
        'creada_por', 
        'hora_inicio',       
        'hora_fin',          
        'rason',             
    ];


    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];


    public function court(): BelongsTo
    {
        return $this->belongsTo(Canchas::class, 'cancha_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creada_por');
    }
}