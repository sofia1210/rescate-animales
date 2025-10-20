@extends('layouts.admin')

@section('title', 'Dar en Adopción o Liberar Animales')

@section('css')
    <style>
        #mapaAdopcion {
            height: 300px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
@endsection

@php
    $animales = collect([
        (object)[
            'id' => 1,
            'nombre' => 'Lorito',
            'especie' => 'Ave',
            'raza' => 'Loro',
            'estado_salud' => 'Muy Bueno',
            'tipo' => 'Silvestre',
            'imagen' => asset('Fotos/R.jpg'),
        ],
        (object)[
            'id' => 2,
            'nombre' => 'Jaguarcito',
            'especie' => 'Felino',
            'raza' => 'Jaguar',
            'estado_salud' => 'Bueno',
            'tipo' => 'Silvestre',
            'imagen' => asset('Fotos/OIP.jpg'),
        ],
        (object)[
            'id' => 3,
            'nombre' => 'Max',
            'especie' => 'Canino',
            'raza' => 'Golden Retriever',
            'estado_salud' => 'Excelente',
            'tipo' => 'Doméstico',
            'imagen' => asset('Fotos/Patota.png'),
        ],
    ]);
@endphp

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-hand-holding-heart text-primary mr-2"></i>
                    Dar en Adopción o Liberar
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Adopciones</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Mantener liberación sólo Admin (ya configurado) y permitir búsqueda/listado para Ciudadano/Admin -->
<section class="content" data-role-allowed="Ciudadano,Veterinario,Administrador">
    <div class="container-fluid">

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-search mr-2"></i>
                Búsqueda
            </h3>
            <div class="card-tools">
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
                                       value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo de Animal</label>
                            <select name="tipo" class="form-control select2" style="width: 100%;">
                                <option value="Todos">Todos los tipos</option>
                                <option value="Doméstico">Doméstico</option>
                                <option value="Silvestre">Silvestre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Estado de Salud</label>
                            <select name="estado" class="form-control select2" style="width: 100%;">
                                <option value="Todos">Todos los estados</option>
                                <option value="Muy Bueno">Excelente</option>
                                <option value="Bueno">Bueno</option>
                                <option value="Estable">Estable</option>
                                <option value="Malo">Malo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="d-flex gap-">
                                <!-- Botón Buscar sin ícono -->
                                <button type="submit" class="btn btn-primary flex-fill">
                                    Buscar
                                </button>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse ($animales as $animal)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        
                        
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{ $animal->imagen }}" 
                                 class="img-fluid rounded" 
                                 alt="Foto de {{ $animal->nombre }}" 
                                 style="height: 200px; width: 100%;width: 85%; justify-content: center; display: block; margin: 0 auto; margin-top: 20px;">
                        </div>
                        
                        <h5 class="card-title fw-bold">{{ $animal->nombre }}</h5>
                        <p class="card-text mb-1"><strong>Especie:</strong> {{ $animal->especie }}</p>
                        <p class="card-text mb-1"><strong>Tipo:</strong> {{ $animal->tipo }}</p>
                    
                    </div>
                    <!-- Botón Liberar: usar Bootstrap 4 -->
                    <div class="card-footer">
                        @php
                            $esDomestico = $animal->tipo === 'Doméstico';
                            $btnClass = $esDomestico ? 'btn-success' : 'btn-primary';
                            $btnText = $esDomestico ? 'Dar en Adopción' : 'Liberar';
                        @endphp
                        <button type="button"
                                class="btn {{ $btnClass }} btn-block liberar-btn"
                                data-toggle="modal"
                                data-target="#liberarAnimalModal"
                                data-id="{{ $animal->id }}"
                                data-nombre="{{ $animal->nombre }}"
                                data-tipo="{{ $animal->tipo }}"
                                data-role-allowed="Administrador,Veterinario">
                            {{ $btnText }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay animales disponibles</h5>
                        <p class="text-muted">No se encontraron animales para mostrar en este momento.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    </div>
    </section>

<!-- Modal Liberar/Adoptar Animal -->
<div class="modal fade" id="liberarAnimalModal" tabindex="-1" aria-hidden="true" data-role-allowed="Administrador,Veterinario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">
                    <i class="fas fa-home mr-2 icon-domestico d-none"></i>
                    <i class="fas fa-dove mr-2 icon-salvaje"></i>
                    <span id="modalTitleText">Liberar</span>
                </h4>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modalAnimalTipo" value="">
                <div class="card card-info card-outline mb-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-paw mr-2"></i><span id="modalSubtitleText">Animal a Liberar</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <dl class="row">
                                    <dt class="col-sm-4">Nombre:</dt>
                                    <dd class="col-sm-8"><span id="modalAnimalNameBadge" class="badge bg-primary">...</span></dd>
                                    <dt class="col-sm-4">Estado:</dt>
                                    <dd class="col-sm-8"><span class="badge bg-success">Listo para liberación</span></dd>
                                </dl>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-dove fa-3x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ubicación de Liberación -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-2"></i>Ubicación de Liberación
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Importante:</strong> Seleccione la ubicación exacta donde será liberado el animal.
                        </div>

                        <!-- Botón Usar mi ubicación actual sin ícono -->
                        <button class="btn btn-primary mb-3 w-100" onclick="obtenerUbicacionAdopcion()">
                            Usar mi ubicación actual
                        </button>

                        <p class="text-center text-muted small mb-3">o haz clic en el mapa para seleccionar la ubicación</p>

                        <!-- Contenedor del mapa -->
                        <div id="mapaAdopcion"></div>
                        
                        <!-- Controles del mapa -->
                        <div class="mt-3">
                            <small class="text-muted">Haz clic en el mapa para marcar la ubicación</small>
                        </div>

                        <!-- Inputs ocultos de ubicación -->
                        <input type="hidden" id="latitud_adopcion" name="latitud_adopcion">
                        <input type="hidden" id="longitud_adopcion" name="longitud_adopcion">
                    </div>
                </div>
            </div>

            <!-- Confirmar: cierre BS4 -->
            <div class="modal-footer justify-content-end">
                <!-- Footer del modal: Confirmar Liberación sin icono -->
                <button type="button" class="btn btn-success" id="confirmarLiberacion" data-dismiss="modal">
                    Confirmar Liberación
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
let mapaAdopcion = null;
let marcadorAdopcion = null;
let googleMapsLoaded = false;

// Función para cargar el API de Google Maps
function loadGoogleMaps() {
    if (typeof google !== 'undefined' && google.maps) {
        googleMapsLoaded = true;
        initMapCallback();
        return;
    }
    const script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBNs42Rt_CyxAqdbIBK0a5Ut83QiitVrOs&callback=initMapCallback';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
}

// Callback que se ejecutará cuando el API esté cargado
window.initMapCallback = function() {
    googleMapsLoaded = true;
    console.log('Google Maps API cargado correctamente');
    if ($('#liberarAnimalModal').is(':visible')) {
        initMapaAdopcion();
    }
};

// Cargar el API cuando el documento esté listo
$(document).ready(loadGoogleMaps);
</script>
<script>
// Actualizar interfaz del modal según tipo de animal
    function actualizarModalSegunTipo(tipo) {
        if (tipo === 'Doméstico') {
            $('.icon-domestico').removeClass('d-none');
            $('.icon-salvaje').addClass('d-none');
            $('#modalTitleText').text('Dar en Adopción');
            $('#modalSubtitleText').text('Animal a dar en Adopción');
            $('#modalAnimalTipo').val(tipo);
        } else {
            $('.icon-domestico').addClass('d-none');
            $('.icon-salvaje').removeClass('d-none');
            $('#modalTitleText').text('Liberar');
            $('#modalSubtitleText').text('Animal a Liberar');
            $('#modalAnimalTipo').val(tipo);
    let mapaAdopcion = null;
let marcadorAdopcion = null;

function initMapaAdopcion() {
    try {
        // Verificar si el API está cargado
        if (!googleMapsLoaded || typeof google === 'undefined') {
            console.log('Google Maps API no está cargado aún');
            return;
        }

        const container = document.getElementById('mapaAdopcion');
        if (!container) {
            console.error('Contenedor #mapaAdopcion no encontrado');
            return;
        }

        // Limpiar instancia previa si existe
        if (mapaAdopcion) {
            return;
        }

        console.log('Inicializando mapa...');

        // Obtener coordenadas previas si existen
        const lat = parseFloat(document.getElementById('latitud_adopcion').value) || -17.7833;
        const lng = parseFloat(document.getElementById('longitud_adopcion').value) || -63.1833;
        const initialPosition = { lat: lat, lng: lng };

        // Opciones del mapa
        const mapOptions = {
            center: initialPosition,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            fullscreenControl: false,
            mapTypeControl: false,
            gestureHandling: 'greedy'
        };

        // Crear nuevo mapa
        mapaAdopcion = new google.maps.Map(container, mapOptions);

        // Crear marcador inicial
        marcadorAdopcion = new google.maps.Marker({
            position: initialPosition,
            map: mapaAdopcion,
            draggable: true,
            animation: google.maps.Animation.DROP
        });

        // Evento de clic en el mapa
        mapaAdopcion.addListener('click', function(event) {
            const latLng = event.latLng;
            marcadorAdopcion.setPosition(latLng);
            
            // Actualizar campos ocultos
            document.getElementById('latitud_adopcion').value = latLng.lat();
            document.getElementById('longitud_adopcion').value = latLng.lng();
        });

        // Evento de arrastre del marcador
        marcadorAdopcion.addListener('dragend', function() {
            const latLng = marcadorAdopcion.getPosition();
            document.getElementById('latitud_adopcion').value = latLng.lat();
            document.getElementById('longitud_adopcion').value = latLng.lng();
        });

        // Forzar redibujado del mapa
        google.maps.event.trigger(mapaAdopcion, 'resize');
        mapaAdopcion.setCenter(initialPosition);

        console.log('Mapa inicializado correctamente');

    } catch (error) {
        console.error('Error al inicializar el mapa:', error);
    }
}

function obtenerUbicacionAdopcion() {
    if (!navigator.geolocation) {
        alert('Tu navegador no soporta geolocalización');
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const latLng = new google.maps.LatLng(lat, lng);

            if (!mapaAdopcion) initMapaAdopcion();

            // Centrar mapa en la ubicación actual
            mapaAdopcion.setCenter(latLng);
            mapaAdopcion.setZoom(15);
            
            // Actualizar posición del marcador
            marcadorAdopcion.setPosition(latLng);

            // Actualizar campos ocultos
            document.getElementById('latitud_adopcion').value = lat;
            document.getElementById('longitud_adopcion').value = lng;

            // Mostrar mensaje de confirmación
            const infoWindow = new google.maps.InfoWindow({
                content: 'Ubicación actual'
            });
            infoWindow.open(mapaAdopcion, marcadorAdopcion);
            setTimeout(() => infoWindow.close(), 2000);
        },
        function(error) {
            console.warn('Error al obtener la ubicación:', error.message);
            alert('No se pudo obtener tu ubicación. Por favor, marca la ubicación manualmente en el mapa.');
        }
    );
}

// Manejar eventos del modal con mejor logging
$('#liberarAnimalModal').on('show.bs.modal', function(e) {
    const button = $(e.relatedTarget);
    const tipo = button.data('tipo');
    const nombre = button.data('nombre');
    const id = button.data('id');
    
    $('#modalAnimalTipo').val(tipo);
    $('#modalAnimalNameBadge').text(nombre);
    actualizarModalSegunTipo(tipo);
});

// Inicializar mapa después de que el modal esté completamente visible
$('#liberarAnimalModal').on('shown.bs.modal', function() {
    if (!googleMapsLoaded) {
        console.log('Cargando Google Maps API...');
        loadGoogleMaps();
        return;
    }

    setTimeout(function() {
        const mapContainer = document.getElementById('mapaAdopcion');
        if (!mapContainer) {
            console.error('Contenedor del mapa no encontrado');
            return;
        }

        initMapaAdopcion();
        
        if (mapaAdopcion) {
            const lat = parseFloat($('#latitud_adopcion').val()) || -17.7833;
            const lng = parseFloat($('#longitud_adopcion').val()) || -63.1833;
            const latLng = new google.maps.LatLng(lat, lng);
            
            google.maps.event.trigger(mapaAdopcion, 'resize');
            mapaAdopcion.setCenter(latLng);
            mapaAdopcion.setZoom(15);
            if (marcadorAdopcion) {
                marcadorAdopcion.setPosition(latLng);
            }
        }
    }, 300);
});

$('#confirmarLiberacion').on('click', function() {
    $('#liberarAnimalModal').modal('hide');
});
</script>
