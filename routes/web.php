<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Complejos; 
use App\Models\Canchas;   

Route::get('/prueba-crear-cancha', function () {
    
    // PASO A: Asegurarnos de que existe al menos un Complejo (para asignarle la cancha)
    // Buscamos el primero que exista.
    $complejo = Complejos::first();

    // Si no existe ninguno, creamos uno de prueba automáticamente
    if (!$complejo) {
        $complejo = Complejos::create([
            // Si tu tabla de usuarios está vacía, esto podría fallar por el 'admin_user_id'.
            // Para esta prueba rápida, asumimos que el campo 'admin_user_id' es nullable 
            // o creamos un complejo sin admin por ahora.
            'admin_user_id' => null, 
            'nombre' => 'Complejo Deportivo Test',
            'direccion' => 'Calle Falsa 123',
            'numero_contacto' => '555-555-555',
            'city' => 'Querétaro', 
            'state' => 'Qro',
            'zip_code' => '76000',
            'status' => 'Activo'
        ]);
    }

    // PASO B: Crear la Cancha usando el modelo
    // Aquí simulamos lo que haría el Controller
    $nuevaCancha = Canchas::create([
        'id_complejo' => $complejo->id, // Usamos el ID del complejo que encontramos/creamos
        'nombre' => 'Cancha Rápida #' . rand(1, 100), // Nombre aleatorio
        'tipo_deporte' => 'Fútbol 7',
        'precio_por_hora' => 450.00,
        'status' => 'Disponible'
    ]);

    // PASO C: Mostrar el resultado en pantalla
    return [
        'mensaje' => '¡ÉXITO! Backend funcionando.',
        'se_creo_en_complejo' => $complejo->nombre,
        'datos_cancha_nueva' => $nuevaCancha
    ];
});


use App\Http\Controllers\ReservacionController;

Route::get('/prueba-reservar', [ReservacionController::class, 'store']);


Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/registro', function () {
    return view('auth.register-choice'); // Apunta a una nueva vista
})->name('register.choice');

use App\Http\Controllers\RegistroController;
use Illuminate\Http\Request;

// 1. Ruta para VER el formulario feo de prueba
Route::get('/prueba-subir-archivos', function () {
    return '
        <h1>Prueba Backend: Registro con Archivos</h1>
        <form action="/prueba-subir-archivos" method="POST" enctype="multipart/form-data">
            ' . csrf_field() . ' <label>Nombre:</label> <input type="text" name="nombre" value="TestUser"><br><br>
            <label>Apellido:</label> <input type="text" name="apellido" value="Files"><br><br>
            <label>Email:</label> <input type="email" name="email" value="test'.rand(1,999).'@archivo.com"><br><br>
            <label>Pass:</label> <input type="text" name="password" value="12345678"><br><br>
            <label>Tel:</label> <input type="text" name="telefono" value="555555"><br><br>
            
            <h3>Documentos:</h3>
            <label>INE:</label> <input type="file" name="archivo_ine"><br><br>
            <label>Comprobante:</label> <input type="file" name="archivo_dom"><br><br>
            
            <button type="submit">PROBAR REGISTRO</button>
        </form>
    ';
});

// 2. Ruta que recibe los datos (conecta con tu Controller)
Route::post('/prueba-subir-archivos', [RegistroController::class, 'storeOcasional']);



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

Route::get('/prueba-crear-admin', function () {
    
    // 1. Buscar o Crear el Usuario Admin
    $emailAdmin = 'admin@complejo.com';
    $admin = User::where('email', $emailAdmin)->first();

    if (!$admin) {
        // Buscamos el rol de AdminCancha (que en tu seeder era el ID 2)
        $rolAdmin = Roles::where('nombre', 'AdminCancha')->first();

        $admin = User::create([
            'role_id'  => $rolAdmin->id ?? 2,
            'nombre'   => 'Gerente',
            'apellido' => 'General',
            'email'    => $emailAdmin,
            'password' => Hash::make('12345678'),
            'phone_number' => '999999',
            'status'   => 'Aprobado' 
        ]);
    }

    // 2. Buscar el Complejo Test (ID 1)
    $complejo = Complejos::first();

    // 3. ASIGNAR EL COMPLEJO AL ADMIN
    // Actualizamos la FK en la tabla de complejos
    $complejo->admin_user_id = $admin->id;
    $complejo->save();

    return [
        'mensaje' => '¡Configuración lista!',
        'admin_creado' => $admin->email,
        'complejo_asignado' => $complejo->nombre
    ];
});



use App\Http\Controllers\CanchaController;

// --- GRUPO DE RUTAS PARA EL ADMIN DE CANCHA (CRUD) ---
// Todo este grupo solo funciona si estás logueado como Admin
Route::middleware('auth')->group(function () {

    // 1. Ver mi inventario (READ)
    Route::get('/admin/canchas', [CanchaController::class, 'index'])->name('admin.canchas.index');

    // 2. Crear una cancha (CREATE)
    Route::get('/admin/canchas/crear', [CanchaController::class, 'store'])->name('admin.canchas.create');

    // 3. Editar una cancha (UPDATE)
    // (Cambia el '2' por el ID de la cancha que quieras editar)
    Route::get('/admin/canchas/editar/{id}', [CanchaController::class, 'update'])->name('admin.canchas.edit');

    // 4. Borrar una cancha (DELETE)
    // (Cambia el '2' por el ID de la cancha que quieras borrar)
    Route::get('/admin/canchas/borrar/{id}', [CanchaController::class, 'destroy'])->name('admin.canchas.destroy');

});


use App\Http\Controllers\BloqueoController;

Route::middleware('auth')->group(function () {
    // ... (Tus rutas del CRUD de Canchas están aquí) ...

    // Ruta para probar el bloqueo
    Route::get('/admin/bloquear-cancha', [BloqueoController::class, 'store']);
});


use App\Http\Controllers\SolicitudAbonoController;

// Ruta para que el Cliente Recurrente pida el abono
Route::get('/cliente/solicitar-abono', [SolicitudAbonoController::class, 'store']);

use App\Http\Controllers\AdminAbonoController;

// 1. (Admin) Ver la lista de solicitudes pendientes
Route::get('/admin/abonos/pendientes', [AdminAbonoController::class, 'index']);

// 2. (Admin) Aprobar una solicitud específica
Route::get('/admin/abonos/aprobar/{id}', [AdminAbonoController::class, 'approve']);



require __DIR__.'/auth.php';
