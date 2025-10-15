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
<!-- Content Header (Page header) -->
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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Animal Info Card -->
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

        <!-- Location Info -->
        <div class="row">
            <!-- Map -->
            <div class="col-lg-8">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map mr-2"></i>
                            Ubicación del Rescate
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

            <!-- Location Details -->
            <div class="col-lg-4">
                <div class="card card-warning card-outline">
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

                <!-- Actions -->
                
            </div>
        </div>
        <div class="col-md-6 text-right-bottom">
                                <a href="{{ route('animales.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i> Volver a Animales
                                </a>
                </div>

        <!-- Transfer History -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-truck-moving mr-2"></i>
                            Historial de Traslados
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success btn-sm" onclick="mostrarRutaCompleta()">
                                <i class="fas fa-route mr-1"></i> Ver Ruta Completa
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <!-- Transfer 1 -->
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

                            <!-- Transfer 2 -->
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

                            <!-- Transfer 3 -->
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

                            <!-- Transfer 4 -->
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

                            <!-- Current Location -->
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
        </div>

        <!-- Map with Transfer Routes -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-info card-outline">
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
</section>
@endsection

@section('js')
<script>
// Variables globales para los mapas
var mapaUbicacion = null;
var marcadorUbicacion = null;
var mapaTraslados = null;
var marcadoresTraslados = [];
var rutasTraslados = [];

// Datos hardcodeados de traslados
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

// Función para obtener ubicación actual
function obtenerMiUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            
            // Centrar el mapa en la ubicación actual
            mapaUbicacion.setView([lat, lng], 15);
            
            // Agregar marcador de ubicación actual
            if (marcadorUbicacion) {
                mapaUbicacion.removeLayer(marcadorUbicacion);
            }
            marcadorUbicacion = L.marker([lat, lng]).addTo(mapaUbicacion);
            
            console.log('Ubicación actual:', lat, lng);
        }, function(error) {
            console.error('Error al obtener ubicación:', error);
            alert('No se pudo obtener tu ubicación actual.');
        });
    } else {
        alert('La geolocalización no está disponible en este navegador.');
    }
}

// Función para mostrar todos los puntos de traslado
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
    
    // Ajustar vista para mostrar todos los puntos
    var grupo = new L.featureGroup(marcadoresTraslados);
    mapaTraslados.fitBounds(grupo.getBounds().pad(0.1));
}

// Función para mostrar la ruta completa
function mostrarRutaCompleta() {
    limpiarMapa();
    mostrarTodosLosPuntos();
    
    // Crear puntos para la ruta
    var puntosRuta = trasladosData.map(function(traslado) {
        return [traslado.lat, traslado.lng];
    });
    
    // Crear la ruta usando una línea
    var ruta = L.polyline(puntosRuta, {
        color: '#3388ff',
        weight: 4,
        opacity: 0.8,
        dashArray: '10, 10'
    }).addTo(mapaTraslados);
    
    rutasTraslados.push(ruta);
    
    // Agregar flechas direccionales
    for (var i = 0; i < puntosRuta.length - 1; i++) {
        var puntoInicio = puntosRuta[i];
        var puntoFin = puntosRuta[i + 1];
        
        // Calcular ángulo
        var angulo = Math.atan2(puntoFin[1] - puntoInicio[1], puntoFin[0] - puntoInicio[0]) * 180 / Math.PI;
        
        // Crear flecha
        var flecha = L.divIcon({
            className: 'custom-div-icon',
            html: `<div style="transform: rotate(${angulo}deg); color: #3388ff; font-size: 20px;"><i class="fas fa-arrow-right"></i></div>`,
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        });
        
        // Posición intermedia para la flecha
        var latIntermedia = (puntoInicio[0] + puntoFin[0]) / 2;
        var lngIntermedia = (puntoInicio[1] + puntoFin[1]) / 2;
        
        L.marker([latIntermedia, lngIntermedia], {icon: flecha}).addTo(mapaTraslados);
    }
    
    // Mostrar información de la ruta
    var distanciaTotal = calcularDistanciaTotal();
    var tiempoTotal = calcularTiempoTotal();
    
    // Agregar información de la ruta al mapa
    var infoRuta = L.control({position: 'topright'});
    infoRuta.onAdd = function(map) {
        var div = L.DomUtil.create('div', 'info-ruta');
        div.innerHTML = `
            <div style="background: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                <h6><i class="fas fa-route"></i> Información de la Ruta</h6>
                <p><strong>Distancia Total:</strong> ${distanciaTotal} km</p>
                <p><strong>Tiempo Total:</strong> ${tiempoTotal}</p>
                <p><strong>Traslados:</strong> ${trasladosData.length - 1}</p>
            </div>
        `;
        return div;
    };
    infoRuta.addTo(mapaTraslados);
}

// Función para limpiar el mapa
function limpiarMapa() {
    marcadoresTraslados.forEach(function(marcador) {
        mapaTraslados.removeLayer(marcador);
    });
    rutasTraslados.forEach(function(ruta) {
        mapaTraslados.removeLayer(ruta);
    });
    marcadoresTraslados = [];
    rutasTraslados = [];
    
    // Limpiar controles personalizados
    mapaTraslados.eachLayer(function(layer) {
        if (layer instanceof L.Control) {
            mapaTraslados.removeControl(layer);
        }
    });
}

// Función para calcular distancia total
function calcularDistanciaTotal() {
    var distanciaTotal = 0;
    for (var i = 0; i < trasladosData.length - 1; i++) {
        var punto1 = trasladosData[i];
        var punto2 = trasladosData[i + 1];
        distanciaTotal += calcularDistanciaEntrePuntos(punto1.lat, punto1.lng, punto2.lat, punto2.lng);
    }
    return distanciaTotal.toFixed(1);
}

// Función para calcular tiempo total
function calcularTiempoTotal() {
    // Tiempo hardcodeado basado en los datos
    return "1 hora 35 minutos";
}

// Función para calcular distancia entre dos puntos (fórmula de Haversine)
function calcularDistanciaEntrePuntos(lat1, lng1, lat2, lng2) {
    var R = 6371; // Radio de la Tierra en km
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLng = (lng2 - lng1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLng/2) * Math.sin(dLng/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
}

$(document).ready(function() {
    // Inicializar mapa de ubicación
    mapaUbicacion = L.map('mapaUbicacion').setView([-17.7833, -63.1833], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapaUbicacion);
    
    // Agregar marcador de la ubicación del rescate
    marcadorUbicacion = L.marker([-17.7833, -63.1833]).addTo(mapaUbicacion);
    marcadorUbicacion.bindPopup('<b>Ubicación del Rescate</b><br>Sada - Labrador<br>01/09/2025');
    
    // Inicializar mapa de traslados
    mapaTraslados = L.map('mapaTraslados').setView([-17.7900, -63.1900], 12);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapaTraslados);
    
    // Mostrar todos los puntos por defecto
    mostrarTodosLosPuntos();
});
</script>
@endsection
