@extends('layouts.admin')

@section('title', 'Centros de Animales')

@section('css')
<style>
    :root { --header-offset: 180px; }
    .card-fit .card-body { flex: 1 1 auto; display: flex; flex-direction: column; padding: 0.5rem; }
    #centros-map { height: 420px; border-radius: 8px; border: 1px solid #dee2e6; overflow: hidden; }
    .table-responsive { max-height: 300px; overflow: auto; }
    .table { margin-bottom: 0; }
    .filters .form-group { margin-bottom: .5rem; }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-building text-primary mr-2"></i>
                    Centros de Animales
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Centros</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Sección Centros: acceso y acciones sólo para Administrador -->
<section class="content" data-role-allowed="Administrador">
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-search mr-2"></i>
                    Búsqueda
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" id="btn-nuevo" data-toggle="modal" data-target="#modalCentro" data-role-allowed="Administrador">
                        <i class="fas fa-plus mr-1"></i> Nuevo Centro
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" id="btn-restablecer">
                        <i class="fas fa-rotate-left mr-1"></i> 
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form id="centros-filter-form" action="" method="GET">
                    <div class="row">
                        <!-- Buscar -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search-centros">Buscar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input id="search-centros" type="text" class="form-control" placeholder="Nombre o tipo...">
                                </div>
                            </div>
                        </div>
                        <!-- Zona -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Zona</label>
                                <select id="filter-zona" class="form-control select2" style="width: 100%;">
                                    <option value="">Todas</option>
                                    <option value="Equipetrol">Equipetrol</option>
                                    <option value="Pampa de la Isla">Pampa de la Isla</option>
                                    <option value="Av. Cristo Redentor">Av. Cristo Redentor</option>
                                </select>
                            </div>
                        </div>
                        <!-- Botón Buscar -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search mr-2"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="row layout-fill align-items-stretch">
            <div class="col-lg-5 col-md-6 d-flex">
                <div class="card card-primary card-outline card-fit w-100">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-map-marked-alt mr-2"></i>Mapa de Centros</h3>
                        
                    </div>
                    <div class="card-body">
                        <div id="centros-map"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-6 d-flex">
                <div class="card card-primary card-outline card-fit w-100">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title"><i class="fas fa-list mr-2"></i>Lista de Centros</h3>
                        
                    </div>
                    <div class="card-body">
                        <!-- La tabla se mantiene para gestión rápida -->
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Capacidad</th>
                                        <th>Teléfono</th>
                                        <th>Lat/Lng</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="centros-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Modal Crear/Editar Centro -->
<div class="modal fade" id="modalCentro" tabindex="-1" aria-hidden="true" data-role-allowed="Administrador">
    <div class="modal-dialog modal-lg">
        <form id="form-centro" class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <i class="fas fa-pen-to-square mr-2"></i>
                    <span id="modal-title-text">Nuevo Centro</span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="centro-id">
                <div class="row">
                    <div class="col-md-6">
                        <label class="mb-1">Nombre</label>
                        <!-- Modal Centro: campos con placeholders -->
                        <div class="form-group">
                            <label for="centro-nombre">Nombre del Centro</label>
                            <input type="text" id="centro-nombre" class="form-control" placeholder="Ej. Centro de Rescate Santa Cruz" required>
                        </div>
                        <div class="form-group">
                            <label for="centro-capacidad">Capacidad</label>
                            <input type="number" id="centro-capacidad" class="form-control" placeholder="Ej. 50" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="centro-telefono">Teléfono</label>
                            <input type="text" id="centro-telefono" class="form-control" placeholder="Ej. (3) 123-4567">
                        </div>
                        <div class="form-group">
                            <label for="centro-direccion">Dirección</label>
                            <input type="text" id="centro-direccion" class="form-control" placeholder="Opcional">
                        </div>
                    </div>
                    <!-- lat/lng como inputs ocultos -->
                    <input type="hidden" id="centro-lat">
                    <input type="hidden" id="centro-lng">
                </div>

                <!-- Ubicación del Centro (mapa dentro del formulario) -->
                <div class="card card-primary card-outline mt-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-2"></i>Ubicación del Centro
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            Seleccione la ubicación en el mapa o use su ubicación actual.
                        </div>
                        <button class="btn btn-primary mb-3 w-100" id="btn-ubicacion">
                            <i class="fas fa-location-arrow mr-2"></i>Usar mi ubicación actual
                        </button>
                        <p class="text-center text-muted small mb-2">o haz clic en el mapa para seleccionar la ubicación</p>
                        <div id="modal-centro-map" style="height: 260px; border-radius: 8px; border: 1px solid #dee2e6; overflow: hidden;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-guardar" type="submit" class="btn btn-primary" data-role-allowed="Administrador">
                    <i class="fas fa-save mr-1"></i> Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script>
