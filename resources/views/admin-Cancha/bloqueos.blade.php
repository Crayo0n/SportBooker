@extends('layouts.app')

@section('title', 'Bloquear Horario')

@section('content')

    @push('styles')
        @vite(['resources/css/agregar-cancha.css'])
    @endpush

    <div class="admin-form-container">
        
        <div class="form-header">
            <h2 style="color:#b91c1c;">Bloquear Horario (Mantenimiento)</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                Cierra una cancha temporalmente para evitar que los clientes la reserven.
            </p>
        </div>

        @if($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.bloqueos.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">¿Qué cancha vas a cerrar?</label>
                <select name="cancha_id" class="form-select" required>
                    @foreach($canchas as $cancha)
                        <option value="{{ $cancha->id }}">{{ $cancha->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <div>
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha_inicio" class="form-input" min="{{ date('Y-m-d') }}" required>
                </div>
                <div>
                    <label class="form-label">Hora Inicio</label>
                    <input type="time" name="hora_inicio" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Hora Fin</label>
                    <input type="time" name="hora_fin" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Motivo del bloqueo</label>
                <input type="text" name="motivo" class="form-input" placeholder="Ej. Reparación de luces, Lluvia, Evento Privado" required>
            </div>

            <div class="form-actions">
                <a href="{{ url('/mi-dashboard') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save" style="background-color: #b91c1c;">Bloquear Horario</button>
            </div>

        </form>
    </div>

@endsection