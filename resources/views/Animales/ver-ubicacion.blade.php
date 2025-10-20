@extends('layouts.admin')

@section('title', 'Ver Ubicación - Rescate Animales')

@section('css')
<style>
    
    .timeline {
        position: relative;
        padding: 0;
        list-style: none;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 40px;
        width: 2px;
        margin-left: -1.5px;
        background-color: #e9ecef;
    }
    
    .timeline > li {
        position: relative;
        margin-bottom: 50px;
        min-height: 50px;
    }
    
    .timeline > li:before,
    .timeline > li:after {
        content: "";
        display: table;
    }
    
    .timeline > li:after {
        clear: both;
    }
    
    .timeline > li > .timeline-item {
        margin-left: 60px;
        margin-right: 15px;
        padding: 0;
        position: relative;
        background: #fff;
        border-radius: 0.25rem;
        padding: 20px;
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    }
    
    .timeline > li > .timeline-item > .time {
        color: #999;
        font-size: 0.875rem;
        float: right;
    }
    
    .timeline > li > .timeline-item > .timeline-header {
        margin: 0 0 10px 0;
        font-size: 1rem;
        font-weight: 600;
        color: #495057;
    }
    
    .timeline > li > .timeline-item > .timeline-body {
        padding: 0;
    }
    
    .timeline > li > i {
        position: absolute;
        left: 15px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        font-size: 1.2rem;
        color: #fff;
        z-index: 100;
    }
    
    .time-label > span {
        font-weight: 600;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        font-size: 0.75rem;
    }
    
    .custom-div-icon {
        background: transparent !important;
        border: none !important;
    }
    
    .info-ruta {
        font-size: 0.875rem;
    }
    
    .info-ruta h6 {
        margin-bottom: 10px;
        color: #495057;
    }
    
    .info-ruta p {
        margin-bottom: 5px;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                    Ver Ubicación
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('animales.index') }}">Animales</a></li>
                    <li class="breadcrumb-item active">Ver Ubicación</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-paw mr-2"></i>
                    Información del Animal
                </h3> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="{{ asset('Fotos/OIP.jpg') }}" class="img-fluid rounded" style="max-height: 150px;" alt="Foto del animal">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="text-primary mb-3">Sada</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Especie:</strong> Canino</p>
                                <p><strong>Raza:</strong> Labrador</p>
                                <p><strong>Rescatista:</strong> Rescatista Temporal</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Fecha de Rescate:</strong> 01/09/2025</p>
                                <p><strong>Estado:</strong> <span class="badge badge-secondary">Malo</span></p>
                                <p><strong>Tipo:</strong> <span class="badge badge-success">Doméstico</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="ubicacion-actual-tab" data-toggle="tab" href="#ubicacion-actual" role="tab" aria-controls="ubicacion-actual" aria-selected="true">
                                    <i class="fas fa-map mr-1"></i> Ubicación Actual
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="historial-traslados-tab" data-toggle="tab" href="#historial-traslados" role="tab" aria-controls="historial-traslados" aria-selected="false">
                                    <i class="fas fa-truck-moving mr-1"></i> Historial de Traslados
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="mapa-traslados-tab" data-toggle="tab" href="#mapa-traslados" role="tab" aria-controls="mapa-traslados" aria-selected="false">
                                    <i class="fas fa-route mr-1"></i> Mapa de Ruta
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            
                            <div class="tab-pane fade show active" id="ubicacion-actual" role="tabpanel" aria-labelledby="ubicacion-actual-tab">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card card-info card-outline mb-0">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    Punto de Rescate
                                                </h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="obtenerMiUbicacion()">
                                                        <i class="fas fa-location-arrow mr-1"></i> Mi Ubicación
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="mapaUbicacion" style="height: 400px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card card-warning card-outline mb-0">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-info-circle mr-2"></i>
                                                    Detalles de Ubicación
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-primary">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Dirección</span>
                                                        <span class="info-box-number">Calle Paitití, Centro</span>
                                                    </div>
                                                </div>

                                                <div class="info-box">
                                                    <span class="info-box-icon bg-success">
                                                        <i class="fas fa-city"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Ciudad</span>
                                                        <span class="info-box-number">Santa Cruz De La Sierra</span>
                                                    </div>
                                                </div>

                                                <div class="info-box">
                                                    <span class="info-box-icon bg-info">
                                                        <i class="fas fa-map"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Coordenadas</span>
                                                        <span class="info-box-number">-17.7833, -63.1833</span>
                                                    </div>
                                                </div>

                                                <div class="info-box">
                                                    <span class="info-box-icon bg-warning">
                                                        <i class="fas fa-map-pin"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Zona</span>
                                                        <span class="info-box-number">Centro Urbano</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="historial-traslados" role="tabpanel" aria-labelledby="historial-traslados-tab">
                                <div class="card card-success card-outline mb-0">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-history mr-2"></i>
                                            Cronología del Rescate
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-success btn-sm" onclick="cambiarATabRuta()">
                                                <i class="fas fa-route mr-1"></i> Ver Ruta Completa
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline">
                                            <div class="time-label">
                                                <span class="bg-primary">01/09/2025</span>
                                            </div>
                                            <div>
                                                <i class="fas fa-map-marker-alt bg-primary"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 08:30</span>
                                                    <h3 class="timeline-header">Punto de Rescate</h3>
                                                    <div class="timeline-body">
                                                        <p><strong>Ubicación:</strong> Calle Paitití, Centro, Santa Cruz</p>
                                                        <p><strong>Rescatista:</strong> Rescatista Temporal</p>
                                                        <p><strong>Estado:</strong> Animal encontrado en mal estado</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <i class="fas fa-truck bg-warning"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 09:15</span>
                                                    <h3 class="timeline-header">Traslado al Centro Veterinario</h3>
                                                    <div class="timeline-body">
                                                        <p><strong>Desde:</strong> Calle Paitití, Centro</p>
                                                        <p><strong>Hasta:</strong> Clínica Veterinaria "San Roque"</p>
                                                        <p><strong>Duración:</strong> 25 minutos</p>
                                                        <p><strong>Distancia:</strong> 3.2 km</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <i class="fas fa-hospital bg-info"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 10:00</span>
                                                    <h3 class="timeline-header">Evaluación Médica</h3>
                                                    <div class="timeline-body">
                                                        <p><strong>Ubicación:</strong> Clínica Veterinaria "San Roque"</p>
                                                        <p><strong>Veterinario:</strong> Dr. Carlos Mendoza</p>
                                                        <p><strong>Diagnóstico:</strong> Deshidratación y desnutrición</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <i class="fas fa-truck bg-warning"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 14:30</span>
                                                    <h3 class="timeline-header">Traslado al Refugio</h3>
                                                    <div class="timeline-body">
                                                        <p><strong>Desde:</strong> Clínica Veterinaria "San Roque"</p>
                                                        <p><strong>Hasta:</strong> Refugio "Patitas Felices"</p>
                                                        <p><strong>Duración:</strong> 35 minutos</p>
                                                        <p><strong>Distancia:</strong> 8.7 km</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <i class="fas fa-home bg-success"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> 15:05</span>
                                                    <h3 class="timeline-header">Ubicación Actual</h3>
                                                    <div class="timeline-body">
                                                        <p><strong>Ubicación:</strong> Refugio "Patitas Felices"</p>
                                                        <p><strong>Estado:</strong> En recuperación</p>
                                                        <p><strong>Cuidador:</strong> María González</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mapa-traslados" role="tabpanel" aria-labelledby="mapa-traslados-tab">
                                <div class="card card-info card-outline mb-0">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-route mr-2"></i>
                                            Mapa de Traslados
                                        </h3>
                                        <div class="card-tools">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm" onclick="mostrarTodosLosPuntos()">
                                                    <i class="fas fa-eye mr-1"></i> Todos los Puntos
                                                </button>
                                                <button type="button" class="btn btn-success btn-sm" onclick="mostrarRutaCompleta()">
                                                    <i class="fas fa-route mr-1"></i> Ver Ruta
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="limpiarMapa()">
                                                    <i class="fas fa-eraser mr-1"></i> Limpiar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="mapaTraslados" style="height: 500px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="info-box bg-primary">
                                                        <span class="info-box-icon"><i class="fas fa-map-marker-alt"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Punto de Rescate</span>
                                                            <span class="info-box-number">1</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-box bg-warning">
                                                        <span class="info-box-icon"><i class="fas fa-truck"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Traslados</span>
                                                            <span class="info-box-number">2</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-box bg-info">
                                                        <span class="info-box-icon"><i class="fas fa-hospital"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Centros Médicos</span>
                                                            <span class="info-box-number">1</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-box bg-success">
                                                        <span class="info-box-icon"><i class="fas fa-home"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Ubicación Actual</span>
                                                            <span class="info-box-number">1</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Controles en Mapa de Traslados -->
            <div class="row mb-2">
                <div class="col-12 text-right">
                    <button type="button"
                            class="btn btn-success"
                            id="btn-actualizar-traslados"
                            data-role-allowed="Veterinario,Administrador">
                        <i class="fas fa-sync-alt mr-1"></i> Actualizar Traslados
                    </button>
                </div>
            </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('animales.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a Animales
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<!-- Leaflet Routing Machine -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>

var mapaUbicacion = null;
var marcadorUbicacion = null;
var mapaTraslados = null;
var marcadoresTraslados = [];
var rutasTraslados = [];
var controlRuta = null;

var dibujarRutaAlAbrirMapa = false;

var trasladosData = [
    {
        id: 1,
        nombre: "Punto de Rescate",
        lat: -17.7833,
        lng: -63.1833,
        tipo: "rescate",
        icono: "fas fa-map-marker-alt",
        color: "red",
        descripcion: "Calle Paitití, Centro, Santa Cruz",
        fecha: "01/09/2025 08:30",
        detalles: "Animal encontrado en mal estado"
    },
    {
        id: 2,
        nombre: "Clínica Veterinaria San Roque",
        lat: -17.7900,
        lng: -63.1900,
        tipo: "veterinario",
        icono: "fas fa-hospital",
        color: "blue",
        descripcion: "Av. Cañoto, Zona Norte",
        fecha: "01/09/2025 10:00",
        detalles: "Evaluación médica - Dr. Carlos Mendoza"
    },
    {
        id: 3,
        nombre: "Refugio Patitas Felices",
        lat: -17.8000,
        lng: -63.2000,
        tipo: "refugio",
        icono: "fas fa-home",
        color: "green",
        descripcion: "Zona Sur, Barrio Los Pozos",
        fecha: "01/09/2025 15:05",
        detalles: "Ubicación actual - Cuidador: María González"
    }
];

function obtenerMiUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            
            mapaUbicacion.setView([lat, lng], 15);
            
            if (marcadorUbicacion) {
                mapaUbicacion.removeLayer(marcadorUbicacion);
            }
            marcadorUbicacion = L.marker([lat, lng]).addTo(mapaUbicacion);
            marcadorUbicacion.bindPopup('<b>Mi Ubicación Actual</b>').openPopup(); 
        }, function(error) {
            console.error('Error al obtener ubicación:', error);
            alert('No se pudo obtener tu ubicación actual.');
        });
    } else {
        alert('La geolocalización no está disponible en este navegador.');
    }
}

