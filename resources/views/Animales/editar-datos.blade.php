@extends('layouts.admin')

@section('title', 'Editar Datos - Rescate Animales')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-edit text-primary mr-2"></i>
                    Editar Datos del Animal
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('animales.index') }}">Animales</a></li>
                    <li class="breadcrumb-item active">Editar Datos</li>
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
                    Información Actual del Animal
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="{{ asset('Fotos/OIP.jpg') }}" class="img-fluid rounded" style="max-height: 150px;" alt="Foto del animal">
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="cambiarImagen()">
                                <i class="fas fa-camera mr-1"></i> Cambiar Foto
                            </button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h4 class="text-primary mb-3">Sada</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Especie:</strong> Canino</p>
                                <p><strong>Raza:</strong> Labrador</p>
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

        <!-- Edit Form -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Formulario de Edición
                </h3>
            </div>
            <div class="card-body">
                <form id="editarForm">
                    <div class="row">
                        <!-- Información Básica -->
                        <div class="col-lg-6">
                            <div class="card card-light card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Información Básica
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre_animal">Nombre del Animal</label>
                                        <input type="text" class="form-control" id="nombre_animal" name="nombre" value="Sada" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="especie_animal">Especie</label>
                                        <select class="form-control" id="especie_animal" name="especie" required>
                                            <option value="Canino" selected>Canino</option>
                                            <option value="Felino">Felino</option>
                                            <option value="Ave">Ave</option>
                                            <option value="Reptil">Reptil</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="raza_animal">Raza</label>
                                        <input type="text" class="form-control" id="raza_animal" name="raza" value="Labrador" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sexo_animal">Sexo</label>
                                        <select class="form-control" id="sexo_animal" name="sexo" required>
                                            <option value="Macho" selected>Macho</option>
                                            <option value="Hembra">Hembra</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Estado y Salud -->
                        <div class="col-lg-6">
                            <div class="card card-warning card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-heartbeat mr-2"></i>
                                        Estado y Salud
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="estado_salud">Estado de Salud</label>
                                        <select class="form-control" id="estado_salud" name="estado_salud" required>
                                            <option value="Muy Bueno">Muy Bueno</option>
                                            <option value="Bueno">Bueno</option>
                                            <option value="Estable">Estable</option>
                                            <option value="Malo" selected>Malo</option>
                                            <option value="Muy Malo">Muy Malo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_animal">Tipo de Animal</label>
                                        <select class="form-control" id="tipo_animal" name="tipo" required>
                                            <option value="Doméstico" selected>Doméstico</option>
                                            <option value="Silvestre">Silvestre</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha de Ingreso</label>
                                        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="2025-09-01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edad_estimada">Edad Estimada</label>
                                        <input type="text" class="form-control" id="edad_estimada" name="edad_estimada" placeholder="Ej: 2 años" value="3 años">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información del Rescate -->
                        <div class="col-lg-6">
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        Información del Rescate
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="rescatista">Rescatista</label>
                                        <input type="text" class="form-control" id="rescatista" name="rescatista" value="Rescatista Temporal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion_rescate">Dirección del Rescate</label>
                                        <textarea class="form-control" id="direccion_rescate" name="direccion_rescate" rows="3" required>Calle Paitití, Centro, Santa Cruz De La Sierra, Provincia Andrés Ibáñez, Santa Cruz, Bolivia</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_rescate">Fecha de Rescate</label>
                                        <input type="date" class="form-control" id="fecha_rescate" name="fecha_rescate" value="2025-09-01" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alimentación -->
                        <div class="col-lg-6">
                            <div class="card card-danger card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-utensils mr-2"></i>
                                        Alimentación
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tipo_alimentacion">Tipo de Alimentación</label>
                                        <select class="form-control" id="tipo_alimentacion" name="tipo_alimentacion" required>
                                            <option value="Carnívoro" selected>Carnívoro</option>
                                            <option value="Herbívoro">Herbívoro</option>
                                            <option value="Omnívoro">Omnívoro</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad_alimentacion">Cantidad de Alimentación</label>
                                        <select class="form-control" id="cantidad_alimentacion" name="cantidad_alimentacion" required>
                                            <option value="Diaria" selected>Diaria</option>
                                            <option value="Cada 12 horas">Cada 12 horas</option>
                                            <option value="Cada 8 horas">Cada 8 horas</option>
                                            <option value="Libre">Libre</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado_nutricional">Estado Nutricional</label>
                                        <select class="form-control" id="estado_nutricional" name="estado_nutricional" required>
                                            <option value="Excelente">Excelente</option>
                                            <option value="Bueno">Bueno</option>
                                            <option value="Regular" selected>Regular</option>
                                            <option value="Malo">Malo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="col-12">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-clipboard-list mr-2"></i>
                                        Observaciones y Notas
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones Generales</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Agregue observaciones sobre el animal...">Animal rescatado en mal estado de salud. Requiere atención veterinaria inmediata. Se encuentra en observación para determinar el tratamiento adecuado.</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="notas_medicas">Notas Médicas</label>
                                        <textarea class="form-control" id="notas_medicas" name="notas_medicas" rows="3" placeholder="Notas médicas específicas..."></textarea>
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
                        <button type="button" class="btn btn-warning mr-2" onclick="resetearFormulario()">
                            <i class="fas fa-undo mr-2"></i> Resetear
                        </button>
                        <button type="button" class="btn btn-success" onclick="guardarCambios()">
                            <i class="fas fa-save mr-2"></i> Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
function cambiarImagen() {
    
    alert('Función de cambio de imagen (implementar según necesidades)');
}

function resetearFormulario() {
    if (confirm('¿Está seguro de que desea resetear todos los cambios?')) {
        document.getElementById('editarForm').reset();
        
        document.getElementById('nombre_animal').value = 'Sada';
        document.getElementById('raza_animal').value = 'Labrador';
        document.getElementById('estado_salud').value = 'Malo';
        document.getElementById('tipo_animal').value = 'Doméstico';
        document.getElementById('fecha_ingreso').value = '2025-09-01';
        document.getElementById('edad_estimada').value = '3 años';
        document.getElementById('rescatista').value = 'Rescatista Temporal';
        document.getElementById('direccion_rescate').value = 'Calle Paitití, Centro, Santa Cruz De La Sierra, Provincia Andrés Ibáñez, Santa Cruz, Bolivia';
        document.getElementById('fecha_rescate').value = '2025-09-01';
        document.getElementById('tipo_alimentacion').value = 'Carnívoro';
        document.getElementById('cantidad_alimentacion').value = 'Diaria';
        document.getElementById('estado_nutricional').value = 'Regular';
        document.getElementById('observaciones').value = 'Animal rescatado en mal estado de salud. Requiere atención veterinaria inmediata. Se encuentra en observación para determinar el tratamiento adecuado.';
    }
}

function guardarCambios() {
    
    const form = document.getElementById('editarForm');
    if (form.checkValidity()) {
        
        alert('Cambios guardados exitosamente');
        
        
        
    } else {
        alert('Por favor completa todos los campos obligatorios');
        form.reportValidity();
    }
}
</script>
@endsection
