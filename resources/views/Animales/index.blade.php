@extends('layouts.admin')

@section('title', 'Gestión de Animales - Rescate Animales')

@php
    // --- DATOS HARDCODEADOS DIRECTAMENTE EN LA VISTA ---
    $animales = collect([
        (object)[
            'id' => 1,
            'nombre' => 'Sada',
            'especie' => 'Canino',
            'raza' => 'Labrador',
            'sexo' => 'Macho',
            'estado_salud' => 'Malo',
            'fecha_ingreso' => now()->parse('2025-09-01'),
            'tipo' => 'Animal Doméstico',
            'imagen' => asset('Fotos/OIP.jpg'),
            'rescatista' => 'Rescatista Temporal',
            'direccion' => 'Calle Paitití, Centro, Santa Cruz De La Sierra, Provincia Andrés Ibáñez, Santa Cruz, Bolivia',
            'alimentacion_tipo' => 'Carnívoro',
            'alimentacion_cantidad' => 'diaria',
        ],
        (object)[
            'id' => 2,
            'nombre' => 'Jaguar',
            'especie' => 'Felino',
            'raza' => 'Jaguar',
            'sexo' => 'Macho',
            'estado_salud' => 'Muy Bueno',
            'fecha_ingreso' => now()->subDays(5),
            'tipo' => 'Animal Silvestre',
            'imagen' => asset('Fotos/R.jpg'),
            'rescatista' => 'Lucas',
            'direccion' => 'Parque Nacional Amboró, Buena Vista, Santa Cruz',
            'alimentacion_tipo' => 'Carnívoro',
            'alimentacion_cantidad' => '2kg',
        ],
    ]);

    // Simulación de variables de filtro
    $nombre = request('nombre');
    $tipo = request('tipo', 'Todos');
    $estado = request('estado', 'Todos');

    $rescatistas = collect([
        (object)['id' => 1, 'nombre' => 'Lucas', 'telefono' => '45325324'],
        (object)['id' => 2, 'nombre' => 'Maria Garcia', 'telefono' => '123123'],
        (object)['id' => 3, 'nombre' => 'Rescatista Temporal', 'telefono' => '00000000'],
    ]);