function mostrarTodosLosPuntos() {
    limpiarMapa();
    
    trasladosData.forEach(function(traslado) {
        var icono = L.divIcon({
            className: 'custom-div-icon',
            html: `<div style="background-color: ${traslado.color}; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px;"><i class="${traslado.icono}"></i></div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });
        
        var marcador = L.marker([traslado.lat, traslado.lng], {icon: icono}).addTo(mapaTraslados);
        
        marcador.bindPopup(`
            <div style="min-width: 200px;">
                <h6><i class="${traslado.icono}"></i> ${traslado.nombre}</h6>
                <p><strong>Fecha:</strong> ${traslado.fecha}</p>
                <p><strong>Dirección:</strong> ${traslado.descripcion}</p>
                <p><strong>Detalles:</strong> ${traslado.detalles}</p>
            </div>
        `);
        
        marcadoresTraslados.push(marcador);
    });
    
    var grupo = new L.featureGroup(marcadoresTraslados);
    mapaTraslados.fitBounds(grupo.getBounds().pad(0.1));
}

function mostrarRutaCompleta() {
    limpiarMapa();
    mostrarTodosLosPuntos();
    
    
    var waypoints = trasladosData.map(function(traslado) {
        return L.latLng(traslado.lat, traslado.lng);
    });
    
    
    controlRuta = L.Routing.control({
        waypoints: waypoints,
        routeWhileDragging: false,
        createMarker: function() { return null; }, 
        lineOptions: {
            styles: [{ 
                color: '#007bff', 
                weight: 4, 
                opacity: 0.8,
                dashArray: '10, 10'
            }]
        },
        addWaypoints: false,
        draggableWaypoints: false,
        fitSelectedRoutes: true,
        show: false, 
        collapsible: false
    }).addTo(mapaTraslados);
    
    
    var infoRuta = L.control({position: 'topright'});
    infoRuta.onAdd = function(map) {
        var div = L.DomUtil.create('div', 'info-ruta');
        div.innerHTML = `
            <div style="background: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                <h6><i class="fas fa-route"></i> Información de la Ruta</h6>
                <p><strong>Puntos de Traslado:</strong> ${trasladosData.length}</p>
                <p><strong>Ruta entre calles:</strong> Activada</p>
            </div>
        `;
        return div;
    };
    infoRuta.addTo(mapaTraslados);
    
    
    setTimeout(function() {
        if (controlRuta.getPlan()) {
            var bounds = controlRuta.getPlan().getBounds();
            if (bounds.isValid()) {
                mapaTraslados.fitBounds(bounds, { padding: [20, 20] });
            }
        }
    }, 1000);
}

function limpiarMapa() {
    marcadoresTraslados.forEach(function(marcador) {
        mapaTraslados.removeLayer(marcador);
    });
    rutasTraslados.forEach(function(ruta) {
        mapaTraslados.removeLayer(ruta);
    });
    marcadoresTraslados = [];
    rutasTraslados = [];
    
    if (controlRuta) {
        mapaTraslados.removeControl(controlRuta);
        controlRuta = null;
    }
    
    mapaTraslados.eachLayer(function(layer) {
        if (layer instanceof L.Control) {
            mapaTraslados.removeControl(layer);
        }
    });
}

function calcularDistanciaTotal() {
    var distanciaTotal = 0;
    for (var i = 0; i < trasladosData.length - 1; i++) {
        var punto1 = trasladosData[i];
        var punto2 = trasladosData[i + 1];
        distanciaTotal += calcularDistanciaEntrePuntos(punto1.lat, punto1.lng, punto2.lat, punto2.lng);
    }
    return distanciaTotal.toFixed(1);
}

function calcularTiempoTotal() {
    return "1 hora 35 minutos";
}

function calcularDistanciaEntrePuntos(lat1, lng1, lat2, lng2) {
    var R = 6371; 
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLng = (lng2 - lon1) * Math.PI / 180; 
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLng/2) * Math.sin(dLng/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
}

function calculateBearing(lat1, lon1, lat2, lon2) {
    lat1 = lat1 * Math.PI / 180;
    lon1 = lon1 * Math.PI / 180;
    lat2 = lat2 * Math.PI / 180;
    lon2 = lon2 * Math.PI / 180;

    var dLon = lon2 - lon1;
    var y = Math.sin(dLon) * Math.cos(lat2);
    var x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dLon);
    var brng = Math.atan2(y, x);

    brng = brng * 180 / Math.PI;
    return (brng + 360) % 360; 
}

function cambiarATabRuta() {
    
    dibujarRutaAlAbrirMapa = true;
    
    
    $('#mapa-traslados-tab').tab('show');
}

$(document).ready(function() {
    
    mapaUbicacion = L.map('mapaUbicacion').setView([-17.7833, -63.1833], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapaUbicacion);
    marcadorUbicacion = L.marker([-17.7833, -63.1833]).addTo(mapaUbicacion);
    marcadorUbicacion.bindPopup('<b>Ubicación del Rescate</b><br>Sada - Labrador<br>01/09/2025');
    
    
    mapaTraslados = L.map('mapaTraslados', {
        zoomControl: true,
        scrollWheelZoom: true
    }).setView([-17.7900, -63.1900], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapaTraslados);
    
    
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        
        if (target === '#mapa-traslados') {
            
            mapaTraslados.invalidateSize();
            
            
            if (dibujarRutaAlAbrirMapa) {
                mostrarRutaCompleta();
                dibujarRutaAlAbrirMapa = false; 
            } else {
                
                mostrarTodosLosPuntos(); 
            }
        } else if (target === '#ubicacion-actual') {
            
            mapaUbicacion.invalidateSize();
            mapaUbicacion.setView([-17.7833, -63.1833], 13);
        }
    });

    
    mostrarTodosLosPuntos(); 
});
</script>
@endsection

@section('js')
<script>
// Inicializar tabs
$(document).ready(function() {
    $('#custom-tabs-three-tab a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>

<style>
.nav-tabs .nav-link {
    border: 0;
    border-bottom: 3px solid transparent;
}
.nav-tabs .nav-link.active {
    border-bottom-color: #28a745;
    color: #28a745;
}
</style>
@endsection