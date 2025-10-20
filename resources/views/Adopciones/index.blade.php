@extends('layouts.admin')

@section('title', 'Adoptar o Liberar Animales')

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

<!-- Mantener liberación sólo Admin (ya configurado) y permitir búsqueda/listado para Ciudadano/Admin -->
<section class="content" data-role-allowed="Ciudadano,Administrador">
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
                        <button type="button"
                                class="btn btn-primary btn-block liberar-btn"
                                data-toggle="modal"
                                data-target="#liberarAnimalModal"
                                data-id="{{ $animal->id }}"
                                data-nombre="{{ $animal->nombre }}"
                                data-role-allowed="Administrador">
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

<!-- Modal Liberar Animal: sólo Administrador -->
<div class="modal fade" id="liberarAnimalModal" tabindex="-1" aria-hidden="true" data-role-allowed="Administrador">
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

                        <!-- Botón Usar mi ubicación actual sin ícono -->
                        <button class="btn btn-primary mb-3 w-100" onclick="obtenerUbicacionAdopcion()">
                            Usar mi ubicación actual
                        </button>

                        <p class="text-center text-muted small mb-3">o haz clic en el mapa para seleccionar la ubicación</p>

                        <!-- Mapa -->
                        <div id="mapaAdopcion" style="height: 260px;"></div>

                        <!-- Inputs ocultos de ubicación (agrego latitud) -->
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

function initMapaAdopcion() {
    const container = document.getElementById('mapaAdopcion');
    if (!container) {
        console.warn('Contenedor #mapaAdopcion no existe en el modal.');
        return;
    }
    if (!mapaAdopcion) {
        mapaAdopcion = L.map('mapaAdopcion').setView([-17.7833, -63.1833], 13);

        // Corregido: carga de tiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapaAdopcion);

        mapaAdopcion.on('click', function(e) {
            if (marcadorAdopcion) {
                mapaAdopcion.removeLayer(marcadorAdopcion);
            }
            marcadorAdopcion = L.marker(e.latlng).addTo(mapaAdopcion);
            marcadorAdopcion.bindPopup('Ubicación seleccionada').openPopup();

            const latInput = document.getElementById('latitud_adopcion');
            const lngInput = document.getElementById('longitud_adopcion');
            if (latInput) latInput.value = e.latlng.lat;
            if (lngInput) lngInput.value = e.latlng.lng;
        });
    }
    setTimeout(function() { mapaAdopcion.invalidateSize(true); }, 0);
}

function obtenerUbicacionAdopcion() {
    if (!mapaAdopcion) initMapaAdopcion();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            mapaAdopcion.setView([lat, lng], 15);
            if (marcadorAdopcion) {
                mapaAdopcion.removeLayer(marcadorAdopcion);
            }
            marcadorAdopcion = L.marker([lat, lng]).addTo(mapaAdopcion);
            marcadorAdopcion.bindPopup('Ubicación seleccionada').openPopup();

            const latInput = document.getElementById('latitud_adopcion');
            const lngInput = document.getElementById('longitud_adopcion');
            if (latInput) latInput.value = lat;
            if (lngInput) lngInput.value = lng;

            setTimeout(function() { mapaAdopcion.invalidateSize(true); }, 0);
        }, function() {
            alert('No se pudo obtener tu ubicación. Puedes marcar la ubicación manualmente en el mapa.');
        });
    } else {
        alert('La geolocalización no está disponible en este navegador.');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    if ($.fn && $.fn.select2) {
        $('.select2').select2({ theme: 'default', width: '100%' });
    }
    const liberarAnimalModal = document.getElementById('liberarAnimalModal');

    $('#liberarAnimalModal').on('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const nombreAnimal = button?.dataset?.nombre || '';
        const badge = liberarAnimalModal.querySelector('#modalAnimalNameBadge');
        if (badge) badge.textContent = nombreAnimal;
        initMapaAdopcion();
    });

    $('#liberarAnimalModal').on('shown.bs.modal', function () {
        if (mapaAdopcion) {
            setTimeout(function() { mapaAdopcion.invalidateSize(true); }, 0);
        }
    });

    $('#confirmarLiberacion').on('click', function () {
        $('#liberarAnimalModal').modal('hide');
    });
});
</script>
@endsection