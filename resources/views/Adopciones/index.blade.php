@extends('layouts.admin')

@section('title', 'Dar en Adopción o Liberar Animales')

@section('css')
    <style>
        #mapaAdopcion { height: 340px; width: 100%; border: 1px solid #ddd; border-radius: 6px; }
        .card .img-fluid { object-fit: cover; height: 220px; width: 100%; }
        .modal-body .card { margin-bottom: .75rem; }
        .modal-header.bg-success, .modal-header.bg-primary { align-items: center; }
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
            'nombre' => 'Luna',
            'especie' => 'Canino',
            'raza' => 'Mestizo',
            'estado_salud' => 'Muy Bueno',
            'tipo' => 'Doméstico',
            'imagen' => asset('Fotos/R.jpg'),
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
    <div class="container-fluid pb-4">

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
            <!-- Dentro del modal #liberarAnimalModal, header -->
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">
                   
                    <span id="modalTitleText">Liberar o dar en Adopcion</span>
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modalAnimalTipo" value="">
                <div class="card card-info card-outline mb-3">
                    <div class="card-header">
                        <h3 class="card-title">
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
                    Confirmar 
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

// Dentro del <script> de Adopciones
// función: actualizarModalSegunTipo(tipo)
function actualizarModalSegunTipo(tipo) {
    const t = (tipo || '').toString()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .toLowerCase().trim();

    const esDomestico = t === 'domestico';

    if (esDomestico) {
        $('.icon-domestico').removeClass('d-none');
        $('.icon-salvaje').addClass('d-none');
        $('#modalTitleText').text('Dar en Adopción');
        $('#modalSubtitleText').text('Animal a dar en Adopción');
    } else {
        $('.icon-domestico').addClass('d-none');
        $('.icon-salvaje').removeClass('d-none');
        $('#modalTitleText').text('Liberar');
        $('#modalSubtitleText').text('Animal a Liberar');
    }
    $('#modalAnimalTipo').val(tipo || '');
}

// función: initMapaAdopcion(lat, lng)
function initMapaAdopcion(lat = -17.7833, lng = -63.1833) {
    const container = document.getElementById('mapaAdopcion');
    if (!container) {
        console.error('Contenedor #mapaAdopcion no encontrado');
        return;
    }

    if (!mapaAdopcion) {
        mapaAdopcion = L.map('mapaAdopcion', {
            zoomControl: true,
            scrollWheelZoom: true
        }).setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapaAdopcion);

        marcadorAdopcion = L.marker([lat, lng], { draggable: true }).addTo(mapaAdopcion);

        mapaAdopcion.on('click', function(e) {
            marcadorAdopcion.setLatLng(e.latlng);
            document.getElementById('latitud_adopcion').value = e.latlng.lat;
            document.getElementById('longitud_adopcion').value = e.latlng.lng;
        });

        marcadorAdopcion.on('dragend', function(e) {
            const ll = e.target.getLatLng();
            document.getElementById('latitud_adopcion').value = ll.lat;
            document.getElementById('longitud_adopcion').value = ll.lng;
        });
    } else {
        setTimeout(function() { mapaAdopcion.invalidateSize(true); }, 0);
        mapaAdopcion.setView([lat, lng], 13);
        if (marcadorAdopcion) marcadorAdopcion.setLatLng([lat, lng]);
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

            if (!mapaAdopcion) initMapaAdopcion(lat, lng);
            else {
                mapaAdopcion.setView([lat, lng], 15);
                if (!marcadorAdopcion) {
                    marcadorAdopcion = L.marker([lat, lng], { draggable: true }).addTo(mapaAdopcion);
                } else {
                    marcadorAdopcion.setLatLng([lat, lng]);
                }
            }

            document.getElementById('latitud_adopcion').value = lat;
            document.getElementById('longitud_adopcion').value = lng;
        },
        function(error) {
            console.warn('Error al obtener la ubicación:', error.message);
            alert('No se pudo obtener tu ubicación. Marca la ubicación manualmente en el mapa.');
        }
    );
}

// eventos del modal: show.bs.modal / shown.bs.modal
if (window.jQuery) {
    $('#liberarAnimalModal').on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const tipo = button.data('tipo');
        const nombre = button.data('nombre');

        $('#modalAnimalNameBadge').text(nombre || '...');
        actualizarModalSegunTipo(tipo);

        const lat = parseFloat(document.getElementById('latitud_adopcion').value) || -17.7833;
        const lng = parseFloat(document.getElementById('longitud_adopcion').value) || -63.1833;
        initMapaAdopcion(lat, lng);
    });

    $('#liberarAnimalModal').on('shown.bs.modal', function() {
        // Sólo Leaflet: redimensiona correctamente en modal
        if (mapaAdopcion) setTimeout(function(){ mapaAdopcion.invalidateSize(true); }, 0);
    });

    $('#confirmarLiberacion').on('click', function() {
        $('#liberarAnimalModal').modal('hide');
    });
} else {
    console.warn('jQuery no disponible; inicialización básica sin eventos de Bootstrap.');
    document.addEventListener('DOMContentLoaded', function() {
        initMapaAdopcion();
    });
}
@section('js')
<script>
// Capturar el animal seleccionado cuando se abre el modal
$('.liberar-btn').on('click', function() {
  const id = parseInt($(this).data('id'), 10);
  const nombre = $(this).data('nombre');
  const tipo = $(this).data('tipo');
  $('#liberarAnimalModal').data('animalId', id);
  $('#modalAnimalNameBadge').text(nombre);
  $('#modalAnimalTipo').val(tipo);
});

// Confirmar acción: crear Adopción o Liberación en MockDB y vincular en Hoja_Animal
$('#confirmarLiberacion').off('click').on('click', function() {
  const tipo = ($('#modalAnimalTipo').val() || '').trim();
  const animalId = $('#liberarAnimalModal').data('animalId');
  const lat = parseFloat($('#latitud_adopcion').val()) || -17.7833;
  const lng = parseFloat($('#longitud_adopcion').val()) || -63.1833;

  if (!window.MockDB || !animalId) {
    console.warn('MockDB o AnimalID no disponible.');
    return;
  }

  if (tipo === 'Doméstico') {
    const adop = window.MockDB.create('Adopcion', {
      direccion: 'Ubicación seleccionada',
      latitud: lat,
      longitud: lng,
      detalle: 'Adopción simulada',
      administrador_id: 1,
      adoptante_id: 1
    });
    const hoja = window.MockDB.find('Hoja_Animal', animalId);
    if (hoja) {
      hoja.adopcion_id = adop.adopcion_id;
      window.MockDB.update('Hoja_Animal', hoja);
    }
  } else {
    const lib = window.MockDB.create('Liberacion', {
      direccion: 'Ubicación seleccionada',
      detalle: 'Liberación simulada',
      latitud: lat,
      longitud: lng,
      aprobada: true
    });
    const hoja = window.MockDB.find('Hoja_Animal', animalId);
    if (hoja) {
      hoja.liberacion_id = lib.liberacion_id;
      window.MockDB.update('Hoja_Animal', hoja);
    }
  }

  // Cerrar modal y feedback simple
  $('#liberarAnimalModal').modal('hide');
  setTimeout(() => alert('Acción simulada registrada en MockDB.'), 100);
});
</script>
<script>
// Cargar el API cuando el documento esté listo
document.addEventListener('DOMContentLoaded', loadGoogleMaps);
</script>
<script>
</script>
