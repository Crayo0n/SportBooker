<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Complejos; 
use App\Models\Canchas;   


use App\Http\Controllers\ReservacionController;
Route::middleware('auth')->get('/reservar/{id}', [ReservacionController::class, 'create'])->name('reservas.create');
Route::post('/reservar', [ReservacionController::class, 'store'])->name('reservas.store');

// Ruta para cancelar una reserva específica
Route::post('/reservas/cancelar/{id}', [ReservacionController::class, 'cancel'])
    ->name('reservas.cancel'); 


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/registro', function () {
    return view('auth.registrarse'); // Apunta a una nueva vista
})->name('registrarse');



use App\Http\Controllers\RegistroController;

// 1. Mostrar el formulario (GET)
Route::get('/registro/Usuario_ocasional', [RegistroController::class, 'showOcasional'])
    ->name('register.ocasional');

// 2. Procesar el formulario (POST) - Reutilizamos tu lógica de backend
Route::post('/registro/Usuario_ocasional', [RegistroController::class, 'storeOcasional'])
    ->name('register.ocasional.store');

// 2. Cliente Equipo
Route::get('/registro/recurrente', [RegistroController::class, 'showRecurrente'])
    ->name('register.recurrente');

Route::post('/registro/recurrente', [RegistroController::class, 'storeRecurrente'])
    ->name('register.recurrente.store');
   


use App\Http\Controllers\AdminVerificacionController;

// 1. Ver la lista de pendientes
Route::get('/admin/pendientes', [AdminVerificacionController::class, 'index']);

// 2. Aprobar al usuario ID 2 (el que acabas de crear)
// En la vida real esto sería un botón, aquí lo simulamos con una ruta GET
Route::get('/admin/aprobar/{id}', [AdminVerificacionController::class, 'aprobar']);


use App\Http\Controllers\DashboardController;

// Usamos el middleware 'auth' para asegurar que solo usuarios logueados entren aquí
Route::get('/mi-dashboard', [DashboardController::class, 'index'])->middleware('auth');




use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;





use App\Http\Controllers\CanchaController;
use App\Http\Controllers\AdminAbonoController;


// Ruta Pública del Catálogo
Route::get('/canchas', [CanchaController::class, 'catalogo'])->name('canchas.catalogo');

// Ruta para la vista de detalle
Route::get('/canchas/detalle', [CanchaController::class, 'detalle'])->name('cancha.detalle');

// Todo este grupo solo funciona si estás logueado como Admin
// --- GRUPO DE RUTAS PARA EL ADMIN DE CANCHA ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // 1. LISTAR (Index)
    Route::get('/canchas', [CanchaController::class, 'index'])->name('canchas.index');

    // 2. CREAR (Formulario y Guardado)
    Route::get('/canchas/crear', [CanchaController::class, 'create'])->name('canchas.create');
    Route::post('/canchas', [CanchaController::class, 'store'])->name('canchas.store');

    // 3. EDITAR (Formulario y Actualización)
    Route::get('/canchas/{id}/editar', [CanchaController::class, 'edit'])->name('canchas.edit');
    Route::put('/canchas/{id}', [CanchaController::class, 'update'])->name('canchas.update');

    // 4. BORRAR
    Route::delete('/canchas/{id}', [CanchaController::class, 'destroy'])->name('canchas.destroy');

    // Rutas de Abonos
    Route::get('/admin/abonos/pendientes', [AdminAbonoController::class, 'index'])->name('admin.abonos.index');
    Route::get('/admin/abonos/aprobar/{id}', [AdminAbonoController::class, 'approve'])->name('abonos.approve');
    Route::get('/admin/abonos/rechazar/{id}', [AdminAbonoController::class, 'reject'])->name('abonos.reject');
});


use App\Http\Controllers\BloqueoController;

Route::middleware('auth')->group(function () {

// Bloqueos de Mantenimiento
    Route::get('/admin/bloqueos/crear', [BloqueoController::class, 'create'])->name('admin.bloqueos.create');
    Route::post('/admin/bloqueos', [BloqueoController::class, 'store'])->name('admin.bloqueos.store');
});


use App\Http\Controllers\SolicitudAbonoController;

// Ruta para que el Cliente Recurrente pida el abono
Route::get('/solicitar-abono', [SolicitudAbonoController::class, 'create'])->name('abonos.create');
Route::post('/solicitar-abono', [SolicitudAbonoController::class, 'store'])->name('abonos.store');


// 1. (Admin) Ver la lista de solicitudes pendientes
Route::get('/admin/abonos/pendientes', [AdminAbonoController::class, 'index']);

// 2. (Admin) Aprobar una solicitud específica
Route::get('/admin/abonos/aprobar/{id}', [AdminAbonoController::class, 'approve']);


use App\Http\Controllers\AdminUsuarioController;

// Grupo SuperAdmin
Route::prefix('superadmin')->name('superadmin.')->group(function () {
    
    // Gestión de Admins
    Route::get('/admins', [AdminUsuarioController::class, 'index'])->name('admins.index');
    Route::delete('/admins/{id}', [AdminUsuarioController::class, 'destroy'])->name('admins.destroy');

    // Crear Admin de Cancha
    Route::get('/admins/crear', [AdminUsuarioController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminUsuarioController::class, 'store'])->name('admins.store');

    // Editar Admin de Cancha
    Route::get('/admins/{id}/editar', [AdminUsuarioController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{id}', [AdminUsuarioController::class, 'update'])->name('admins.update');

    // VERIFICACIÓN DE USUARIOS
    Route::get('/verificacion', [App\Http\Controllers\AdminVerificacionController::class, 'index'])
        ->name('verificacion.index');
        
    Route::get('/verificacion/aprobar/{id}', [App\Http\Controllers\AdminVerificacionController::class, 'aprobar'])
        ->name('verificacion.aprobar');
        
    Route::get('/verificacion/rechazar/{id}', [App\Http\Controllers\AdminVerificacionController::class, 'rechazar'])
        ->name('verificacion.rechazar');

    // Ver documento seguro
    Route::get('/documentos/{id}', [App\Http\Controllers\AdminVerificacionController::class, 'descargarDocumento'])->name('documentos.descargar');

});

use App\Http\Controllers\PerfilController;

// Rutas de Perfil
Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil');
Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');


require __DIR__.'/auth.php';
