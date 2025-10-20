@extends('layouts.admin')

@section('title', 'Tratamiento - Rescate Animales')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-heart text-primary mr-2"></i>
                    Tratamiento del Animal
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('animales.index') }}">Animales</a></li>
                    <li class="breadcrumb-item active">Tratamiento</li>
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
                                <p><strong>Estado Actual:</strong> <span class="badge badge-secondary">Malo</span></p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Diagnóstico:</strong> Desnutrición y deshidratación</p>
                                <p><strong>Veterinario:</strong> Dr. Carlos Mendoza</p>
                                <p><strong>Última Revisión:</strong> 01/09/2025</p>
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

        <!-- Treatment Plan -->
        <div class="row">
            <!-- Current Treatment -->
          
            <!-- Treatment Status -->
            
            </div>
        </div>

        <!-- Treatment History -->
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-2"></i>
                            Historial de Tratamiento
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tratamiento</th>
                                        <th>Medicamento</th>
                                        <th>Dosis</th>
                                        <th>Veterinario</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01/09/2025</td>
                                        <td>Hidratación</td>
                                        <td>Suero fisiológico</td>
                                        <td>500ml</td>
                                        <td>Dr. Carlos Mendoza</td>
                                        <td>Animal muy deshidratado</td>
                                    </tr>
                                    <tr>
                                        <td>02/09/2025</td>
                                        <td>Nutrición</td>
                                        <td>Vitaminas B1, B6, B12</td>
                                        <td>1ml cada una</td>
                                        <td>Dr. Carlos Mendoza</td>
                                        <td>Mejoría en apetito</td>
                                    </tr>
                                    <tr>
                                        <td>03/09/2025</td>
                                        <td>Fortalecimiento</td>
                                        <td>Multivitamínicos</td>
                                        <td>2ml</td>
                                        <td>Dr. Ana García</td>
                                        <td>Primera caminata exitosa</td>
                                    </tr>
                                    <tr>
                                        <td>04/09/2025</td>
                                        <td>Monitoreo</td>
                                        <td>Control de peso</td>
                                        <td>-</td>
                                        <td>Dr. Carlos Mendoza</td>
                                        <td>Ganancia de 0.5kg</td>
                                    </tr>
                                    <tr>
                                        <td>05/09/2025</td>
                                        <td>Ejercicio</td>
                                        <td>Rehabilitación</td>
                                        <td>15 min</td>
                                        <td>Dr. Ana García</td>
                                        <td>Movilidad mejorada</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medical Evaluations History -->
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-medical mr-2"></i>
                            Historial de Evaluaciones Médicas
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Diagnóstico</th>
                                        <th>Síntomas</th>
                                        <th>Medicación</th>
                                        <th>Veterinario</th>
                                        <th>Próxima Revisión</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01/09/2025</td>
                                        <td>Desnutrición severa</td>
                                        <td>Debilidad, pérdida de peso</td>
                                        <td>Suero fisiológico</td>
                                        <td>Dr. Carlos Mendoza</td>
                                        <td>03/09/2025</td>
                                        <td>Estado crítico al ingreso</td>
                                    </tr>
                                    <tr>
                                        <td>03/09/2025</td>
                                        <td>Mejoría nutricional</td>
                                        <td>Incremento de apetito</td>
                                        <td>Vitaminas B1, B6, B12</td>
                                        <td>Dr. Carlos Mendoza</td>
                                        <td>07/09/2025</td>
                                        <td>Progreso satisfactorio</td>
                                    </tr>
                                    <tr>
                                        <td>07/09/2025</td>
                                        <td>Recuperación muscular</td>
                                        <td>Mayor movilidad</td>
                                        <td>Multivitamínicos</td>
                                        <td>Dr. Ana García</td>
                                        <td>12/09/2025</td>
                                        <td>Primera caminata sin ayuda</td>
                                    </tr>
                                    <tr>
                                        <td>12/09/2025</td>
                                        <td>Estado estable</td>
                                        <td>Sin síntomas preocupantes</td>
                                        <td>Control de peso</td>
                                        <td>Dr. Carlos Mendoza</td>
                                        <td>20/09/2025</td>
                                        <td>Listo para rehabilitación</td>
                                    </tr>
                                    <tr>
                                        <td>20/09/2025</td>
                                        <td>Recuperación completa</td>
                                        <td>Actividad normal</td>
                                        <td>Ejercicios de rehabilitación</td>
                                        <td>Dr. Ana García</td>
                                        <td>30/09/2025</td>
                                        <td>Evaluación final pendiente</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card card-light card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools mr-2"></i>
                            Acciones de Tratamiento
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block" onclick="agregarTratamiento()">
                                    <i class="fas fa-plus mr-2"></i> Agregar Tratamiento
                                </button>
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
        </div>
        <div class="modal fade" id="agregarTratamientoModal" tabindex="-1" aria-labelledby="agregarTratamientoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-success shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="agregarTratamientoModalLabel">
          <i class="fas fa-notes-medical me-2"></i> Nuevo Tratamiento Médico
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>

      <div class="modal-body bg-light">
        <form id="formTratamiento">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="tratamiento" class="form-label fw-semibold">Tratamiento *</label>
              <input type="text" class="form-control" id="tratamiento" placeholder="Ej: Antibiótico para infección" required>
            </div>

            <div class="col-md-6">
              <label for="sintomas" class="form-label fw-semibold">Síntomas *</label>
              <input type="text" class="form-control" id="sintomas" placeholder="Ej: Tos, fiebre, letargo" required>
            </div>

            <div class="col-md-6">
              <label for="duracion" class="form-label fw-semibold">Duración *</label>
              <input type="text" class="form-control" id="duracion" placeholder="Ej: 7 días, 2 semanas" required>
            </div>

            <div class="col-md-6">
              <label for="fecha" class="form-label fw-semibold">Fecha del Tratamiento *</label>
              <input type="datetime-local" class="form-control" id="fecha" required>
            </div>

            <div class="col-12">
              <label for="observaciones" class="form-label fw-semibold">Observaciones</label>
              <textarea class="form-control" id="observaciones" rows="3" placeholder="Detalles adicionales..."></textarea>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal Nuevo Tratamiento Médico (footer) -->
      <div class="modal-footer bg-light">
          <button type="button" class="btn btn-success" onclick="guardarTratamiento()" data-bs-dismiss="modal" data-dismiss="modal">
              <i class="fas fa-check me-2"></i> Guardar Tratamiento
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

document.addEventListener('DOMContentLoaded', function() {
    const veterinarioSeleccionado = sessionStorage.getItem('veterinarioSeleccionadoTratamiento');
    if (veterinarioSeleccionado) {
        const veterinario = JSON.parse(veterinarioSeleccionado);
        document.getElementById('veterinarioNombre').textContent = veterinario.nombre;
    }
});

function cambiarVeterinario() {
    
    window.location.href = "{{ route('animales.seleccionar-veterinario-tratamiento') }}";
}

function agregarTratamiento() {
  const modal = new bootstrap.Modal(document.getElementById('agregarTratamientoModal'));
  modal.show();
}

function programarCitaVeterinaria() { console.log('Función para programar cita veterinaria'); }
function generarReporteTratamiento() { console.log('Generando reporte de tratamiento...'); }
function finalizarTratamiento() { console.log('Tratamiento finalizado exitosamente'); }
function reportarEmergencia() { console.log('Emergencia reportada. El veterinario será contactado.'); }

function guardarTratamiento() {
    
    var modal = bootstrap.Modal.getInstance(document.getElementById('agregarTratamientoModal'));
    if (modal) {
        modal.hide();
    }
}
</script>
@endsection
