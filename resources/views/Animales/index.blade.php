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
                <!-- Botón (card-tools) para abrir Seleccionar Rescatista: sólo Rescatista/Admin -->
                <!-- Abrir Seleccionar Rescatista: BS4 -->
                <!-- Botón Agregar Animal en card-tools -->
                <div class="card-tools">
                    <button type="button"
                            class="btn btn-success"
                            data-toggle="modal"
                            data-target="#agregarAnimalModal"
                            data-role-allowed="Rescatista">
                        <i class="fas fa-plus mr-1"></i> Agregar Animal
                    </button>
                    <!-- Cambiado: este botón abre selección de rescatista -->
                    <button type="button"
                            class="btn btn-info"
                            data-toggle="modal"
                            data-target="#seleccionarRescatistaModal"
                            data-role-allowed="Veterinario,Administrador">
                        <i class="fas fa-user-check mr-1"></i> Seleccionar Rescatista
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
                        <button type="button" class="btn btn-primary w-100 view-details-btn" data-encargado-allowed
                                data-toggle="modal" 
                                data-target="#animalDetailsModal"
                                data-animal-id="{{ $animal->id }}"
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
                    <!-- Estado vacío: Agregar Primer Animal -->
                    <div class="alert alert-info text-center">
                        <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay animales para mostrar.</h4>
                        <p class="text-muted">Comienza agregando tu primer animal al sistema.</p>
                        <button type="button"
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#seleccionarRescatistaModal"
                                data-role-allowed="Rescatista,Veterinario,Administrador">
                            <i class="fas fa-plus mr-1"></i> Agregar Primer Animal
                        </button>
                    </div>
                </div>
        @endforelse
        </div>
    </div>
</section>

