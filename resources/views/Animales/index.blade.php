@extends('layouts.admin')
{{-- NOTA: Este código asume que tu plantilla 'layouts.admin' carga Bootstrap 5 y Font Awesome. --}}

@section('title', 'Animales - Rescate Animales')

@php
    // --- 1. DATOS HARDCODEADOS DIRECTAMENTE EN LA VISTA ---
    $animales = collect([
        (object)[
            'id' => 1,
            'nombre' => 'Sada',
            'especie' => 'Asdas',
            'raza' => 'Sadda',
            'sexo' => 'Macho',
            'estado_salud' => 'Malo',
            'fecha_ingreso' => now()->parse('2025-09-01'),
            'tipo' => 'Animal Doméstico',
            'imagen' => asset('Fotos/OIP.jpg'), // Asegúrate que la ruta a tu imagen sea correcta
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
            'imagen' => asset('Fotos/R.jpg'), // Asegúrate que la ruta a tu imagen sea correcta
            'rescatista' => 'Lucas',
            'direccion' => 'Parque Nacional Amboró, Buena Vista, Santa Cruz',
            'alimentacion_tipo' => 'Carnívoro',
            'alimentacion_cantidad' => '2kg',
        ],
    ]);

    // Simulación de variables de filtro para que la vista no dé error
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
<div class="container-fluid">

    {{-- TÍTULO DE LA PÁGINA --}}
    <h1 class="display-6 mb-4">Listado de Animales</h1>

    {{-- CONTENEDOR PARA BÚSQUEDA Y FILTROS --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="" method="GET">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="w-50">
                        <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ $nombre ?? '' }}">
                    </div>
                    {{-- BOTÓN QUE INICIA EL FLUJO --}}
<a href="#" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#seleccionarRescatistaModal">
    <i class="fas fa-plus me-2"></i> Agregar Animal
</a>


<div class="modal fade" id="seleccionarRescatistaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem;">
            <div class="modal-header">
                <h5 class="modal-title">Seleccionar Rescatista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-2 mb-3">
                    <input type="text" class="form-control" placeholder="Buscar por nombre o teléfono...">
                    <button class="btn btn-success flex-shrink-0"><i class="fas fa-plus me-1"></i> Agregar</button>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($rescatistas as $rescatista)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">{{ $rescatista->nombre }}</div>
                                <small class="text-muted">{{ $rescatista->telefono }}</small>
                            </div>
                            <button class="btn btn-sm btn-success btn-seleccionar-rescatista"
                                    data-rescatista-id="{{ $rescatista->id }}"
                                    data-rescatista-nombre="{{ $rescatista->nombre }}">
                                Seleccionar
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarAnimalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 1.5rem;">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold">Agregar Animal</h5>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-light text-dark border"><small>Campos obligatorios marcados con *</small></span>
                        <span class="badge bg-primary" id="rescuerNameBadge">Rescatista: ...</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-4">
                    <div class="col-lg-6">
                        <div class="card card-custom card-info-bg h-100"><div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-user text-primary me-2"></i>Información Básica</h5>
                            <div class="mb-3"><label class="form-label">Nombre *</label><input type="text" class="form-control" placeholder="ej. Pequeño Jaguar"></div>
                            <div class="mb-3"><label class="form-label">Tipo *</label><select class="form-select"><option selected>Selecciona una opción</option></select></div>
                            <div class="mb-3"><label class="form-label">Especie *</label><select class="form-select"><option selected>Selecciona una opción</option></select></div>
                            <div class="mb-3"><label class="form-label">Raza *</label><input type="text" class="form-control" placeholder="ej. Jaguar"></div>
                            <div class="mb-3"><label class="form-label">Sexo *</label><select class="form-select"><option selected>Selecciona una opción</option></select></div>
                        </div></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-custom card-info-bg h-100"><div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Información del Rescate</h5>
                            <div class="mb-3"><label class="form-label">Fecha de Rescate *</label><input type="date" class="form-control"></div>
                            <div class="mb-3"><label class="form-label">Ubicación del Rescate *</label><input type="text" class="form-control"></div>
                            <label class="form-label">Ubicación en el mapa *</label>
                            <div class="input-group mb-3"><span class="input-group-text">Ayuda</span><button class="btn btn-success" type="button"><i class="fas fa-location-arrow me-2"></i>Mi ubicación</button></div>
                            <img src="{{ asset('Fotos/Patota    .png') }}" alt="Mapa" class="img-fluid rounded border">
                        </div></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-custom card-feeding-bg h-100"><div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-heartbeat text-warning me-2"></i>Salud y Cuidados</h5>
                            <div class="mb-3"><label class="form-label">Estado de Salud *</label><select class="form-select"><option selected>Selecciona una opción</option></select></div>
                            <div class="mb-3"><label class="form-label">Tipo de Alimentación *</label><select class="form-select"><option selected>Selecciona una opción</option></select></div>
                        </div></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-custom card-image-bg h-100"><div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-image text-pink me-2"></i>Multimedia</h5>
                            <label class="form-label">Foto del Animal (Opcional)</label>
                            <div class="image-upload-box text-center p-5 border-2 border-dashed rounded-3">
                                <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i><p class="text-success">Click para subir o arrastra una imagen</p><small class="text-muted">PNG, JPG, JPEG</small>
                            </div>
                        </div></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-lg w-100"><i class="fas fa-check me-2"></i>Agregar Animal</button>
            </div>
        </div>
    </div>