(function() {
    const SANTA_CRUZ_CENTER = { lat: -17.7833, lng: -63.1821 };
    const SANTA_CRUZ_BOUNDS = { minLat: -17.90, maxLat: -17.70, minLng: -63.26, maxLng: -63.10 };
    function isInSantaCruz(lat, lng) {
        return lat >= SANTA_CRUZ_BOUNDS.minLat && lat <= SANTA_CRUZ_BOUNDS.maxLat &&
               lng >= SANTA_CRUZ_BOUNDS.minLng && lng <= SANTA_CRUZ_BOUNDS.maxLng;
    }

    const defaultCentros = [
        { id: 1, nombre: 'Centro Rescate Equipetrol', tipo: 'Rescate', capacidad: 40, telefono: '(3) 333-1111', lat: -17.7690, lng: -63.1880, direccion: 'Equipetrol' },
        { id: 2, nombre: 'Refugio Pampa de la Isla', tipo: 'Refugio', capacidad: 60, telefono: '(3) 333-2222', lat: -17.7750, lng: -63.1200, direccion: 'Pampa de la Isla' },
        { id: 3, nombre: 'Veterinaria Cristo Redentor', tipo: 'Veterinario', capacidad: 25, telefono: '(3) 333-3333', lat: -17.7600, lng: -63.1700, direccion: 'Av. Cristo Redentor' },
    ];

    let centros = defaultCentros.filter(c => isInSantaCruz(c.lat, c.lng));

    const map = L.map('centros-map').setView([SANTA_CRUZ_CENTER.lat, SANTA_CRUZ_CENTER.lng], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{ attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
    setTimeout(() => map.invalidateSize(), 0);
    window.addEventListener('resize', () => { map.invalidateSize(); });

    const markers = new Map();
    const $tbody = $('#centros-tbody');
    const $search = $('#search-centros');
    const $zona = $('#filter-zona');

    // Renderizar centros en mapa y tabla
    function renderCentros() {
        // borrar marcadores
        markers.forEach(m => map.removeLayer(m));
        markers.clear();
        // borrar tabla
        $tbody.empty();
        // dibujar
        centros.forEach(c => {
            const marker = L.marker([c.lat, c.lng]).addTo(map).bindPopup(`<strong>${c.nombre}</strong><br>${c.direccion}`);
            markers.set(c.id, marker);
            $tbody.append(`
                <tr>
                    <td>${c.nombre}</td>
                    <td>${c.tipo}</td>
                    <td>${c.capacidad}</td>
                    <td>${c.telefono}</td>
                    <td>${c.lat.toFixed(5)}, ${c.lng.toFixed(5)}</td>
                    <td class="text-right">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCentro" data-id="${c.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
        // ajustar vista si hay marcadores
        if (markers.size > 0) {
            const group = L.featureGroup(Array.from(markers.values()));
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }

    function applyFilters() {
        const term = ($search.val() || '').toLowerCase();
        const zona = $zona.val() || '';
        centros = defaultCentros
            .filter(c => isInSantaCruz(c.lat, c.lng))
            .filter(c => !term || c.nombre.toLowerCase().includes(term) || c.tipo.toLowerCase().includes(term))
            .filter(c => !zona || c.direccion === zona);
        renderCentros();
    }

    // Mapa dentro del modal de Centro
    let modalMap = null;
    let modalMarker = null;

    function placeModalMarker(lat, lng) {
        if (modalMarker) {
            modalMarker.setLatLng([lat, lng]);
        } else {
            modalMarker = L.marker([lat, lng]).addTo(modalMap);
        }
        modalMarker.bindPopup('Ubicación seleccionada').openPopup();
    }

    function updateLatLng(lat, lng) {
        $('#centro-lat').val(lat);
        $('#centro-lng').val(lng);
        if (modalMap) {
            placeModalMarker(lat, lng);
            modalMap.setView([lat, lng], 14);
        }
    }

    function initModalMap() {
        const latVal = parseFloat($('#centro-lat').val());
        const lngVal = parseFloat($('#centro-lng').val());
        const hasCoords = Number.isFinite(latVal) && Number.isFinite(lngVal);
        const center = hasCoords ? { lat: latVal, lng: lngVal } : SANTA_CRUZ_CENTER;

        if (!modalMap) {
            modalMap = L.map('modal-centro-map');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(modalMap);

            modalMap.on('click', function(e) {
                updateLatLng(e.latlng.lat, e.latlng.lng);
            });
        }

        modalMap.setView([center.lat, center.lng], hasCoords ? 14 : 12);
        setTimeout(() => modalMap.invalidateSize(), 0);

        if (hasCoords) {
            placeModalMarker(latVal, lngVal);
        } else if (modalMarker) {
            modalMap.removeLayer(modalMarker);
            modalMarker = null;
        }
    }

    $('#modalCentro').on('shown.bs.modal', function() {
        initModalMap();
        setTimeout(() => modalMap.invalidateSize(), 0);
    });

    $('#btn-ubicacion').on('click', function() {
        if (!navigator.geolocation) {
            console.warn('Geolocalización no soportada por el navegador.');
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function(pos) { updateLatLng(pos.coords.latitude, pos.coords.longitude); },
            function() { console.warn('No se pudo obtener la ubicación actual.'); }
        );
    });

    // Restablecer filtros (recargar)
    $('#btn-restablecer').on('click', function() {
        $('#search-centros').val('');
        $('#filter-zona').val('');
        applyFilters();
    });

    // Render inicial
    renderCentros();
})();
</script>
@endsection