<!-- Modal Seleccionar Rescatista -->
<div class="modal fade"
     id="seleccionarRescatistaModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="seleccionarRescatistaModalLabel"
     aria-hidden="true"
     data-role-allowed="Rescatista,Veterinario,Administrador">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="seleccionarRescatistaModalLabel">
                    <i class="fas fa-user-plus mr-2"></i>Seleccionar Rescatista
                </h5>
                <!-- Modal Seleccionar Rescatista: botón de cierre BS4 -->
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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
                <!-- Dentro de Seleccionar Rescatista: agregar rescatista sólo Admin -->
                <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#agregarRescatistaModal" data-role-allowed="Administrador">
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
                                    data-toggle="modal"
                                    data-target="#agregarAnimalModal"
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
                <!-- Modal Agregar Animal: botón de cierre BS4 -->
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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
                                        <label>Ubicación aproximada del rescate</label>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map"></i>
                                            <small class="ml-2 text-muted">Referencia visual</small>
                                        </div>

                                        <div id="mapaRescate" style="display: none; height: 200px; border-radius: 8px; border: 1px solid #dee2e6; overflow: hidden;"></div>
                                        <img id="mapaRescateFallback" src="{{ asset('mapa.png') }}" alt="Mapa no disponible"
                                             style="height: 200px; width: 100%; border-radius: 8px; border: 1px solid #dee2e6; display: block;">
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
            <!-- Guardar Animal: Rescatista/Veterinario/Admin -->
            <div class="modal-footer">
                
                <button type="button"
                        class="btn btn-success"
                        id="guardarAnimal"
                        data-dismiss="modal"
                        data-role-allowed="Rescatista,Veterinario,Administrador">
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
                <!-- Id actual del animal para handlers JS -->
                <input type="hidden" id="animalIdActual" value="">
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
                
                <!-- Historial de Cambios -->
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-clock mr-2"></i> Historial de Cambios</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <h6 class="text-primary">Traslados</h6>
                        <ul id="hist-traslados" class="list-unstyled small mb-3"></ul>
                      </div>
                      <div class="col-md-4">
                        <h6 class="text-primary">Evaluaciones Médicas</h6>
                        <ul id="hist-evaluaciones" class="list-unstyled small mb-3"></ul>
                      </div>
                      <div class="col-md-4">
                        <h6 class="text-primary">Cuidados</h6>
                        <ul id="hist-cuidados" class="list-unstyled small mb-3"></ul>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary">Acciones Disponibles</h5>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.seleccionar-veterinario-evaluacion') }}" class="btn btn-success btn-block" data-role-allowed="Veterinario,Administrador">
                                    <i class="fas fa-file-medical mr-2"></i> Evaluación Médica
                                </a>
                            </div>
                            <div class="col-6 mb-2">
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#changeLocationModal" data-role-allowed="Rescatista,Veterinario,Administrador,Cuidador">
                                    <i class="fas fa-map-marked-alt mr-2"></i> Actualizar Ubicación
                                </button>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.editar-datos') }}" class="btn btn-warning btn-block" data-role-allowed="Administrador">
                                    <i class="fas fa-edit mr-2"></i> Editar Datos
                                </a>
                            </div>
                            <div class="col-6 mb-2">
                                <a href="{{ route('animales.seleccionar-veterinario-tratamiento') }}" class="btn btn-primary btn-block" data-role-allowed="Veterinario,Administrador">
                                    <i class="fas fa-heart mr-2"></i> Tratamiento
                                </a>
                            </div>
                            <!-- Acciones Disponibles -->
                           
                                <div class="col-6 mb-2">
                                <a href="#"
                                   class="btn btn-info btn-block"
                                   data-toggle="modal"
                                   data-target="#hojaVidaModal"
                                   data-role-allowed="Cuidador,Veterinario,Encargado,Administrador"
                                   data-encargado-allowed>
                                    <i class="fas fa-clipboard-list mr-2"></i> Hoja de Vida
                                </a>
                            
                            </div>
                            
                            <!-- Modal Hoja de Vida -->
                            <div class="modal fade" 
                                     id="hojaVidaModal" 
                                     tabindex="-1" 
                                     aria-hidden="true" 
                                     data-role-allowed="Cuidador,Veterinario,Administrador">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title text-white">
                                                <i class="fas fa-clipboard-list mr-2"></i>
                                                Hoja de Vida del Animal
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="hojaVidaForm">
                                                <div class="form-group">
                                                    <label for="fecha_registro">Fecha de Registro</label>
                                                    <input type="date" class="form-control" id="fecha_registro" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="tipo_cuidado">Tipo de Cuidado</label>
                                                    <select class="form-control" id="tipo_cuidado" required>
                                                        <option value="">Seleccione...</option>
                                                        <option value="Alimentación">Alimentación</option>
                                                        <option value="Higiene">Higiene</option>
                                                        <option value="Ejercicio">Ejercicio</option>
                                                        <option value="Socialización">Socialización</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="detalles_cuidado">Detalles del Cuidado</label>
                                                    <textarea class="form-control" 
                                                              id="detalles_cuidado" 
                                                              rows="3" 
                                                              placeholder="Describa los cuidados realizados..."
                                                              required></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="comportamiento">Comportamiento Observado</label>
                                                    <textarea class="form-control" 
                                                              id="comportamiento" 
                                                              rows="2" 
                                                              placeholder="Describa el comportamiento del animal..."></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="notas_adicionales">Notas Adicionales</label>
                                                    <textarea class="form-control" 
                                                              id="notas_adicionales" 
                                                              rows="2" 
                                                              placeholder="Observaciones adicionales..."></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times mr-1"></i>Cancelar
                                            </button>
                                            <button type="button" class="btn btn-info" id="guardarHojaVida">
                                                <i class="fas fa-save mr-1"></i>Guardar Registro
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @section('js')
                            <script>
                            // Mostrar/ocultar botón Liberar según tipo de animal
                            function actualizarBotonesSegunTipo() {
                                const tipo = $('#detalleAnimalModal').data('tipo');
                                if (tipo === 'Doméstico') {
                                    $('.liberar-btn').hide();
                                } else {
                                    $('.liberar-btn').show();
                                }
                            }
                            
                            // Actualizar al abrir modal
                            $('#detalleAnimalModal').on('show.bs.modal', function() {
                                actualizarBotonesSegunTipo();
                            });
                            
                            // Guardar Hoja de Vida
                            $('#guardarHojaVida').on('click', function() {
                                if (!$('#hojaVidaForm')[0].checkValidity()) {
                                    $('#hojaVidaForm')[0].reportValidity();
                                    return;
                                }
                                
                                // Aquí iría la lógica para guardar los datos
                                $('#hojaVidaModal').modal('hide');
                                // Mostrar confirmación
                                toastr.success('Registro guardado correctamente');
                            });
                            </script>
                            @endsection
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

                <!-- Solicitar revisión veterinaria: Cuidador/Rescatista/Veterinario/Encargado/Admin -->
                <div class="mt-3" data-role-allowed="Cuidador,Rescatista,Veterinario,Encargado,Administrador" data-role-visibility="disable">
                    <button class="btn btn-info" id="btnSolicitarRevision" data-encargado-allowed="true">Solicitar revisión veterinaria</button>
                </div>
            </div>
            <!-- Botón Cambiar Estado: sólo Admin -->
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changeStatusModal" data-role-allowed="Administrador">
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