</div>
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <strong class="me-3">Tipo:</strong>
                    <div class="btn-group" role="group">
                        <button type="submit" name="tipo" value="Todos" class="btn btn-sm {{ $tipo === 'Todos' ? 'btn-success' : 'btn-outline-secondary' }}">Todos</button>
                        <button type="submit" name="tipo" value="Doméstico" class="btn btn-sm {{ $tipo === 'Doméstico' ? 'btn-success' : 'btn-outline-secondary' }}">Doméstico</button>
                        <button type="submit" name="tipo" value="Silvestre" class="btn btn-sm {{ $tipo === 'Silvestre' ? 'btn-success' : 'btn-outline-secondary' }}">Silvestre</button>
                    </div>
                </div>
                 <div class="d-flex align-items-center">
                    <strong class="me-3">Estado:</strong>
                    <div class="btn-group" role="group">
                        <button type="submit" name="estado" value="Todos" class="btn btn-sm {{ $estado === 'Todos' ? 'btn-success' : 'btn-outline-secondary' }}">Todos</button>
                        <button type="submit" name="estado" value="Muy Bueno" class="btn btn-sm {{ $estado === 'Muy Bueno' ? 'btn-success' : 'btn-outline-secondary' }}">Muy Bueno</button>
                        <button type="submit" name="estado" value="Bueno" class="btn btn-sm {{ $estado === 'Bueno' ? 'btn-success' : 'btn-outline-secondary' }}">Bueno</button>
                        <button type="submit" name="estado" value="Estable" class="btn btn-sm {{ $estado === 'Estable' ? 'btn-success' : 'btn-outline-secondary' }}">Estable</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- LISTADO DE ANIMALES --}}
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
            <div class="col"><div class="alert alert-info text-center">No hay animales para mostrar.</div></div>
        @endforelse
    </div>
</div>

{{-- ================================================================= --}}
{{--                       MODALES INTEGRADOS                          --}}
{{-- ================================================================= --}}

<div class="modal fade" id="animalDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
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
                        <li class="nav-item"><a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info-content" role="tab">Información General</a></li>
                        <li class="nav-item"><a class="nav-link" id="location-tab" data-bs-toggle="tab" href="#location-content" role="tab">Ubicación</a></li>
                        <li class="nav-item"><a class="nav-link" id="actions-tab" data-bs-toggle="tab" href="#actions-content" role="tab">Acciones</a></li>
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
                        </div></div></div><div class="col-md-7"><img src="{{ asset('imagenes/mapa-placeholder.png') }}" alt="Mapa" class="img-fluid rounded border h-100" style="object-fit: cover;"></div></div>
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

