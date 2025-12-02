@extends('layouts.app')

@section('title', 'Nuevo Administrador')

@section('content')

    @push('styles') 
        @vite(['resources/css/agregar-cancha.css']) 
    @endpush

    <div class="admin-form-container">
        
        <div class="form-header">
            <h2>Registrar Nuevo Administrador</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                Crea una cuenta para un encargado y asígnale un complejo deportivo.
            </p>
        </div>

        <form action="{{ route('superadmin.admins.store') }}" method="POST">
            @csrf
            
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Nombre(s)</label>
                    <input type="text" name="nombre" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellido" class="form-input" required>
                </div>
            </div>

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Teléfono</label>
                    <input type="tel" name="telefono" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Contraseña Temporal</label>
                <input type="text" name="password" class="form-input" value="12345678" required>
                <small style="color: #64748b;">Puedes dejar esta por defecto o escribir una nueva.</small>
            </div>

            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 25px 0;">

            <div class="form-group">
                <label class="form-label" style="color: #004f7c;">Asignar a Complejo Deportivo</label>
                <select name="id_complejo" class="form-select" required>
                    <option value="" disabled selected>Selecciona un complejo...</option>
                    @foreach($complejos as $complejo)
                        <option value="{{ $complejo->id }}">
                            {{ $complejo->nombre }}
                        </option>
                    @endforeach
                </select>
                <small style="color: #64748b;">El usuario tendrá control total sobre el inventario y reservas de este lugar.</small>
            </div>

            <div class="form-actions">
                <a href="{{ route('superadmin.admins.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Crear Administrador</button>
            </div>

        </form>
    </div>

@endsection