@extends('layouts.admin')

@section('title', 'Ver Ubicación - Rescate Animales')

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

        <!-- Additional Info -->
       
    </div>
</section>
@endsection

@section('js')
<script>
// Variables globales para el mapa
var mapaUbicacion = null;
var marcadorUbicacion = null;

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

// Función para abrir en Google Maps
function abrirEnGoogleMaps() {
    var lat = -17.7833;
    var lng = -63.1833;
    var url = `https://www.google.com/maps?q=${lat},${lng}`;
    window.open(url, '_blank');
}

// Función para copiar coordenadas
function copiarCoordenadas() {
    var coordenadas = "-17.7833, -63.1833";
    navigator.clipboard.writeText(coordenadas).then(function() {
        alert('Coordenadas copiadas al portapapeles');
    });
}

// Función para compartir ubicación
function compartirUbicacion() {
    if (navigator.share) {
        navigator.share({
            title: 'Ubicación del Rescate - Sada',
            text: 'Ubicación donde fue rescatado el animal Sada',
            url: window.location.href
        });
    } else {
        alert('Función de compartir no disponible en este navegador');
    }
}

$(document).ready(function() {
    // Inicializar mapa
    mapaUbicacion = L.map('mapaUbicacion').setView([-17.7833, -63.1833], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapaUbicacion);
    
    // Agregar marcador de la ubicación del rescate
    marcadorUbicacion = L.marker([-17.7833, -63.1833]).addTo(mapaUbicacion);
    marcadorUbicacion.bindPopup('<b>Ubicación del Rescate</b><br>Sada - Labrador<br>01/09/2025');
});
</script>
@endsection
