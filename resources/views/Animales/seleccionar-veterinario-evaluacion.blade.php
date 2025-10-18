@extends('layouts.admin')

@section('title', 'Seleccionar Veterinario - Evaluación Médica')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-user-md text-primary mr-2"></i>
                    Seleccionar Veterinario
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('animales.index') }}">Animales</a></li>
                    <li class="breadcrumb-item active">Seleccionar Veterinario</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Animal Info Card -->
        

        <!-- Veterinarian Selection -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-stethoscope mr-2"></i>
                    Seleccionar Veterinario para Evaluación Médica
                </h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="buscarVeterinario" placeholder="Buscar veterinario por nombre o especialidad...">
                        </div>
                    </div>
                    <div class="col-md-4">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#agregarVeterinarioModal">
                        <i class="fas fa-plus me-2"></i> Agregar Veterinario
                    </button>
                    </div>
                </div>

                <!-- Veterinarians List -->
                <div class="row" id="veterinariosList">
                    <!-- Veterinario 1 -->
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm border-left-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-circle bg-primary text-white">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="mb-0">Dr. Carlos Mendoza</h5>
                                        <small class="text-muted">Veterinario General</small>
                                    </div>
                                </div>
                                <div class="veterinario-info">
                                    <p class="mb-1"><i class="fas fa-phone text-primary mr-2"></i>+591 3 456-7890</p>
                                    <p class="mb-1"><i class="fas fa-envelope text-primary mr-2"></i>carlos.mendoza@vet.com</p>
                                    <p class="mb-1"><i class="fas fa-map-marker-alt text-primary mr-2"></i>Clínica Veterinaria Central</p>
                                    <p class="mb-0"><i class="fas fa-clock text-primary mr-2"></i>Disponible: 8:00 - 18:00</p>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-success">Disponible</span>
                                    <span class="badge badge-info">Experiencia: 8 años</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <button type="button" class="btn btn-primary btn-block" onclick="seleccionarVeterinario(1, 'Dr. Carlos Mendoza')">
                                    <i class="fas fa-check mr-2"></i> Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Veterinario 2 -->
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm border-left-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-circle bg-success text-white">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="mb-0">Dra. Ana García</h5>
                                        <small class="text-muted">Especialista en Cirugía</small>
                                    </div>
                                </div>
                                <div class="veterinario-info">
                                    <p class="mb-1"><i class="fas fa-phone text-primary mr-2"></i>+591 3 234-5678</p>
                                    <p class="mb-1"><i class="fas fa-envelope text-primary mr-2"></i>ana.garcia@vet.com</p>
                                    <p class="mb-1"><i class="fas fa-map-marker-alt text-primary mr-2"></i>Hospital Veterinario San Roque</p>
                                    <p class="mb-0"><i class="fas fa-clock text-primary mr-2"></i>Disponible: 9:00 - 17:00</p>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-success">Disponible</span>
                                    <span class="badge badge-warning">Especialista</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <button type="button" class="btn btn-primary btn-block" onclick="seleccionarVeterinario(2, 'Dra. Ana García')">
                                    <i class="fas fa-check mr-2"></i> Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Veterinario 3 -->
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm border-left-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-circle bg-warning text-white">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="mb-0">Dr. Luis Rodríguez</h5>
                                        <small class="text-muted">Medicina Interna</small>
                                    </div>
                                </div>
                                <div class="veterinario-info">
                                    <p class="mb-1"><i class="fas fa-phone text-primary mr-2"></i>+591 3 345-6789</p>
                                    <p class="mb-1"><i class="fas fa-envelope text-primary mr-2"></i>luis.rodriguez@vet.com</p>
                                    <p class="mb-1"><i class="fas fa-map-marker-alt text-primary mr-2"></i>Centro Veterinario Integral</p>
                                    <p class="mb-0"><i class="fas fa-clock text-primary mr-2"></i>Disponible: 7:00 - 19:00</p>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-warning">Ocupado hasta 15:00</span>
                                    <span class="badge badge-info">Experiencia: 12 años</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <button type="button" class="btn btn-secondary btn-block" disabled>
                                    <i class="fas fa-clock mr-2"></i> No Disponible
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('animales.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i> Volver a Animales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Agregar Veterinario -->
<div class="modal fade" id="agregarVeterinarioModal" tabindex="-1" role="dialog" aria-labelledby="agregarVeterinarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="agregarVeterinarioModalLabel">
                    <i class="fas fa-user-plus mr-2"></i>Agregar Nuevo Veterinario
                </h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="veterinarioForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_veterinario">Nombre Completo *</label>
                                <input type="text" class="form-control" id="nombre_veterinario" name="nombre" placeholder="Dr. Juan Pérez" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="especialidad">Especialidad *</label>
                                <select class="form-control" id="especialidad" name="especialidad" required>
                                    <option value="">Selecciona una especialidad</option>
                                    <option value="Veterinario General">Veterinario General</option>
                                    <option value="Cirugía">Cirugía</option>
                                    <option value="Medicina Interna">Medicina Interna</option>
                                    <option value="Dermatología">Dermatología</option>
                                    <option value="Cardiología">Cardiología</option>
                                    <option value="Neurología">Neurología</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono *</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="+591 3 123-4567" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="veterinario@email.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clinica">Clínica/Hospital</label>
                                <input type="text" class="form-control" id="clinica" name="clinica" placeholder="Clínica Veterinaria Central">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="horario">Horario de Atención</label>
                                <input type="text" class="form-control" id="horario" name="horario" placeholder="8:00 - 18:00">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="experiencia">Años de Experiencia</label>
                                <input type="number" class="form-control" id="experiencia" name="experiencia" placeholder="5" min="0">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <

                <button type="button" class="btn btn-success" onclick="guardarVeterinario()">
                    <i class="fas fa-save mr-1"></i> Guardar Veterinario
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .avatar-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .border-left-primary {
        border-left: 4px solid #007bff !important;
    }
    
    .border-left-success {
        border-left: 4px solid #28a745 !important;
    }
    
    .border-left-warning {
        border-left: 4px solid #ffc107 !important;
    }
    
    .veterinario-info p {
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }
    
    .card {
        transition: transform 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
</style>
@endsection

@section('js')
<script>
function seleccionarVeterinario(id, nombre) {
    
    sessionStorage.setItem('veterinarioSeleccionado', JSON.stringify({
        id: id,
        nombre: nombre
    }));
    
    
    window.location.href = "{{ route('animales.evaluacion-medica') }}";
}

function guardarVeterinario() {
    
    $('#agregarVeterinarioModal').modal('hide');
}

document.getElementById('buscarVeterinario').addEventListener('input', function(e) {
    const termino = e.target.value.toLowerCase();
    const veterinarios = document.querySelectorAll('#veterinariosList .col-md-6');
    
    veterinarios.forEach(veterinario => {
        const nombre = veterinario.querySelector('h5').textContent.toLowerCase();
        const especialidad = veterinario.querySelector('small').textContent.toLowerCase();
        
        if (nombre.includes(termino) || especialidad.includes(termino)) {
            veterinario.style.display = 'block';
        } else {
            veterinario.style.display = 'none';
        }
    });
});
</script>
@endsection
