<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// --- Rutas de autenticación ---

// Muestra el formulario de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesa el formulario de login (Hardcoded)
Route::post('/login', function (Request $request) {
    if ($request->email === 'admin@example.com' && $request->password === 'password') {
        // En un futuro, aquí iniciarías la sesión del usuario.
        return redirect()->route('home');
    }
    return back()->withErrors('Credenciales incorrectas.');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Ruta para el home
Route::get('/home', function () {
    return view('home.home');
})->name('home');

// Ruta para el inicio
Route::get('/inicio', function () {
    return view('home.home');
})->name('inicio');

// Rutas principales de la aplicación
Route::get('/animales', function (Request $request) {
    $animales = [
        (object)[
            'nombre' => 'Fido',
            'especie' => 'Perro',
            'raza' => 'Labrador',
            'tipo' => 'Doméstico',
            'estado' => 'Bueno',
            'rescatista' => 'Juan Perez',
            'imagen' => 'https://www.purina-latam.com/sites/g/files/auxxlc391/files/styles/social_share_large/public/purina-7-razas-de-perros-pequenos-para-departamento.png?itok=2V3zM5sp'
        ],
        (object)[
            'nombre' => 'Miau',
            'especie' => 'Gato',
            'raza' => 'Siames',
            'tipo' => 'Doméstico',
            'estado' => 'Estable',
            'rescatista' => 'Maria Garcia',
            'imagen' => 'https://www.purina-latam.com/sites/g/files/auxxlc391/files/styles/kraken_generic_max_width_960/public/purina-gatos-siameses-caracteristicas-y-cuidados.png?itok=4p21rZBB'
        ],
        (object)[
            'nombre' => 'Jaguar',
            'especie' => 'Felino',
            'raza' => 'Jaguar',
            'tipo' => 'Silvestre',
            'estado' => 'Malo',
            'rescatista' => 'Lucas',
            'imagen' => 'https://www.nationalgeographic.com.es/medio/2023/05/24/jaguar-en-el-pantanal_005099da_230524125548_800x800.jpg'
        ],
        (object)[
            'nombre' => 'Sada',
            'especie' => 'Audax',
            'raza' => 'Sadda',
            'tipo' => 'Doméstico',
            'estado' => 'Muy bueno',
            'rescatista' => 'Rescatista Temporal',
            'imagen' => 'https://t1.ea.ltmcdn.com/es/posts/1/8/4/nombres_para_perros_pitbull_21481_600_square.jpg'
        ],
    ];

    $nombre = $request->input('nombre');
    $tipo = $request->input('tipo');
    $estado = $request->input('estado');

    $filteredAnimales = collect($animales)->filter(function ($animal) use ($nombre, $tipo, $estado) {
        $nombreMatch = true;
        if ($nombre) {
            $nombreMatch = str_contains(strtolower($animal->nombre), strtolower($nombre));
        }

        $tipoMatch = true;
        if ($tipo && $tipo !== 'Todos') {
            $tipoMatch = $animal->tipo === $tipo;
        }

        $estadoMatch = true;
        if ($estado && $estado !== 'Todos') {
            $estadoMatch = $animal->estado === $estado;
        }

        return $nombreMatch && $tipoMatch && $estadoMatch;
    });

    return view('animales.index', [
        'animales' => $filteredAnimales,
        'nombre' => $nombre,
        'tipo' => $tipo,
        'estado' => $estado,
    ]);
})->name('animales.index');

Route::get('/animales/{nombre}/detalles', function ($nombre) {
    $animales = [
        (object)['nombre' => 'Fido', 'especie' => 'Perro', 'raza' => 'Labrador', 'tipo' => 'Doméstico', 'estado' => 'Bueno', 'rescatista' => 'Juan Perez', 'imagen' => 'https://www.purina-latam.com/sites/g/files/auxxlc391/files/styles/social_share_large/public/purina-7-razas-de-perros-pequenos-para-departamento.png?itok=2V3zM5sp', 'sexo' => 'Macho', 'estado_salud' => 'Bueno', 'fecha_ingreso' => now()->subDays(10), 'alimentacion' => (object)['tipo' => 'Omnivoro', 'cantidad' => '500g', 'frecuencia' => 'Diaria'], 'ubicacion_rescatado' => 'Zona Norte', 'fecha_liberacion' => null],
        (object)['nombre' => 'Miau', 'especie' => 'Gato', 'raza' => 'Siames', 'tipo' => 'Doméstico', 'estado' => 'Estable', 'rescatista' => 'Maria Garcia', 'imagen' => 'https://www.purina-latam.com/sites/g/files/auxxlc391/files/styles/kraken_generic_max_width_960/public/purina-gatos-siameses-caracteristicas-y-cuidados.png?itok=4p21rZBB', 'sexo' => 'Hembra', 'estado_salud' => 'Estable', 'fecha_ingreso' => now()->subDays(5), 'alimentacion' => (object)['tipo' => 'Carnivoro', 'cantidad' => '300g', 'frecuencia' => 'Diaria'], 'ubicacion_rescatado' => 'Zona Sur', 'fecha_liberacion' => null],
        (object)['nombre' => 'Jaguar', 'especie' => 'Felino', 'raza' => 'Jaguar', 'tipo' => 'Silvestre', 'estado' => 'Malo', 'rescatista' => 'Lucas', 'imagen' => 'https://www.nationalgeographic.com.es/medio/2023/05/24/jaguar-en-el-pantanal_005099da_230524125548_800x800.jpg', 'sexo' => 'Macho', 'estado_salud' => 'Malo', 'fecha_ingreso' => now()->subDays(2), 'alimentacion' => (object)['tipo' => 'Carnivoro', 'cantidad' => '2kg', 'frecuencia' => 'Diaria'], 'ubicacion_rescatado' => 'El Carmen, Piraí', 'fecha_liberacion' => 'Pendiente'],
        (object)['nombre' => 'Sada', 'especie' => 'Audax', 'raza' => 'Sadda', 'tipo' => 'Doméstico', 'estado' => 'Muy bueno', 'rescatista' => 'Rescatista Temporal', 'imagen' => 'https://t1.ea.ltmcdn.com/es/posts/1/8/4/nombres_para_perros_pitbull_21481_600_square.jpg', 'sexo' => 'Hembra', 'estado_salud' => 'Muy bueno', 'fecha_ingreso' => now()->subDays(30), 'alimentacion' => (object)['tipo' => 'Omnivoro', 'cantidad' => '600g', 'frecuencia' => 'Diaria'], 'ubicacion_rescatado' => 'Centro', 'fecha_liberacion' => null],
    ];

    $animal = collect($animales)->firstWhere('nombre', $nombre);

    abort_if(!$animal, 404);

    return view('Animales.AnimalDetalles', ['animal' => $animal]);
})->name('animales.show');

Route::get('/adopciones', function () {
    return view('adopciones.index');
})->name('adopciones.index');

Route::get('/reportes', function () {
    return view('Reportes.Reportes');
})->name('reportes.index');

// --- Rutas de Reporte Rápido ---

// Mostrar formulario de reporte rápido
Route::get('/reporte-rapido', function () {
    return view('ReporteRapido.index');
})->name('reporte-rapido');

// Procesar reporte rápido
Route::post('/reporte-rapido', function (Request $request) {
    // Validar datos del formulario
    $request->validate([
        'tipo_emergencia' => 'required|in:incendio,otro',
        'tipo_usuario' => 'required|in:reportante,rescatista',
        'cantidad_animales' => 'required|integer|min:1',
        'tipo_animal' => 'nullable|in:domesticos,silvestres,mixtos',
        'observaciones' => 'nullable|string|max:1000',
        'latitud' => 'required|numeric',
        'longitud' => 'required|numeric',
        'ci' => 'required_if:tipo_usuario,rescatista|nullable|string|max:20'
    ]);

    // Simular guardado del reporte (en un proyecto real, aquí guardarías en la base de datos)
    $reporte = [
        'tipo_emergencia' => $request->tipo_emergencia,
        'tipo_usuario' => $request->tipo_usuario,
        'cantidad_animales' => $request->cantidad_animales,
        'tipo_animal' => $request->tipo_animal,
        'observaciones' => $request->observaciones,
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
        'ci' => $request->ci,
        'fecha_reporte' => now()
    ];

    // Aquí podrías guardar en la base de datos, enviar notificaciones, etc.
    // Por ahora solo mostramos la confirmación
    
    return view('ReporteRapido.confirmacion', compact('reporte'));
})->name('reporte-rapido.store');
