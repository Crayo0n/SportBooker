@extends('layouts.app')

@section('title', 'Solicitar Abono')

@section('content')

    @push('styles')
        @vite(['resources/css/agregar-cancha.css'])
    @endpush

    <div class="admin-form-container">
        
        <div class="form-header">
            <h2>Solicitud de Reserva Recurrente</h2>
            <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                Reserva un horario fijo para tu equipo durante una temporada. 
                <br><strong>Nota:</strong> Esta solicitud está sujeta a aprobación del administrador.
            </p>
        </div>

        @if($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('abonos.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" style="color:#004f7c;">1. ¿Qué cancha necesitas?</label>
                <select name="cancha_id" class="form-select" required>
                    <option value="" disabled selected>Selecciona una cancha...</option>
                    @foreach($canchas as $cancha)
                        <option value="{{ $cancha->id }}">
                            {{ $cancha->nombre }} ({{ $cancha->tipo_deporte }}) - ${{ $cancha->precio_por_hora }}/hr
                        </option>
                    @endforeach
                </select>
            </div>

            <hr style="border:0; border-top:1px solid #e2e8f0; margin: 25px 0;">

            <div class="form-group">
                <label class="form-label" style="color:#004f7c;">2. ¿Qué día y horario?</label>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                    <div>
                        <label class="form-label" style="font-size:13px;">Día de la semana</label>
                        <select name="dia_semana" class="form-select" required>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miércoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sábado</option>
                            <option value="0">Domingo</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" style="font-size:13px;">Hora Inicio</label>
                        <input type="time" name="hora_inicio" class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label" style="font-size:13px;">Hora Fin</label>
                        <input type="time" name="hora_fin" class="form-input" required>
                    </div>
                </div>
            </div>

            <hr style="border:0; border-top:1px solid #e2e8f0; margin: 25px 0;">

            <div class="form-group">
                <label class="form-label" style="color:#004f7c;">3. ¿Cuánto dura la temporada?</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label class="form-label" style="font-size:13px;">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-input" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label class="form-label" style="font-size:13px;">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-input" min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <small style="color: #64748b; display:block; margin-top:5px;">
                    El sistema generará una reserva automática para cada semana dentro de este rango.
                </small>
            </div>

            <div class="form-actions">
                <a href="{{ url('/mi-dashboard') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Enviar Solicitud</button>
            </div>

        </form>
    </div>

@endsection