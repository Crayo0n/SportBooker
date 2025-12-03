@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

    @push('styles')
        @vite(['resources/css/agregar-cancha.css'])
    @endpush

    <div class="admin-form-container" style="margin-top: 60px;">
        
        <div class="form-header">
            <h2>Mi Perfil</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                Actualiza tu información personal y seguridad.
            </p>
        </div>

        @if(session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('perfil.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Correo Electrónico (No editable)</label>
                <input type="text" class="form-input" value="{{ $user->email }}" disabled style="background: #e2e8f0; cursor: not-allowed; color: #64748b;">
            </div>

            @if($user->curp)
            <div class="form-group">
                <label class="form-label">CURP</label>
                <input type="text" class="form-input" value="{{ $user->curp }}" disabled style="background: #e2e8f0; cursor: not-allowed; color: #64748b;">
            </div>
            @endif

            <hr style="border:0; border-top:1px solid #e2e8f0; margin: 25px 0;">

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Nombre(s)</label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $user->nombre) }}" required>
                </div>
                <div>
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellido" class="form-input" value="{{ old('apellido', $user->apellido) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Teléfono Celular</label>
                <input type="tel" name="telefono" class="form-input" value="{{ old('telefono', $user->phone_number) }}" required>
            </div>

            <hr style="border:0; border-top:1px solid #e2e8f0; margin: 25px 0;">

            <h3 style="font-size: 18px; color: #004f7c; margin-bottom: 15px; font-family: 'Blinker', sans-serif;">Seguridad</h3>
            
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-input" placeholder="Dejar vacío para mantener la actual">
                </div>
                <div>
                    <label class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Repite la nueva contraseña">
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ url('/perfil') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar Cambios</button>
            </div>

        </form>
    </div>

@endsection