<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Importamos las clases para las relaciones
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',      
        'nombre',
        'apellido',    
        'email',
        'password',
        'phone_number', 
        'curp',         
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Relación: Un Usuario pertenece a UN Rol.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación: Un Usuario puede tener MUCHOS documentos.
     * (INE, Comprobante, etc.)
     */
    public function documents(): HasMany
    {
        // Nota: Crearemos el modelo UserDocument más adelante
        return $this->hasMany(UserDocument::class);
    }

    /**
     * Relación: Un Usuario (Admin) gestiona UN Complejo.
     */
    public function complex(): HasOne
    {
        // Nota: Crearemos el modelo Complex más adelante.
        // Especificamos 'admin_user_id' porque así llamamos a la FK en la migración.
        return $this->hasOne(Complex::class, 'admin_user_id');
    }

    /**
     * Relación: Un Usuario (Cliente) tiene MUCHAS Reservas.
     */
    public function reservations(): HasMany
    {
        // Nota: Crearemos el modelo Reservation más adelante
        return $this->hasMany(Reservation::class);
    }

    /**
     * Relación: Un Usuario (Cliente Recurrente) tiene MUCHAS solicitudes de abono.
     */
    public function recurringRequests(): HasMany
    {
        // Nota: Crearemos el modelo RecurringReservationRequest más adelante
        return $this->hasMany(RecurringReservationRequest::class);
    }
}