<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 1.5rem;">
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="me-3"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x text-success" style="opacity: 0.1;"></i><i class="fas fa-user-shield fa-stack-1x text-success"></i></span></div>
                    <div><h5 class="modal-title fw-bold">Cambiar Estado de Salud</h5><span class="badge bg-success" id="changeStatusAnimalName">...</span></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <div class="p-3 mb-4 rounded-3" style="background-color: #f8f9fa;">
                    <p class="text-muted mb-2"><i class="fas fa-info-circle text-success me-2"></i>Estado de Salud Actual</p>
                    <span class="badge fs-6 border text-success bg-white py-2 px-3" id="currentStatusBadge">...</span>
                </div>
                <p class="fw-bold text-dark">Nuevo Estado de Salud</p>
                <div class="row g-3">
                    <div class="col-md-6"><label class="status-option"><input type="radio" name="health_status" value="Estable" class="d-none"><div class="status-card"><h6><span class="status-dot bg-warning"></span>Estable</h6><p class="text-muted small">Condición estable.</p></div></label></div>
                    <div class="col-md-6"><label class="status-option"><input type="radio" name="health_status" value="Muy Bueno" class="d-none"><div class="status-card"><h6><span class="status-dot bg-success"></span>Muy Bueno</h6><p class="text-muted small">Excelente condición.</p></div></label></div>
                    <div class="col-md-6"><label class="status-option"><input type="radio" name="health_status" value="Bueno" class="d-none"><div class="status-card"><h6><span class="status-dot bg-primary"></span>Bueno</h6><p class="text-muted small">Buena condición.</p></div></label></div>
                    <div class="col-md-6"><label class="status-option"><input type="radio" name="health_status" value="Malo" class="d-none"><div class="status-card"><h6><span class="status-dot" style="background-color: #fd7e14;"></span>Malo</h6><p class="text-muted small">Requiere atención.</p></div></label></div>
                    <div class="col-md-6"><label class="status-option"><input type="radio" name="health_status" value="Muy Malo" class="d-none"><div class="status-card"><h6><span class="status-dot bg-danger"></span>Muy Malo</h6><p class="text-muted small">Condición crítica.</p></div></label></div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary w-100">Cambiar Estado</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAnimalModal" tabindex="-1" aria-hidden="true">
    {{-- Tu modal para agregar animal va aquí --}}
</div>
@endsection

@section('css')
<style>
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
    .status-option .status-card { padding: 1rem; border: 2px solid #e9ecef; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease-in-out; position: relative; }
    .status-option .status-card:hover { border-color: #adb5bd; }
    .status-option input:checked + .status-card { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25); }
    .status-option input:checked + .status-card::before { content: '✔'; position: absolute; top: 1rem; right: 1rem; color: #0d6efd; font-weight: bold; }
    .status-dot { display: inline-block; width: 12px; height: 12px; border-radius: 50%; margin-right: 0.5rem; vertical-align: middle; }
</style>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- INSTANCIAS DE TODOS LOS MODALES ---
    const animalDetailsModalEl = document.getElementById('animalDetailsModal');
    const changeStatusModalEl = document.getElementById('changeStatusModal');
    const seleccionarRescatistaModalEl = document.getElementById('seleccionarRescatistaModal');
    const agregarAnimalModalEl = document.getElementById('agregarAnimalModal');

    const animalDetailsModal = new bootstrap.Modal(animalDetailsModalEl);
    const changeStatusModal = new bootstrap.Modal(changeStatusModalEl);
    const seleccionarRescatistaModal = new bootstrap.Modal(seleccionarRescatistaModalEl);
    const agregarAnimalModal = new bootstrap.Modal(agregarAnimalModalEl);

    // --- LÓGICA PARA EL FLUJO DE AGREGAR ANIMAL (CORREGIDA) ---

    // Variable para guardar el nombre del rescatista entre eventos
    let nombreRescatistaSeleccionado = null;

    // 1. Escuchamos el clic en CUALQUIER botón "Seleccionar"
    document.querySelectorAll('.btn-seleccionar-rescatista').forEach(button => {
        button.addEventListener('click', function () {
            // Guardamos el nombre del rescatista seleccionado
            nombreRescatistaSeleccionado = this.dataset.rescatistaNombre;
            
            // Y simplemente cerramos el primer modal
            seleccionarRescatistaModal.hide();
        });
    });

    // 2. Escuchamos el evento 'hidden.bs.modal', que se dispara DESPUÉS de que el modal de rescatistas se cierra
    seleccionarRescatistaModalEl.addEventListener('hidden.bs.modal', function () {
        // Si guardamos un nombre (es decir, si se hizo clic en "Seleccionar" y no en la 'X')
        if (nombreRescatistaSeleccionado) {
            // Actualizamos la insignia en el segundo modal
            const rescuerNameBadge = agregarAnimalModalEl.querySelector('#rescuerNameBadge');
            rescuerNameBadge.textContent = `Rescatista: ${nombreRescatistaSeleccionado}`;
            
            // Y AHORA, de forma segura, mostramos el segundo modal
            agregarAnimalModal.show();
            
            // Limpiamos la variable para la próxima vez
            nombreRescatistaSeleccionado = null;
        }
    });

    // --- (El resto de tu código JS para los otros modales no cambia) ---
    animalDetailsModalEl.addEventListener('show.bs.modal', function (event) {
        // ... (código para llenar el modal de detalles)
    });
    if (changeStatusModalEl) {
        changeStatusModalEl.addEventListener('show.bs.modal', function (event) {
            // ... (código para llenar el modal de cambiar estado)
        });
    }

    function updateBadgeClass(element, text, classes) { /* ... */ }
});
</script>
@endsection