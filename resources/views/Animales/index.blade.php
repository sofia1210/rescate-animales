@extends('layouts.admin')

@section('title', 'Gestión de Animales - Rescate Animales')

@php
    
    $animales = collect([
        (object)[
            'id' => 1,
            'nombre' => 'Jaguarcito',
            'especie' => 'Felino',
            'raza' => 'Jaguar',
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
                    Búsqueda
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Animal</label>
                                <select name="tipo" class="form-control select2" style="width: 100%;">
                                    <option value="Todos" {{ $tipo === 'Todos' ? 'selected' : '' }}>Todos los tipos</option>
                                    <option value="Doméstico" {{ $tipo === 'Doméstico' ? 'selected' : '' }}>Doméstico</option>
                                    <option value="Silvestre" {{ $tipo === 'Silvestre' ? 'selected' : '' }}>Silvestre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Estado de Salud</label>
                                <select name="estado" class="form-control select2" style="width: 100%;">
                                    <option value="Todos" {{ $estado === 'Todos' ? 'selected' : '' }}>Todos los estados</option>
                                    <option value="Muy Bueno" {{ $estado === 'Muy Bueno' ? 'selected' : '' }}>Excelente</option>
                                    <option value="Bueno" {{ $estado === 'Bueno' ? 'selected' : '' }}>Bueno</option>
                                    <option value="Estable" {{ $estado === 'Estable' ? 'selected' : '' }}>Estable</option>
                                    <option value="Malo" {{ $estado === 'Malo' ? 'selected' : '' }}>Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary flex-fill">
                                        <i class="fas fa-search mr-2"></i> Buscar
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Animals List -->
    <div class="row">
        @forelse ($animales as $animal)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm card card-primary card-outline">
                    <img src="{{ $animal->imagen }}" class="card-img-top" alt="Foto de {{ $animal->nombre }}" style="height: 200px; width: 85%; justify-content: center; display: block; margin: 0 auto; margin-top: 20px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $animal->nombre }}</h5>
                        <p class="card-text mb-1"><strong>Especie:</strong> {{ $animal->especie }}</p>
                        <p class="card-text mb-1"><strong>Tipo:</strong> {{ $animal->tipo }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pb-3">
                        <button type="button" class="btn btn-primary w-100 view-details-btn" 
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
                            <i class="fas fa-eye me-2"></i> Ver Detalles
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
                <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#agregarRescatistaModal">
                    <i class="fas fa-plus mr-1"></i> Agregar Nuevo Rescatista
                </button>
                <div class="list-group">
                    @foreach ($rescatistas as $rescatista)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $rescatista->nombre }}</h6>
                                <small class="text-muted">{{ $rescatista->telefono }}</small>
                            </div>
                            <button class="btn btn-success btn-sm"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#agregarAnimalModal"
                                    data-rescatista-id="{{ $rescatista->id }}"
                                    data-rescatista-nombre="{{ $rescatista->nombre }}"
                                    onclick="seleccionarRescatista('{{ $rescatista->nombre }}')">
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
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="agregarAnimalModalLabel">
                    <i class="fas fa-plus mr-2"></i>Agregar Nuevo Animal
                </h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
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
                        <div class="col-lg-6 mb-4">
                            <div class="card card-primary">
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
                        <div class="col-lg-6 mb-4">
                            <div class="card card-info">
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
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map"></i>
                                                </span>
                                            </div>
                                            <button type="button" class="btn btn-success" onclick="obtenerUbicacion()">
                                                <i class="fas fa-location-arrow mr-2"></i>Mi ubicación
                                            </button>
                                        </div>
                                        <div id="mapaRescate" style="height: 200px; border-radius: 8px; border: 1px solid #dee2e6; overflow: hidden;">
                                        </div>
                                        <small class="text-muted">Haga clic en el mapa para marcar la ubicación exacta del rescate</small>
                                        <input type="hidden" id="latitud_rescate" name="latitud_rescate">
                                        <input type="hidden" id="longitud_rescate" name="longitud_rescate">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Salud y Cuidados -->
                        <div class="col-lg-6 mb-4">
                            <div class="card card-warning">
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
                        <div class="col-lg-6 mb-4">
                            <div class="card card-secondary">
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

                        <!-- Observaciones -->
                        <div class="col-12 mb-4">
                            <div class="card card-light">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-clipboard-list mr-2"></i>Observaciones Adicionales
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="observaciones">Notas sobre el animal (Opcional)</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Describe el estado del animal, comportamiento, necesidades especiales, etc."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
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
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="modalAnimalNombre">
                    <i class="fas fa-paw mr-2"></i>Detalles del Animal
                </h4>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="row">
                    <div class="col-md-5">
                        <div class="text-center mb-2">
                            <img src="{{ asset('Fotos/OIP.jpg') }}" class="img-fluid rounded shadow" style="max-height: 250px; width: 100%; object-fit: cover;" alt="Foto del animal">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h4 class="text-primary mb-2">Sada</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Especie:</strong> Canino</p>
                                <p><strong>Raza:</strong> Labrador</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Estado de Salud:</strong> <span class="badge badge-warning">Malo</span></p>
                                <p><strong>Fecha de Ingreso:</strong> 01/09/2025</p>
                                <p><strong>Tipo:</strong> <span class="badge badge-success">Doméstico</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-2">Información de Rescate</h5>
                        <p><strong>Rescatista:</strong> Rescatista Temporal</p>
                        <p><strong>Ubicación:</strong> Calle Paitití, Centro, Santa Cruz De La Sierra</p>
                        <p><strong>Fecha de Rescate:</strong> 01/09/2025</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary mb-2">Alimentación</h5>
                        <p><strong>Tipo:</strong> Carnívoro</p>
                        <p><strong>Cantidad:</strong> Diaria</p>
                        <p><strong>Estado Nutricional:</strong> <span class="badge badge-info">Regular</span></p>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary">Ubicación de Rescate</h5>
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Dirección:</strong> Calle Paitití, Centro, Santa Cruz De La Sierra, Provincia Andrés Ibáñez, Santa Cruz, Bolivia</p>
                                <p><strong>Coordenadas:</strong> -17.7833, -63.1833</p>
                                <p><strong>Zona:</strong> Centro Urbano</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary">Acciones Disponibles</h5>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.seleccionar-veterinario-evaluacion') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-file-medical mr-2"></i> Evaluación Médica
                                </a>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.ver-ubicacion') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-map-marker-alt mr-2"></i> Ver Ubicación
                                </a>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.editar-datos') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-edit mr-2"></i> Editar Datos
                                </a>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.seleccionar-veterinario-tratamiento') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-heart mr-2"></i> Tratamiento
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary">Observaciones</h5>
                        <div class="alert alert-info">
                            <p class="mb-0">Animal rescatado en mal estado de salud. Requiere atención veterinaria inmediata. Se encuentra en observación para determinar el tratamiento adecuado.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="fas fa-edit mr-1"></i>Cambiar Estado
                </button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-warning" id="confirmarCambioEstado">
                    <i class="fas fa-save mr-1"></i>Cambiar Estado
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Rescatista -->
<div class="modal fade" id="agregarRescatistaModal" tabindex="-1" role="dialog" aria-labelledby="agregarRescatistaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="agregarRescatistaModalLabel">
                    <i class="fas fa-user-plus mr-2"></i>Agregar Nuevo Rescatista
                </h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rescatistaForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_rescatista">Nombre Completo *</label>
                                <input type="text" class="form-control" id="nombre_rescatista" name="nombre" placeholder="Ej. Juan Pérez" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono_rescatista">Teléfono *</label>
                                <input type="tel" class="form-control" id="telefono_rescatista" name="telefono" placeholder="Ej. 70012345" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ci_rescatista">Cédula de Identidad *</label>
                                <input type="text" class="form-control" id="ci_rescatista" name="ci" placeholder="Ej. 12345678" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_rescatista">Email</label>
                                <input type="email" class="form-control" id="email_rescatista" name="email" placeholder="Ej. juan@email.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion_rescatista">Dirección</label>
                        <textarea class="form-control" id="direccion_rescatista" name="direccion" rows="2" placeholder="Dirección del rescatista"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="observaciones_rescatista">Observaciones</label>
                        <textarea class="form-control" id="observaciones_rescatista" name="observaciones" rows="3" placeholder="Información adicional sobre el rescatista"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-success" id="guardarRescatista">
                    <i class="fas fa-save mr-1"></i>Guardar Rescatista
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>

function seleccionarRescatista(nombreRescatista) {
    console.log('Rescatista seleccionado:', nombreRescatista);
    $('#rescuerNameBadge').text('Rescatista: ' + nombreRescatista);
}

var mapaRescate = null;
var marcadorRescate = null;

function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            
            
            mapaRescate.setView([lat, lng], 15);
            
            
            if (marcadorRescate) {
                mapaRescate.removeLayer(marcadorRescate);
            }
            marcadorRescate = L.marker([lat, lng]).addTo(mapaRescate);
            
            
            document.getElementById('latitud_rescate').value = lat;
            document.getElementById('longitud_rescate').value = lng;
            
            console.log('Ubicación obtenida:', lat, lng);
        }, function(error) {
            console.error('Error al obtener ubicación:', error);
            alert('No se pudo obtener tu ubicación. Puedes marcar la ubicación manualmente en el mapa.');
        });
    } else {
        alert('La geolocalización no está disponible en este navegador.');
    }
}

