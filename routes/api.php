<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisponibilidadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// === NUESTRA RUTA DE DISPONIBILIDAD ===
Route::get('/disponibilidad/{cancha_id}', [DisponibilidadController::class, 'consultar']);