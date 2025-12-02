@extends('layouts.app')

@section('title', 'Editar Cancha')

@section('content')

    @push('styles') 
        @vite(['resources/css/agregar-cancha.css']) 
    @endpush

    <div class="admin-form-container">
        
        <div class="form-header">
            <h2>Editar: {{ $cancha->nombre }}</h2>
        </div>

        <form action="{{ route('admin.canchas.update', $cancha->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="form-group">
                <label class="form-label">Nombre de la Cancha</label>
                <input type="text" name="nombre" class="form-input" 
                       value="{{ old('nombre', $cancha->nombre) }}" required>
            </div>

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                
                <div>
                    <label class="form-label">Deporte</label>
                    <select name="tipo_deporte" class="form-select" required>
                        <option value="Fútbol" {{ $cancha->tipo_deporte == 'Fútbol' ? 'selected' : '' }}>Fútbol</option>
                        <option value="Pádel" {{ $cancha->tipo_deporte == 'Pádel' ? 'selected' : '' }}>Pádel</option>
                        <option value="Tenis" {{ $cancha->tipo_deporte == 'Tenis' ? 'selected' : '' }}>Tenis</option>
                        <option value="Basquetbol" {{ $cancha->tipo_deporte == 'Basquetbol' ? 'selected' : '' }}>Basquetbol</option>
                        <option value="Voleibol" {{ $cancha->tipo_deporte == 'Voleibol' ? 'selected' : '' }}>Voleibol</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Precio por Hora ($)</label>
                    <input type="number" name="precio_por_hora" class="form-input" step="0.50" 
                           value="{{ old('precio_por_hora', $cancha->precio_por_hora) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Estado Actual</label>
                <select name="status" class="form-select" required>
                    <option value="Disponible" {{ $cancha->status == 'Disponible' ? 'selected' : '' }}>🟢 Disponible</option>
                    <option value="En Mantenimiento" {{ $cancha->status == 'En Mantenimiento' ? 'selected' : '' }}>🟠 En Mantenimiento</option>
                    <option value="Desactivada" {{ $cancha->status == 'Desactivada' ? 'selected' : '' }}>🔴 Desactivada</option>
                </select>
                <small style="color: #64748b;">Si pones "En Mantenimiento", no aparecerá en el catálogo público.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Descripción (Opcional)</label>
                <textarea name="descripcion" class="form-textarea" rows="3">{{ old('descripcion', $cancha->descripcion) }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.canchas.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Actualizar Cancha</button>
            </div>

        </form>
    </div>

@endsection