$(document).ready(function() {
    console.log('JavaScript de animales cargado correctamente');
    
    
    $('.select2').select2({
        theme: 'default',
        width: '100%'
    });
    
    
    let nombreRescatistaSeleccionado = null;

    
    console.log('Modal de agregar animal existe:', document.getElementById('agregarAnimalModal') ? 'SÍ' : 'NO');
    console.log('Bootstrap disponible:', typeof bootstrap !== 'undefined' ? 'SÍ' : 'NO');
    console.log('jQuery disponible:', typeof $ !== 'undefined' ? 'SÍ' : 'NO');

    
    $('#agregarAnimalModal').on('shown.bs.modal', function() {
        console.log('Modal de agregar animal abierto, inicializando mapa...');
        
        
        if (!mapaRescate) {
            mapaRescate = L.map('mapaRescate').setView([-17.7833, -63.1833], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(mapaRescate);
            
            
            mapaRescate.on('click', function(e) {
                if (marcadorRescate) {
                    mapaRescate.removeLayer(marcadorRescate);
                }
                
                marcadorRescate = L.marker(e.latlng).addTo(mapaRescate);
                
                
                document.getElementById('latitud_rescate').value = e.latlng.lat;
                document.getElementById('longitud_rescate').value = e.latlng.lng;
                
                console.log('Ubicación marcada:', e.latlng.lat, e.latlng.lng);
            });
        }
    });

    
    $(document).on('click', '.image-upload-box', function() {
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

    
    $('#guardarAnimal').on('click', function() {
        console.log('Botón guardar animal clickeado');
        
        
        const form = document.getElementById('animalForm');
        if (form.checkValidity()) {
            
            const formData = new FormData(form);
            const animalData = {};
            
            for (let [key, value] of formData.entries()) {
                animalData[key] = value;
            }
            
            console.log('Datos del animal:', animalData);
            
            
            alert('Animal guardado exitosamente: ' + animalData.nombre);
            
            
            var modal = bootstrap.Modal.getInstance(document.getElementById('agregarAnimalModal'));
            if (modal) {
                modal.hide();
            }
            
            
            form.reset();
            $('.image-upload-box').html(`
                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-2">Click para subir o arrastra una imagen</p>
                <small class="text-muted">PNG, JPG, JPEG (Máx. 5MB)</small>
            `);
            
        } else {
            alert('Por favor completa todos los campos obligatorios');
            form.reportValidity();
        }
    });
    
    
    $('.view-details-btn').on('click', function() {
        const data = $(this).data();
        
        
        $('#modalAnimalNombre').text(data.nombre);
        $('#modalAnimalImagen').attr('src', data.imagen);
        $('#modalAnimalEspecie').text(data.especie);
        $('#modalAnimalEspecieText').text(data.especie);
        $('#modalAnimalRaza').text(data.raza);
        $('#modalAnimalSexo').text(data.sexo);
        $('#modalAnimalEstado').text(data.estado_salud);
        $('#modalAnimalIngreso').text(data.fecha_ingreso);
        
        
        $('#modalAnimalTipoBadge').text(data.tipo).removeClass().addClass('badge badge-' + getTipoClass(data.tipo));
        $('#modalAnimalEstadoBadge').text(data.estado_salud).removeClass().addClass('badge badge-' + getEstadoClass(data.estado_salud));
        
        
        $('#modalAlimentacionTipo').text(data.alimentacion_tipo);
        $('#modalAlimentacionCantidad').text(data.alimentacion_cantidad);
        $('#modalAnimalRescatista').text(data.rescatista);
        $('#modalAnimalDireccion').html('<li>' + data.direccion + '</li>');
        $('#modalEstadoTipo').text(data.tipo);
        $('#modalEstadoActual').text(data.estado_salud);
        
        $('#changeStatusAnimalName').text(data.nombre);
    });
    
    
    function getEstadoClass(estado) {
        return 'secondary';
    }
    
    
    function getTipoClass(tipo) {
        switch(tipo) {
            case 'Animal Doméstico': return 'success';
            case 'Animal Silvestre': return 'warning';
            default: return 'secondary';
        }
    }
    
    
    $('#guardarAnimal').on('click', function() {
        
        var modal = bootstrap.Modal.getInstance(document.getElementById('agregarAnimalModal'));
        if (modal) {
            modal.hide();
        }
    });
    
    
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
    
    
    $('#guardarRescatista').on('click', function() {
        
        var modal = bootstrap.Modal.getInstance(document.getElementById('agregarRescatistaModal'));
        if (modal) {
            modal.hide();
        }
    });
});
</script>
@endsection