@extends('layouts.app')
@section('title', 'Nueva Cancha')
@section('content')
    @push('styles') @vite(['resources/css/agregar-cancha.css']) @endpush

    <div class="admin-form-container">
        <div class="form-header">
            <h2>Registrar Nueva Cancha</h2>
        </div>

        <form action="{{ route('admin.canchas.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nombre de la Cancha</label>
                <input type="text" name="nombre" class="form-input" placeholder="Ej. Cancha 1 - Fútbol 7" required>
            </div>

            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Deporte</label>
                    <select name="tipo_deporte" class="form-select" required>
                        <option value="Fútbol">Fútbol</option>
                        <option value="Pádel">Pádel</option>
                        <option value="Tenis">Tenis</option>
                        <option value="Basquetbol">Basquetbol</option>
                        <option value="Voleibol">Voleibol</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Precio por Hora ($)</label>
                    <input type="number" name="precio_por_hora" class="form-input" step="0.50" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Descripción (Opcional)</label>
                <textarea name="descripcion" class="form-textarea" rows="3"></textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.canchas.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar Cancha</button>
            </div>
        </form>
    </div>
@endsection