@endphp

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-paw text-primary mr-2"></i>
                    Gestión de Animales
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Animales</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <!-- Search and Filter Card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-search mr-2"></i>
                    Búsqueda y Filtros
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#seleccionarRescatistaModal">
                        <i class="fas fa-plus mr-1"></i> Agregar Animal
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Buscar por nombre</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                    </div>
                                    <input type="text" 
                                           name="nombre" 
                                           id="nombre"
                                           class="form-control" 
                                           placeholder="Nombre del animal..." 
                                           value="{{ $nombre ?? '' }}">
                    </div>
                            </div>
                    </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Animal</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="tipo" value="Todos" id="tipo_todos" {{ $tipo === 'Todos' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="tipo_todos">Todos</label>
                                    
                                    <input type="radio" class="btn-check" name="tipo" value="Doméstico" id="tipo_domestico" {{ $tipo === 'Doméstico' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success" for="tipo_domestico">Doméstico</label>
                                    
                                    <input type="radio" class="btn-check" name="tipo" value="Silvestre" id="tipo_silvestre" {{ $tipo === 'Silvestre' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning" for="tipo_silvestre">Silvestre</label>
            </div>
        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado de Salud</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="estado" value="Todos" id="estado_todos" {{ $estado === 'Todos' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-secondary" for="estado_todos">Todos</label>
                                    
                                    <input type="radio" class="btn-check" name="estado" value="Muy Bueno" id="estado_muy_bueno" {{ $estado === 'Muy Bueno' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success" for="estado_muy_bueno">Excelente</label>
                                    
                                    <input type="radio" class="btn-check" name="estado" value="Bueno" id="estado_bueno" {{ $estado === 'Bueno' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-info" for="estado_bueno">Bueno</label>
                                    
                                    <input type="radio" class="btn-check" name="estado" value="Estable" id="estado_estable" {{ $estado === 'Estable' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-warning" for="estado_estable">Estable</label>
    </div>
</div>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search mr-1"></i> Buscar
                            </button>
                            <a href="{{ request()->url() }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Limpiar
                            </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

        <!-- Animals List -->
    <div class="row">
        @forelse ($animales as $animal)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $animal->imagen }}" class="card-img-top" alt="Foto de {{ $animal->nombre }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $animal->nombre }}</h5>
                        <p class="card-text mb-1"><strong>Especie:</strong> {{ $animal->especie }}</p>
                        <p class="card-text mb-1"><strong>Tipo:</strong> {{ $animal->tipo }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pb-3">
                        <button type="button" class="btn btn-primary btn-sm w-100 view-details-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#animalDetailsModal"
                                data-id="{{ $animal->id }}"
                                data-nombre="{{ $animal->nombre }}"
                                data-especie="{{ $animal->especie }}"
                                data-raza="{{ $animal->raza }}"
                                data-sexo="{{ $animal->sexo }}"
                                data-estado_salud="{{ $animal->estado_salud }}"
                                data-fecha_ingreso="{{ $animal->fecha_ingreso->format('d/m/Y') }}"
                                data-tipo="{{ $animal->tipo }}"
                                data-imagen="{{ $animal->imagen }}"
                                data-rescatista="{{ $animal->rescatista }}"
                                data-direccion="{{ $animal->direccion }}"
                                data-alimentacion_tipo="{{ $animal->alimentacion_tipo }}"
                                data-alimentacion_cantidad="{{ $animal->alimentacion_cantidad }}">
                            <i class="fas fa-eye me-1"></i> Ver Detalles
                        </button>
                    </div>
                </div>
            </div>
        @empty
                <div class="col">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay animales para mostrar.</h4>
                        <p class="text-muted">Comienza agregando tu primer animal al sistema.</p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#seleccionarRescatistaModal">
                            <i class="fas fa-plus mr-1"></i> Agregar Primer Animal
                        </button>
                    </div>
                </div>
        @endforelse
        </div>
    </div>
</section>

<!-- Modal Seleccionar Rescatista -->
<div class="modal fade" id="seleccionarRescatistaModal" tabindex="-1" role="dialog" aria-labelledby="seleccionarRescatistaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="seleccionarRescatistaModalLabel">
                    <i class="fas fa-user-plus mr-2"></i>Seleccionar Rescatista
                </h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Buscar por nombre o teléfono...">
                </div>
                <button class="btn btn-success btn-sm mb-3">
                    <i class="fas fa-plus mr-1"></i> Agregar Nuevo Rescatista
                </button>
                <div class="list-group">
                    @foreach ($rescatistas as $rescatista)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $rescatista->nombre }}</h6>
                                <small class="text-muted">{{ $rescatista->telefono }}</small>
                            </div>
                            <button class="btn btn-success btn-sm btn-seleccionar-rescatista"
                                    data-rescatista-id="{{ $rescatista->id }}"
                                    data-rescatista-nombre="{{ $rescatista->nombre }}">
                                <i class="fas fa-check mr-1"></i>Seleccionar
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Animal -->
<div class="modal fade" id="agregarAnimalModal" tabindex="-1" role="dialog" aria-labelledby="agregarAnimalModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="agregarAnimalModalLabel">
                    <i class="fas fa-plus mr-2"></i>Agregar Nuevo Animal
                </h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Rescatista:</strong> <span id="rescuerNameBadge">...</span>
                        </div>
                    </div>
                </div>
                
                <form id="animalForm">
                    <div class="row">
                        <!-- Información Básica -->
                        <div class="col-lg-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-info-circle mr-2"></i>Información Básica
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre_animal">Nombre del Animal *</label>
                                        <input type="text" class="form-control" id="nombre_animal" name="nombre" placeholder="ej. Pequeño Jaguar" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_animal">Tipo de Animal *</label>
                                        <select class="form-control" id="tipo_animal" name="tipo" required>
                                            <option value="">Selecciona una opción</option>
                                            <option value="Doméstico">Animal Doméstico</option>
                                            <option value="Silvestre">Animal Silvestre</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="especie_animal">Especie *</label>
                                        <select class="form-control" id="especie_animal" name="especie" required>
                                            <option value="">Selecciona una opción</option>
                                            <option value="Canino">Canino</option>
                                            <option value="Felino">Felino</option>
                                            <option value="Ave">Ave</option>
                                            <option value="Reptil">Reptil</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="raza_animal">Raza *</label>
                                        <input type="text" class="form-control" id="raza_animal" name="raza" placeholder="ej. Labrador" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sexo_animal">Sexo *</label>
                                        <select class="form-control" id="sexo_animal" name="sexo" required>
                                            <option value="">Selecciona una opción</option>
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información del Rescate -->
                        <div class="col-lg-6">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Información del Rescate
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="fecha_rescate">Fecha de Rescate *</label>
                                        <input type="date" class="form-control" id="fecha_rescate" name="fecha_rescate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacion_rescate">Ubicación del Rescate *</label>
                                        <textarea class="form-control" id="ubicacion_rescate" name="ubicacion_rescate" rows="3" placeholder="Dirección completa del rescate" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Ubicación en el mapa</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map"></i>
                                                </span>
                                            </div>
                                            <button type="button" class="btn btn-success">
                                                <i class="fas fa-location-arrow mr-2"></i>Mi ubicación
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Salud y Cuidados -->
                        <div class="col-lg-6">
                            <div class="card card-warning card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-heartbeat mr-2"></i>Salud y Cuidados
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="estado_salud">Estado de Salud *</label>
                                        <select class="form-control" id="estado_salud" name="estado_salud" required>
                                            <option value="">Selecciona una opción</option>
                                            <option value="Muy Bueno">Muy Bueno</option>
                                            <option value="Bueno">Bueno</option>
                                            <option value="Estable">Estable</option>
                                            <option value="Malo">Malo</option>
                                            <option value="Muy Malo">Muy Malo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_alimentacion">Tipo de Alimentación *</label>
                                        <select class="form-control" id="tipo_alimentacion" name="tipo_alimentacion" required>
                                            <option value="">Selecciona una opción</option>
                                            <option value="Carnívoro">Carnívoro</option>
                                            <option value="Herbívoro">Herbívoro</option>
                                            <option value="Omnívoro">Omnívoro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multimedia -->
                        <div class="col-lg-6">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-image mr-2"></i>Multimedia
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Foto del Animal (Opcional)</label>
                                        <div class="image-upload-box text-center p-4 border-2 border-dashed rounded" style="border-color: #dee2e6;">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-2">Click para subir o arrastra una imagen</p>
                                            <small class="text-muted">PNG, JPG, JPEG (Máx. 5MB)</small>
                                            <input type="file" class="d-none" id="imagen_animal" name="imagen" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-success" id="guardarAnimal">
                    <i class="fas fa-save mr-1"></i>Guardar Animal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detalles del Animal -->
<div class="modal fade" id="animalDetailsModal" tabindex="-1" role="dialog" aria-labelledby="animalDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content" style="border-radius: 1.5rem; background-color: #f8f9fa;">
            <div class="modal-header bg-white border-0 px-4 pt-4 pb-3">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div>
                        <h4 class="modal-title" id="modalAnimalNombre"><b>...</b></h4>
                        <div class="mt-1 d-flex align-items-center gap-2">
                            <span class="badge" id="modalAnimalTipoBadge">...</span>
                            <span class="text-muted">•</span>
                            <span class="text-muted" id="modalAnimalEspecieText">...</span>
                            <span class="text-muted">•</span>
                            <span class="badge" id="modalAnimalEstadoBadge">...</span>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" id="changeStatusBtn" data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="fas fa-check-circle me-1"></i> Cambiar Estado de Salud
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="card-header bg-white p-0 pt-1 mb-4 rounded-top">
                    <ul class="nav nav-tabs" id="animal-details-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="info-tab" data-toggle="tab" href="#info-content" role="tab">Información General</a></li>
                        <li class="nav-item"><a class="nav-link" id="location-tab" data-toggle="tab" href="#location-content" role="tab">Ubicación</a></li>
                        <li class="nav-item"><a class="nav-link" id="actions-tab" data-toggle="tab" href="#actions-content" role="tab">Acciones</a></li>
                    </ul>
                </div>
                <div class="tab-content" id="animal-tabs-content">
                    <div class="tab-pane fade show active" id="info-content" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6"><div class="card h-100 card-custom card-info-bg"><div class="card-body">
                                <h5 class="card-title mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Información Básica</h5>
                                <dl class="row"><dt class="col-sm-5 text-muted">Especie:</dt><dd class="col-sm-7 fw-bold" id="modalAnimalEspecie">...</dd><dt class="col-sm-5 text-muted">Raza:</dt><dd class="col-sm-7 fw-bold" id="modalAnimalRaza">...</dd><dt class="col-sm-5 text-muted">Sexo:</dt><dd class="col-sm-7 fw-bold" id="modalAnimalSexo">...</dd><dt class="col-sm-5 text-muted">Estado de Salud:</dt><dd class="col-sm-7 fw-bold" id="modalAnimalEstado">...</dd><dt class="col-sm-5 text-muted">Fecha de Ingreso:</dt><dd class="col-sm-7 fw-bold" id="modalAnimalIngreso">...</dd></dl>
                            </div></div></div>
                            <div class="col-lg-6"><div class="card h-100 card-custom card-image-bg"><div class="card-body p-2"><img src="" class="img-fluid rounded-3 w-100 h-100" style="object-fit: cover;" alt="Foto del Animal" id="modalAnimalImagen"></div></div></div>
                            <div class="col-lg-6"><div class="card h-100 card-custom card-feeding-bg"><div class="card-body">
                                <h5 class="card-title mb-3"><i class="fas fa-drumstick-bite text-warning me-2"></i>Alimentación</h5>
                                <dl class="row"><dt class="col-sm-5 text-muted">Tipo:</dt><dd class="col-sm-7 fw-bold" id="modalAlimentacionTipo">...</dd><dt class="col-sm-5 text-muted">Cantidad:</dt><dd class="col-sm-7 fw-bold" id="modalAlimentacionCantidad">...</dd></dl>
                            </div></div></div>
                            <div class="col-lg-6"><div class="card h-100 card-custom card-feeding-bg"><div class="card-body">
                                <h5 class="card-title mb-3"><i class="fas fa-heartbeat text-warning me-2"></i>Estado Actual</h5>
                                <dl class="row"><dt class="col-sm-5 text-muted">Tipo:</dt><dd class="col-sm-7 fw-bold" id="modalEstadoTipo">...</dd><dt class="col-sm-5 text-muted">Estado:</dt><dd class="col-sm-7 fw-bold" id="modalEstadoActual">...</dd></dl>
                            </div></div></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="location-content" role="tabpanel"><div class="p-4 rounded-3" style="background-color: #f0f9f4;">
                        <h4 class="mb-4"><i class="fas fa-map-marker-alt me-2"></i>Ubicación de Rescate</h4>
                        <div class="row g-4"><div class="col-md-5"><div class="card h-100"><div class="card-body">
                            <h6 class="card-title fw-bold mb-3">Dirección de Rescate</h6>
                            <ul class="list-unstyled" id="modalAnimalDireccion"></ul><hr><p class="text-muted mt-2 small"><b>Rescatado por:</b> <span id="modalAnimalRescatista">...</span></p>
                        </div></div></div><div class="col-md-7"><img src="{{ asset('Fotos/Patota.png') }}" alt="Mapa" class="img-fluid rounded border h-100" style="object-fit: cover;"></div></div>
                    </div></div>
                    <div class="tab-pane fade" id="actions-content" role="tabpanel"><div class="row g-3">
                        <div class="col-lg-4 col-md-6"><a href="#" class="action-box bg-success"><i class="fas fa-file-medical"></i><div><span>Evaluaciones Médicas</span><small>Ver historial médico</small></div></a></div>
                        <div class="col-lg-4 col-md-6"><a href="#" class="action-box bg-success"><i class="fas fa-plus"></i><div><span>Ubicación</span><small>Gestionar ubicaciones</small></div></a></div>
                        <div class="col-lg-4 col-md-6"><a href="#" class="action-box bg-purple"><i class="fas fa-truck-moving"></i><div><span>Traslados</span><small>Historial de movimientos</small></div></a></div>
                        <div class="col-lg-4 col-md-6"><a href="#" class="action-box bg-orange"><i class="fas fa-heart"></i><div><span>Tratamiento</span><small>Nuevo tratamiento</small></div></a></div>
                        <div class="col-lg-4 col-md-6"><a href="#" class="action-box bg-blue"><i class="fas fa-user"></i><div><span>Rescatista</span><small>Ver información</small></div></a></div>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cambiar Estado -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="changeStatusModalLabel">
                    <i class="fas fa-edit mr-2"></i>Cambiar Estado de Salud
                </h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Animal:</strong> <span id="changeStatusAnimalName">...</span>
                </div>
                
                <div class="form-group">
                    <label>Nuevo Estado de Salud</label>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="estado_muy_bueno" name="health_status" value="Muy Bueno">
                                <label class="custom-control-label" for="estado_muy_bueno">
                                    <span class="badge badge-success mr-2">Muy Bueno</span>Excelente condición
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="estado_bueno" name="health_status" value="Bueno">
                                <label class="custom-control-label" for="estado_bueno">
                                    <span class="badge badge-info mr-2">Bueno</span>Buena condición
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="estado_estable" name="health_status" value="Estable">
                                <label class="custom-control-label" for="estado_estable">
                                    <span class="badge badge-warning mr-2">Estable</span>Condición estable
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="estado_malo" name="health_status" value="Malo">
                                <label class="custom-control-label" for="estado_malo">
                                    <span class="badge badge-danger mr-2">Malo</span>Requiere atención
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-warning" id="confirmarCambioEstado">
                    <i class="fas fa-save mr-1"></i>Cambiar Estado
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .widget-user-2 .widget-user-header {
        padding: 1rem;
    }
    
    .widget-user-2 .widget-user-image {
        position: absolute;
        top: 15px;
        left: 15px;
        font-size: 90px;
        line-height: 90px;
        color: #fff;
        text-align: center;
        border-radius: 50%;
        width: 90px;
        height: 90px;
    }
    
    .widget-user-2 .widget-user-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    
    .image-upload-box {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .image-upload-box:hover {
        border-color: #007bff !important;
        background-color: #f8f9fa;
    }
    
    .card {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        border: 0;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    
    .btn-check:checked + .btn-outline-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
    
    .btn-check:checked + .btn-outline-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
    }
    
    .btn-check:checked + .btn-outline-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    
    .btn-check:checked + .btn-outline-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
    }
    
    .btn-check:checked + .btn-outline-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }
    
    .nav-tabs { border-bottom: 2px solid #dee2e6 !important; }
    .nav-tabs .nav-link { border: 0; border-bottom: 3px solid transparent; color: #6c757d; padding: 1rem; }
    .nav-tabs .nav-link.active { border-bottom-color: #28a745; color: #28a745; font-weight: bold; }
    .card-custom { border: 1px solid rgba(0,0,0,.08); box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); }
    .card-info-bg { background: linear-gradient(135deg, #eef5ff 0%, #f8f9ff 100%); }
    .card-image-bg { background: linear-gradient(135deg, #fff0f5 0%, #fff5f7 100%); }
    .card-feeding-bg { background: linear-gradient(135deg, #fff8e1 0%, #fffaf0 100%); }
    .action-box { display: flex; align-items: center; gap: 1rem; padding: 1.25rem; border-radius: 0.75rem; color: white; text-decoration: none; transition: all 0.2s ease-in-out; height: 100%; box-shadow: 0 4px 6px rgba(0,0,0,.1); }
    .action-box:hover { transform: translateY(-4px); box-shadow: 0 8px 12px rgba(0,0,0,.15); color: white; }
    .action-box i { font-size: 1.5rem; background-color: rgba(255,255,255,0.1); padding: 0.75rem; border-radius: 0.5rem; }
    .action-box div { display: flex; flex-direction: column; }
    .action-box span { font-weight: bold; font-size: 1.1rem; line-height: 1.2; }
    .action-box small { opacity: 0.8; font-size: 0.8rem; }
    .bg-purple { background-color: #6f42c1; }
    .bg-orange { background-color: #fd7e14; }
    .bg-blue { background-color: #0d6efd; }
</style>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // Variables para los modales
    let nombreRescatistaSeleccionado = null;

    // Manejo del flujo de agregar animal
    $('.btn-seleccionar-rescatista').on('click', function(e) {
        e.preventDefault();
        nombreRescatistaSeleccionado = $(this).data('rescatista-nombre');
        var modal = bootstrap.Modal.getInstance(document.getElementById('seleccionarRescatistaModal'));
        modal.hide();
    });
    
    $('#seleccionarRescatistaModal').on('hidden.bs.modal', function() {
        if (nombreRescatistaSeleccionado) {
            $('#rescuerNameBadge').text('Rescatista: ' + nombreRescatistaSeleccionado);
            setTimeout(() => {
                var agregarModal = new bootstrap.Modal(document.getElementById('agregarAnimalModal'));
                agregarModal.show();
            }, 100);
            nombreRescatistaSeleccionado = null;
        }
    });

    // Manejo de la imagen de upload
    $('.image-upload-box').on('click', function() {
        $('#imagen_animal').click();
    });
    
    $('#imagen_animal').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('.image-upload-box').html(`
                    <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">
                    <p class="text-success mt-2">Imagen seleccionada</p>
                `);
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Manejo del modal de detalles
    $('.view-details-btn').on('click', function() {
        const data = $(this).data();
        
        // Información básica
        $('#modalAnimalNombre').text(data.nombre);
        $('#modalAnimalImagen').attr('src', data.imagen);
        $('#modalAnimalEspecie').text(data.especie);
        $('#modalAnimalEspecieText').text(data.especie);
        $('#modalAnimalRaza').text(data.raza);
        $('#modalAnimalSexo').text(data.sexo);
        $('#modalAnimalEstado').text(data.estado_salud);
        $('#modalAnimalIngreso').text(data.fecha_ingreso);
        
        // Badges
        $('#modalAnimalTipoBadge').text(data.tipo).removeClass().addClass('badge badge-' + getTipoClass(data.tipo));
        $('#modalAnimalEstadoBadge').text(data.estado_salud).removeClass().addClass('badge badge-' + getEstadoClass(data.estado_salud));
        
        // Información adicional
        $('#modalAlimentacionTipo').text(data.alimentacion_tipo);
        $('#modalAlimentacionCantidad').text(data.alimentacion_cantidad);
        $('#modalAnimalRescatista').text(data.rescatista);
        $('#modalAnimalDireccion').html('<li>' + data.direccion + '</li>');
        $('#modalEstadoTipo').text(data.tipo);
        $('#modalEstadoActual').text(data.estado_salud);
        
        $('#changeStatusAnimalName').text(data.nombre);
    });
    
    // Función para obtener la clase del estado
    function getEstadoClass(estado) {
        switch(estado) {
            case 'Muy Bueno': return 'success';
            case 'Bueno': return 'info';
            case 'Estable': return 'warning';
            case 'Malo': return 'danger';
            case 'Muy Malo': return 'danger';
            default: return 'secondary';
        }
    }
    
    // Función para obtener la clase del tipo
    function getTipoClass(tipo) {
        switch(tipo) {
            case 'Animal Doméstico': return 'success';
            case 'Animal Silvestre': return 'warning';
            default: return 'secondary';
        }
    }
    
    // Guardar animal
    $('#guardarAnimal').on('click', function() {
        // Aquí iría la lógica para guardar el animal
        alert('Animal guardado exitosamente');
        var modal = bootstrap.Modal.getInstance(document.getElementById('agregarAnimalModal'));
        modal.hide();
        // Recargar la página o actualizar la lista
        location.reload();
    });
    
    // Confirmar cambio de estado
    $('#confirmarCambioEstado').on('click', function() {
        const nuevoEstado = $('input[name="health_status"]:checked').val();
        if (nuevoEstado) {
            alert('Estado cambiado a: ' + nuevoEstado);
            var modal = bootstrap.Modal.getInstance(document.getElementById('changeStatusModal'));
            modal.hide();
        } else {
            alert('Por favor selecciona un estado');
        }
    });
});
</script>
@endsection