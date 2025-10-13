@extends('layouts.admin')

@section('title', 'Adoptar o Liberar Animales')

@php
    // --- DATOS HARDCODEADOS DIRECTAMENTE EN LA VISTA ---
    $animales = collect([
        (object)[
            'id' => 1,
            'nombre' => 'Jaguar',
            'especie' => 'Felino',
            'raza' => 'Jaguar',
            'estado_salud' => 'Muy Bueno',
            'tipo' => 'Silvestre',
            'imagen' => asset('Fotos/R.jpg'), // Asegúrate que la ruta sea correcta
        ],
        (object)[
            'id' => 2,
            'nombre' => 'Sada',
            'especie' => 'Asdas',
            'raza' => 'Sadda',
            'estado_salud' => 'Bueno',
            'tipo' => 'Doméstico',
            'imagen' => asset('Fotos/OIP.jpg'), // Asegúrate que la ruta sea correcta
        ],
    ]);
@endphp

@section('content')
<div class="container-fluid" style="background-color: #f0fbf4; min-height: 100vh; padding: 2rem;">
    
    <h1 class="mb-4">Adoptar o Liberar</h1>

    {{-- Filtros y Búsqueda --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="mb-3">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre">
            </div>
            <div class="d-flex align-items-center mb-2">
                <strong class="me-3">Tipo:</strong>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-success">Todos</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Doméstico</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Silvestre</button>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <strong class="me-3">Estado:</strong>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-success">Todos</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Muy Bueno</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Bueno</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Estable</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Listado de Animales en Cards --}}
    <div class="row">
        @forelse ($animales as $animal)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $animal->imagen }}" class="card-img-top p-3" alt="Foto de {{ $animal->nombre }}" style="height: 200px; object-fit: cover; border-radius: 1.25rem;">
                    <div class="card-body pt-0">
                        <h5 class="card-title fw-bold">{{ $animal->nombre }}</h5>
                        <p class="card-text mb-1"><small>Especie: {{ $animal->especie }}</small></p>
                        <p class="card-text mb-1"><small>Raza: {{ $animal->raza }}</small></p>
                        <p class="card-text"><strong>Estado: {{ $animal->estado_salud }}</strong></p>
                    </div>
                    <div class="card-footer bg-white border-0 text-center pb-3">
                        {{-- BOTÓN PREPARADO CON LOS DATOS --}}
                        <button type="button" class="btn btn-primary w-100 liberar-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#liberarAnimalModal"
                                data-id="{{ $animal->id }}"
                                data-nombre="{{ $animal->nombre }}">
                            Liberar
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
{{--                       MODAL INTEGRADO                             --}}
{{-- ================================================================= --}}
<div class="modal fade" id="liberarAnimalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1.5rem;">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title fw-bold">Liberar Animal</h5>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-light text-dark border"><small>Campos obligatorios marcados con *</small></span>
                        <span class="badge bg-success" id="modalAnimalNameBadge">...</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-custom card-info-bg">
                    <div class="card-body">
                        <h6 class="card-title fw-bold mb-3"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Ubicación de Liberación</h6>
                        <button class="btn btn-primary mb-3 w-100"><i class="fas fa-location-arrow me-2"></i>Usar mi ubicación actual</button>
                        <p class="text-center text-muted small mb-3">o haz clic en el mapa</p>
                        <img src="{{ asset('imagenes/mapa-placeholder.png') }}" alt="Mapa de Santa Cruz" class="img-fluid rounded border">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Liberación</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Estilos para el nuevo diseño del modal de ubicación */
    .card-custom { border: 1px solid rgba(0,0,0,.08); box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); }
    .card-info-bg { background: linear-gradient(135deg, #eef5ff 0%, #f8f9ff 100%); }
</style>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const liberarAnimalModal = document.getElementById('liberarAnimalModal');
    
    liberarAnimalModal.addEventListener('show.bs.modal', function (event) {
        // El botón que fue presionado
        const button = event.relatedTarget;
        
        // Lee el nombre del animal desde el atributo data-* del botón
        const nombreAnimal = button.dataset.nombre;

        // Encuentra el badge dentro del modal y actualiza su texto
        const modalAnimalNameBadge = liberarAnimalModal.querySelector('#modalAnimalNameBadge');
        modalAnimalNameBadge.textContent = nombreAnimal;
    });
});
</script>
@endsection