<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-roles', function () {

    // 1. Iremos a la base de datos y pediremos todos los datos de la tabla 'roles'.
    $roles = DB::table('roles_tabla')->get();

    // 2. Devolveremos lo que encontramos.
    // Laravel es lo suficientemente inteligente para convertir esto en JSON.
    return $roles;

});


require __DIR__.'/auth.php';
Route::get('/cancha-detalle', function () {
    return view('cancha-detalle');
})->name('cancha.detalle');
