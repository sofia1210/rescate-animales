@extends('layouts.admin')

@section('title', 'Evaluación Médica - Rescate Animales')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-file-medical text-primary mr-2"></i>
                    Evaluación Médica
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('animales.index') }}">Animales</a></li>
                    <li class="breadcrumb-item active">Evaluación Médica</li>
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
                            <img src="{{ asset('Fotos/OIP.jpg') }}" class="img-fluid rounded" style="max-height: 200px;" alt="Foto del animal">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="text-primary mb-3">Jaguarcito</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Especie:</strong> Felino</p>
                                <p><strong>Raza:</strong> Jaguar</p>
                                <p><strong>Sexo:</strong> Macho</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Estado de Salud:</strong> <span class="badge badge-secondary">Malo</span></p>
                                <p><strong>Fecha de Ingreso:</strong> 01/09/2025</p>
                                <p><strong>Tipo:</strong> <span class="badge badge-success">Doméstico</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Veterinarian Info -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-md mr-2"></i>
                    Veterinario Asignado
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle bg-success text-white mr-3">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div>
                                <h4 class="mb-1" id="veterinarioNombre">Dr. Carlos Mendoza</h4>
                                <p class="text-muted mb-1" id="veterinarioEspecialidad">Veterinario General</p>
                                <p class="mb-0"><i class="fas fa-phone mr-2"></i><span id="veterinarioTelefono">+591 3 456-7890</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-outline-primary" onclick="cambiarVeterinario()">
                            <i class="fas fa-exchange-alt mr-2"></i> Cambiar Veterinario
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evaluation Form -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-stethoscope mr-2"></i>
                    Nueva Evaluación Médica
                </h3>
            </div>
            <div class="card-body">
                <form id="evaluacionForm">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="diagnostico">Diagnóstico *</label>
                                <input type="text" class="form-control" id="diagnostico" name="diagnostico" placeholder="ej. Infección respiratoria" required>
                            </div>
                            <div class="form-group">
                                <label for="medicacion">Medicación</label>
                                <input type="text" class="form-control" id="medicacion" name="medicacion" placeholder="ej. Amoxicilina">
                            </div>
                            <div class="form-group">
                                <label for="proxima_revision">Próxima Revisión (opcional)</label>
                                <div class="input-group">
                                    <input type="datetime-local" class="form-control" id="proxima_revision" name="proxima_revision" placeholder="dd/mm/2025 --:--">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sintomas">Síntomas *</label>
                                <input type="text" class="form-control" id="sintomas" name="sintomas" placeholder="ej. Tos, dificultad respiratoria" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_evaluacion">Fecha de Evaluación *</label>
                                <div class="input-group">
                                    <input type="datetime-local" class="form-control" id="fecha_evaluacion" name="fecha_evaluacion" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('animales.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i> Volver a Animales
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-success" onclick="guardarEvaluacion()">
                            <i class="fas fa-check mr-2"></i> Guardar Evaluación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
    
    .card {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        border: 0;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
</style>
@endsection

@section('js')
<script>
// Cargar información del veterinario seleccionado
document.addEventListener('DOMContentLoaded', function() {
    const veterinarioSeleccionado = sessionStorage.getItem('veterinarioSeleccionado');
    if (veterinarioSeleccionado) {
        const veterinario = JSON.parse(veterinarioSeleccionado);
        document.getElementById('veterinarioNombre').textContent = veterinario.nombre;
    }
});

function cambiarVeterinario() {
    // Redirigir a la selección de veterinario
    window.location.href = "{{ route('animales.seleccionar-veterinario-evaluacion') }}";
}

function guardarEvaluacion() {
    // Validar formulario
    const form = document.getElementById('evaluacionForm');
    if (form.checkValidity()) {
        // Simular guardado
        alert('Evaluación médica guardada exitosamente');
        
        // Limpiar sessionStorage
        sessionStorage.removeItem('veterinarioSeleccionado');
        
        // Aquí podrías redirigir o hacer otras acciones
        // window.location.href = "{{ route('animales.index') }}";
    } else {
        alert('Por favor completa todos los campos obligatorios');
        form.reportValidity();
    }
}
</script>
@endsection