<!-- Modal Cambiar Ubicación (Centro) -->
<div class="modal fade" id="changeLocationModal" tabindex="-1" role="dialog" aria-labelledby="changeLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="changeLocationModalLabel">
                    <i class="fas fa-map-marker-alt mr-2"></i>Actualizar Ubicación (Centro)
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="selectCentro">Centro de Refugio</label>
                    <select id="selectCentro" class="form-control">
                        <option value="">Selecciona un centro…</option>
                        <option value="1">Norte</option>
                        <option value="2">Sur</option>
                    </select>
                </div>
                <div id="mapaCambioCentro" style="height: 250px; border-radius: 8px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-info" id="confirmarCambioUbicacion">
                    <i class="fas fa-save mr-1"></i>Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Rescatista: restringir todo el modal a Admin -->
<div class="modal fade" id="agregarRescatistaModal" tabindex="-1" role="dialog" aria-labelledby="agregarRescatistaModalLabel" aria-hidden="true" data-role-allowed="Administrador">
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
                <button type="button" class="btn btn-success" id="guardarRescatista" data-bs-dismiss="modal" data-dismiss="modal">
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
    $('#rescuerNameBadge').text('Rescatista: ' + nombreRescatista);
}

var mapaRescate = null;
var marcadorRescate = null;

