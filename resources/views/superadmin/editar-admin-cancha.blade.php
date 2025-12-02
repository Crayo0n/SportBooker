@extends('layouts.app')

@section('title', 'Editar Administrador')

@section('content')

    @push('styles') 
        @vite(['resources/css/agregar-cancha.css']) 
    @endpush

    <div class="admin-form-container">
        
        <div class="form-header">
            <h2>Editar Administrador: {{ $admin->nombre }}</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                Modifica los datos de acceso, asignación de complejo o estado de la cuenta.
            </p>
        </div>

        <form action="{{ route('superadmin.admins.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Nombre(s)</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $admin->nombre) }}" required>
                </div>
                <div>
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellido" class="form-input" value="{{ old('apellido', $admin->apellido) }}" required>
                </div>
            </div>

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $admin->email) }}" required>
                </div>
                <div>
                    <label class="form-label">Teléfono</label>
                    <input type="tel" name="telefono" class="form-input" value="{{ old('telefono', $admin->telefono) }}" required>
                </div>
            </div>

            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 25px 0;">

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label" style="color: #004f7c;">Complejo Asignado</label>
                    <select name="id_complejo" class="form-select" required>
                        @foreach($complejos as $complejo)
                            <option value="{{ $complejo->id }}" 
                                {{ $admin->id_complejo == $complejo->id ? 'selected' : '' }}>
                                {{ $complejo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Estado de la Cuenta</label>
                    <select name="status" class="form-select" required>
                        <option value="Aprobado" {{ $admin->status == 'Aprobado' ? 'selected' : '' }}>🟢 Activo (Aprobado)</option>
                        <option value="Suspendido" {{ $admin->status == 'Suspendido' ? 'selected' : '' }}>🟠 Suspendido</option>
                        <option value="Inactivo" {{ $admin->status == 'Inactivo' ? 'selected' : '' }}>🔴 Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Nueva Contraseña (Opcional)</label>
                <input type="text" name="password" class="form-input" placeholder="Dejar en blanco para no cambiar">
                <small style="color: #64748b;">Solo llena esto si deseas cambiar la contraseña actual del administrador.</small>
            </div>

            <div class="form-actions">
                <a href="{{ route('superadmin.admins.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Actualizar Datos</button>
            </div>

        </form>
    </div>

@endsection