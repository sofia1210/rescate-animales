@extends('layouts.admin')

@section('title', 'Adoptar o Liberar Animales')

@php
    // --- DATOS HARDCODEADOS DIRECTAMENTE EN LA VISTA ---
    $animales = collect([
        (object)[
            'id' => 1,
            'nombre' => 'Lorito',
            'especie' => 'Ave',
            'raza' => 'Loro',
            'estado_salud' => 'Muy Bueno',
            'tipo' => 'Silvestre',
            'imagen' => asset('Fotos/R.jpg'), // Asegúrate que la ruta sea correcta
        ],
        (object)[
            'id' => 2,
            'nombre' => 'Jaguarcito',
            'especie' => 'Felino',
            'raza' => 'Jaguar',
            'estado_salud' => 'Bueno',
            'tipo' => 'Silvestre',
            'imagen' => asset('Fotos/OIP.jpg'), // Asegúrate que la ruta sea correcta
        ],
        (object)[
            'id' => 3,
            'nombre' => 'Max',
            'especie' => 'Canino',
            'raza' => 'Golden Retriever',
            'estado_salud' => 'Excelente',
            'tipo' => 'Doméstico',
            'imagen' => asset('Fotos/Patota.png'), // Asegúrate que la ruta sea correcta
        ],
    ]);
@endphp

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-hand-holding-heart text-primary mr-2"></i>
                    Adoptar o Liberar
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
                    <div class="card-footer">
                        <button type="button" 
                                class="btn btn-primary btn-block liberar-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#liberarAnimalModal"
                                data-id="{{ $animal->id }}"
                                data-nombre="{{ $animal->nombre }}">
                            <i class="fas fa-hand-holding-heart mr-2"></i>
                            Liberar Animal
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

{{-- ================================================================= --}}
{{--                       MODAL LIBERAR ANIMAL                        --}}
{{-- ================================================================= --}}
<div class="modal fade" id="liberarAnimalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">
                    <i class="fas fa-dove mr-2"></i>Liberar Animal
                </h4>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Información del Animal -->
                <div class="card card-info card-outline mb-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-paw mr-2"></i>Animal a Liberar
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

                        <button class="btn btn-primary mb-3 w-100" onclick="obtenerUbicacionAdopcion()">
                            <i class="fas fa-location-arrow mr-2"></i>Usar mi ubicación actual
                        </button>

                        <p class="text-center text-muted small mb-3">o haz clic en el mapa para seleccionar la ubicación</p>

                        <!-- Mapa -->
                        <div id="mapaAdopcion" style="height: 300px; border-radius: 8px; border: 1px solid #dee2e6; overflow: hidden;">
                        </div>

                        <input type="hidden" id="latitud_adopcion" name="latitud_adopcion">
                        <input type="hidden" id="longitud_adopcion" name="longitud_adopcion">
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-success">
                    <i class="fas fa-dove mr-2"></i>Confirmar Liberación
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
    /* Estilos adicionales si son necesarios */
</style>
@endsection

@section('js')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Variables globales para el mapa de adopciones
var mapaAdopcion = null;
var marcadorAdopcion = null;

// Función para obtener ubicación actual en adopciones
function obtenerUbicacionAdopcion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            
            // Centrar el mapa en la ubicación actual
            mapaAdopcion.setView([lat, lng], 15);
            
            // Agregar marcador
            if (marcadorAdopcion) {
                mapaAdopcion.removeLayer(marcadorAdopcion);
            }
            marcadorAdopcion = L.marker([lat, lng]).addTo(mapaAdopcion);
            
            // Actualizar campos ocultos
            document.getElementById('latitud_adopcion').value = lat;
            document.getElementById('longitud_adopcion').value = lng;
            
            console.log('Ubicación de adopción obtenida:', lat, lng);
        }, function(error) {
            console.error('Error al obtener ubicación:', error);
            alert('No se pudo obtener tu ubicación. Puedes marcar la ubicación manualmente en el mapa.');
        });
    } else {
        alert('La geolocalización no está disponible en este navegador.');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Inicializar Select2 para los filtros
    $('.select2').select2({
        theme: 'default',
        width: '100%'
    });
    
    const liberarAnimalModal = document.getElementById('liberarAnimalModal');
    
    $('#liberarAnimalModal').on('show.bs.modal', function (event) {
        // El botón que fue presionado
        const button = event.relatedTarget;
        
        // Lee el nombre del animal desde el atributo data-* del botón
        const nombreAnimal = button.dataset.nombre;

        // Encuentra el badge dentro del modal y actualiza su texto
        const modalAnimalNameBadge = liberarAnimalModal.querySelector('#modalAnimalNameBadge');
        modalAnimalNameBadge.textContent = nombreAnimal;
        
        // Inicializar mapa si no existe
        if (!mapaAdopcion) {
            setTimeout(function() {
                mapaAdopcion = L.map('mapaAdopcion').setView([-17.7833, -63.1833], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(mapaAdopcion);
                
                // Agregar marcador al hacer clic en el mapa
                mapaAdopcion.on('click', function(e) {
                    if (marcadorAdopcion) {
                        mapaAdopcion.removeLayer(marcadorAdopcion);
                    }
                    
                    marcadorAdopcion = L.marker(e.latlng).addTo(mapaAdopcion);
                    
                    // Guardar coordenadas en los campos ocultos
                    document.getElementById('latitud_adopcion').value = e.latlng.lat;
                    document.getElementById('longitud_adopcion').value = e.latlng.lng;
                    
                    console.log('Ubicación de adopción marcada:', e.latlng.lat, e.latlng.lng);
                });
            }, 100);
        }
    });
});
</script>
@endsection