$(document).ready(function() {
    // Proteger select2 si no está cargado
    if ($.fn && $.fn.select2) {
        $('.select2').select2({ theme: 'default', width: '100%' });
    }

    // helper: tiles con fallback y toggle de imagen
    function addTileWithFallbackRescate(map) {
        const providers = [
            { url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', attr: '© OpenStreetMap' },
            { url: 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', attr: '© OSM France HOT' },
            { url: 'https://{s}.tile.openstreetmap.de/{z}/{x}/{y}.png', attr: '© OSM DE' },
            { url: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', attr: '© Carto, © OSM' }
        ];
        let idx = 0, layer = null, anyTileLoaded = false;

        function use(i) {
            if (layer) { try { map.removeLayer(layer); } catch(e) {} }
            const p = providers[i];
            layer = L.tileLayer(p.url, { attribution: p.attr });
            layer.on('tileload', function() {
                anyTileLoaded = true;
                $('#mapaRescateFallback').hide();
                $('#mapaRescate').show();
            });
            layer.on('tileerror', function() {
                idx++;
                if (idx < providers.length) {
                    use(idx);
                } else if (!anyTileLoaded) {
                    $('#mapaRescate').hide();
                    $('#mapaRescateFallback').show();
                }
            });
            layer.addTo(map);
        }
        use(0);
    }

    // Inicializar el mapa de rescate: forzar imagen y no Leaflet
    $('#agregarAnimalModal').on('shown.bs.modal', function() {
        $('#mapaRescate').hide();
        $('#mapaRescateFallback').show();
        return;
    });
});
</script>
@endsection

@section('js')
<script>
// Integración con MockDB para Detalles del Animal y Historial de Cambios
(function() {
  function getNombreById(entity, id, field='nombre') {
    const r = window.MockDB.find(entity, id);
    return r ? r[field] : '';
  }
  function getTipoNombre(tipo_id) {
    const r = window.MockDB.find('Tipo_Animal', tipo_id);
    return r ? r.nombre : '';
  }

  // Lista estática de centros (solo Norte y Sur)
  const CENTROS_STATIC = [
    { centro_id: 1, nombre: 'Norte', latitud: -17.7500, longitud: -63.2000 },
    { centro_id: 2, nombre: 'Sur',   latitud: -17.8400, longitud: -63.1700 }
  ];

  // Mapa para cambio de centro
  let mapaCambioCentro = null;
  let marcadorCambioCentro = null;

  // Guardar el animal clicado (soporta data-animal-id y data-id)
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-animal-id],[data-id]');
    if (btn) {
      const val = parseInt(btn.getAttribute('data-animal-id') || btn.getAttribute('data-id'), 10);
      if (!isNaN(val)) window.currentAnimalId = val;
    }
  });

  // Poblar modal de detalles leyendo el botón que lo disparó
  $('#animalDetailsModal').on('show.bs.modal', function(e) {
    const triggerBtn = $(e.relatedTarget);
    if (triggerBtn && triggerBtn.length) {
      const val = parseInt(triggerBtn.data('animal-id') || triggerBtn.data('id'), 10);
      if (!isNaN(val)) window.currentAnimalId = val;
    }

    const animals = window.MockDB.get('Hoja_Animal') || [];
    if (!animals.length) return;

    const id = window.currentAnimalId || animals[0].hoja_animal_id;
    const a = window.MockDB.find('Hoja_Animal', id) || animals[0];

    // Poblar selector de cambio de centro dentro del modal de detalles (si existe)
    const $selNuevoCentro = $('#selectCentroNuevo');
    if ($selNuevoCentro && $selNuevoCentro.length) {
      $selNuevoCentro.empty().append('<option value="">Selecciona un centro…</option>');
      CENTROS_STATIC.forEach(c => {
        $selNuevoCentro.append(`<option value="${c.centro_id}">${c.nombre}</option>`);
      });
      if (a && a.centro_id) $selNuevoCentro.val(String(a.centro_id));
    }

    // Rellenar encabezado y campos básicos
    $('#modalAnimalNombre').html('<i class="fas fa-paw mr-2"></i>Detalles del Animal — ' + a.nombre);

    const especieNom = getNombreById('Especie', a.especie_id);
    const razaNom = getNombreById('Raza', a.raza_id);
    const estadoNom = getNombreById('Estado_Animal', a.estado_id);
    const tipoNom = getTipoNombre(a.tipo_id);

    // Actualiza los elementos visibles en el panel superior del modal
    const infoLeft = `
      <p><strong>Especie:</strong> ${especieNom}</p>
      <p><strong>Raza:</strong> ${razaNom}</p>
      <p><strong>Sexo:</strong> Macho</p>`;
    const infoRight = `
      <p><strong>Estado de Salud:</strong> <span class="badge badge-${estadoNom === 'Malo' ? 'warning' : 'success'}">${estadoNom}</span></p>
      <p><strong>Fecha de Ingreso:</strong> 01/09/2025</p>
      <p><strong>Tipo:</strong> <span class="badge badge-${tipoNom === 'Doméstico' ? 'success' : 'info'}">${tipoNom}</span></p>`;

    const cols = $('#animalDetailsModal .modal-body .row').first().find('.col-sm-6');
    if (cols.length >= 2) {
      $(cols[0]).html(infoLeft);
      $(cols[1]).html(infoRight);
    }

    // Ajusta botones según tipo (mantiene tu lógica)
    const tipo = (tipoNom || '').normalize('NFD').replace(/\p{Diacritic}/gu,'').toLowerCase();
    if (tipo.includes('domestico')) {
      $('.liberar-btn').hide();
    } else {
      $('.liberar-btn').show();
    }

    // Establecer id actual en input oculto para otros handlers
    $('#animalIdActual').val(id);

    // Historial de Cambios: Traslados
    const tras = (window.MockDB.get('Traslado') || []).filter(t => Number(t.hoja_animal_id) === Number(id));
    const centros = window.MockDB.get('Centro') || [];
    const nombreCentro = cid => (centros.find(c => Number(c.centro_id) === Number(cid)) || {}).nombre || '-';
    const $t = $('#hist-traslados'); $t.empty();
    tras.forEach(t => {
      const lat = t.latitud != null ? Number(t.latitud).toFixed(4) : '0.0000';
      const lng = t.longitud != null ? Number(t.longitud).toFixed(4) : '0.0000';
      $t.append(`<li class="mb-2"><i class="fas fa-route text-info mr-1"></i> ${t.nombre} → ${nombreCentro(t.centro_id)} <span class="text-muted">(${lat}, ${lng})</span><br><span class="text-muted">${t.observaciones || ''}</span></li>`);
    });
    if (!tras.length) $t.append('<li class="text-muted">Sin traslados registrados</li>');

    // Historial de Cambios: Evaluaciones Médicas
    const evals = (window.MockDB.get('Evaluacion_Medica') || []).filter(e => Number(e.hoja_animal_id) === Number(id));
    const tiposTrat = window.MockDB.get('Tipo_Tratamiento') || [];
    const tipoTratNom = tid => (tiposTrat.find(t => Number(t.tratamiento_id) === Number(tid)) || {}).nombre || '-';
    const $e = $('#hist-evaluaciones'); $e.empty();
    evals.forEach(ev => {
      const fecha = ev.fecha || '';
      const desc = ev.descripcion || '';
      const tipoN = tipoTratNom(ev.tratamiento_id);
      $e.append(`<li class="mb-2"><i class="fas fa-stethoscope text-success mr-1"></i> ${fecha}: ${desc}<br><span class="badge badge-info">${tipoN}</span></li>`);
    });
    if (!evals.length) $e.append('<li class="text-muted">Sin evaluaciones registradas</li>');

    // Historial de Cambios: Cuidados
    const cuidados = (window.MockDB.get('Cuidado') || []).filter(c => Number(c.hoja_animal_id) === Number(id));
    const tiposCuidado = (window.MockDB.get('Tipo_Cuidado') || []);
    const tipoCNom = tcid => (tiposCuidado.find(t => Number(t.tipo_cuidado_id) === Number(tcid)) || {}).nombre || '-';
    const $c = $('#hist-cuidados'); $c.empty();
    cuidados.forEach(c => {
      const fecha = c.fecha || '';
      const detalle = c.detalle || '';
      const tipoN = tipoCNom(c.tipo_cuidado_id);
      $c.append(`<li class="mb-2"><i class="fas fa-hand-holding-heart text-primary mr-1"></i> ${fecha}: ${tipoN} — ${detalle}</li>`);
    });
    if (!cuidados.length) $c.append('<li class="text-muted">Sin cuidados registrados</li>');
  });

  // Guardar registro de Hoja de Vida como Cuidado en MockDB
  $('#guardarHojaVida').off('click').on('click', function() {
    const animals = window.MockDB.get('Hoja_Animal') || [];
    const id = window.currentAnimalId || (animals[0] && animals[0].hoja_animal_id);
    if (!id) return;

    const fecha = $('#fecha_registro').val() || new Date().toISOString().slice(0,10);
    const tipoNomSel = $('#tipo_cuidado').val();
    const tiposC = window.MockDB.get('Tipo_Cuidado') || [];
    const tipoRow = tiposC.find(t => t.nombre === tipoNomSel) || tiposC[0];

    window.MockDB.create('Cuidado', {
      hoja_animal_id: id,
      tipo_cuidado_id: tipoRow ? tipoRow.tipo_cuidado_id : null,
      fecha: fecha,
      detalle: $('#detalles_cuidado').val(),
      cuidador_persona_id: 11
    });

    $('#hojaVidaModal').modal('hide');
    setTimeout(() => (window.toastr && window.toastr.success) ? window.toastr.success('Cuidado registrado') : alert('Cuidado registrado'), 50);
  });

  // Cambiar Estado (mapear a catálogo simple: Bueno=2, Malo=1)
  $('#changeStatusModal').on('show.bs.modal', function() {
    const animals = window.MockDB.get('Hoja_Animal') || [];
    const id = window.currentAnimalId || (animals[0] && animals[0].hoja_animal_id);
    const a = id ? window.MockDB.find('Hoja_Animal', id) : null;
    $('#changeStatusAnimalName').text(a ? a.nombre : 'Animal');
    // limpiar selección previa
    $('input[name="health_status"]').prop('checked', false);
  });
  $('#confirmarCambioEstado').on('click', function() {
    const sel = $('input[name="health_status"]:checked').val() || '';
    const good = ['Muy Bueno','Bueno','Estable'];
    const estadoId = good.includes(sel) ? 2 : 1; // 2=Bueno, 1=Malo
    const animals = window.MockDB.get('Hoja_Animal') || [];
    const id = window.currentAnimalId || (animals[0] && animals[0].hoja_animal_id);
    if (!id) return;
    window.MockDB.update('Hoja_Animal', { hoja_animal_id: id, estado_id: estadoId });
    $('#changeStatusModal').modal('hide');
    setTimeout(() => alert('Estado actualizado'), 50);
  });

  // Cambiar Ubicación (Centro): preselección y mapa
  $('#changeLocationModal').on('show.bs.modal', function() {
    const $sel = $('#selectCentro');

    const animals = window.MockDB.get('Hoja_Animal') || [];
    const id = window.currentAnimalId || (animals[0] && animals[0].hoja_animal_id);
    const a = id ? window.MockDB.find('Hoja_Animal', id) : null;
    if (a && a.centro_id) $sel.val(String(a.centro_id));

    if (!mapaCambioCentro) {
      mapaCambioCentro = L.map('mapaCambioCentro').setView([-17.7833, -63.1833], 12);
      window.createLeafletTileWithFallback(mapaCambioCentro);
    }
    setTimeout(() => mapaCambioCentro.invalidateSize(true), 0);

    const setMarkerToCentro = (centroId) => {
      const c = CENTROS_STATIC.find(x => Number(x.centro_id) === Number(centroId));
      if (!c) return;
      const ll = [c.latitud, c.longitud];
      if (marcadorCambioCentro) mapaCambioCentro.removeLayer(marcadorCambioCentro);
      marcadorCambioCentro = L.marker(ll).addTo(mapaCambioCentro).bindPopup(c.nombre);
      mapaCambioCentro.setView(ll, 14);
    };

    const initialId = Number($sel.val() || 0);
    if (initialId) setMarkerToCentro(initialId);

    $sel.off('change').on('change', function() {
      const val = Number($(this).val() || 0);
      if (val) setMarkerToCentro(val);
    });
  });

  $('#confirmarCambioUbicacion').off('click').on('click', function() {
    const centroId = Number($('#selectCentro').val() || 0);
    const animals = window.MockDB.get('Hoja_Animal') || [];
    const id = window.currentAnimalId || (animals[0] && animals[0].hoja_animal_id);
    if (!id || !centroId) { alert('Selecciona un centro válido.'); return; }

    // Actualizar centro en Hoja_Animal
    window.MockDB.update('Hoja_Animal', { hoja_animal_id: id, centro_id: centroId });

    // Registrar traslado con lat/lng del centro usando lista estática
    const destino = CENTROS_STATIC.find(c => Number(c.centro_id) === Number(centroId)) || {};
    window.MockDB.create('Traslado', {
      hoja_animal_id: id,
      centro_id: centroId,
      nombre: 'Cambio de centro',
      latitud: destino.latitud || -17.7833,
      longitud: destino.longitud || -63.1833,
      observaciones: `Actualización de ubicación hacia ${destino.nombre || 'Centro'}`,
      fecha: new Date().toISOString().slice(0, 10)
    });

    $('#changeLocationModal').modal('hide');
    setTimeout(() => alert('Ubicación y centro actualizados. Se registró el traslado.'), 50);
  });

  // Guardar Animal (crear Hoja_Animal mínima)
  $('#guardarAnimal').on('click', function() {
    const nombre = ($('#nombre_animal').val() || '').trim();
    const estadoTxt = $('#estado_salud').val() || '';
    if (!nombre) { alert('Ingresa el nombre del animal'); return; }
    const estadoId = ['Muy Bueno','Bueno','Estable'].includes(estadoTxt) ? 2 : 1;
    const centros = window.MockDB.get('Centro') || [];
    const centroId = (centros[0] && centros[0].centro_id) || null;
    const rec = window.MockDB.create('Hoja_Animal', {
      nombre: nombre,
      estado_id: estadoId,
      centro_id: centroId
    });
    $('#agregarAnimalModal').modal('hide');
    setTimeout(() => alert('Animal registrado (Hoja de Vida creada)'), 50);
  });

})();

// Solicitud de revisión veterinaria desde el modal del animal
document.addEventListener('DOMContentLoaded', function() {
  const btnRev = document.getElementById('btnSolicitarRevision');
  if (btnRev) {
    btnRev.addEventListener('click', function(e) {
      e.preventDefault();
      const animalId = Number(document.getElementById('animalIdActual')?.value || window.currentAnimalId || 0);
      if (!window.MockDB || !animalId) {
        alert('No se pudo registrar la solicitud.');
        return;
      }
      window.MockDB.create('Solicitud_Revision', {
        hoja_animal_id: animalId,
        usuario_id: 100,
        estado: 'pendiente',
        fecha: new Date().toISOString().slice(0,10)
      });
      alert('Solicitud de revisión enviada al equipo veterinario.');
    });
  }
});
</script>
@endsection