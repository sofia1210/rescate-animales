@extends('adminlte::page') {{-- O tu layout principal de AdminLTE --}}

@section('title', 'Detalles del Animal')

@section('content_header')
    <h1>Ficha del Animal</h1>
@stop

@section('content')
    {{-- BOTÓN PARA ABRIR EL MODAL --}}
    {{-- Coloca este botón donde quieras que se active el modal --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#animalDetailsModal">
        <i class="fas fa-eye"></i> Ver Detalles del Jaguar
    </button>


    {{-- ---------------------------------------------------------------- --}}
    {{--                       INICIO DEL MODAL                           --}}
    {{-- ---------------------------------------------------------------- --}}
    <div class="modal fade" id="animalDetailsModal" tabindex="-1" aria-labelledby="animalDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                
                {{-- HEADER DEL MODAL --}}
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <button type="button" class="close me-3" data-dismiss="modal" aria-label="Close">&times;</button>
                        <div>
                            <h4 class="modal-title" id="animalDetailsModalLabel"><b>Jaguar</b></h4>
                            <div class="mt-1">
                                <span class="badge bg-success">Animal Silvestre</span>
                                <span class="badge bg-secondary">Felino</span>
                                <span class="badge bg-success">Muy Bueno</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success">
                        <i class="fas fa-check-circle me-1"></i>
                        Cambiar Estado de Salud
                    </button>
                </div>

                {{-- CUERPO DEL MODAL CON LAS PESTAÑAS --}}
                <div class="modal-body">
                    <div class="card card-primary card-tabs">
                        
                        {{-- NAVEGACIÓN DE PESTAÑAS --}}
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="animal-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info-content" role="tab" aria-controls="info-content" aria-selected="true">Información General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="location-tab" data-bs-toggle="tab" href="#location-content" role="tab" aria-controls="location-content" aria-selected="false">Ubicación</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="actions-tab" data-bs-toggle="tab" href="#actions-content" role="tab" aria-controls="actions-content" aria-selected="false">Acciones</a>
                                </li>
                            </ul>
                        </div>

                        {{-- CONTENIDO DE LAS PESTAÑAS --}}
                        <div class="card-body">
                            <div class="tab-content" id="animal-tabs-content">
                                
                                {{-- PESTAÑA 1: INFORMACIÓN GENERAL --}}
                                <div class="tab-pane fade show active" id="info-content" role="tabpanel" aria-labelledby="info-tab">
                                    <div class="row">
                                        {{-- Columna Izquierda --}}
                                        <div class="col-lg-7">
                                            <div class="card card-info card-outline">
                                                <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle me-2"></i>Información Básica</h3></div>
                                                <div class="card-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Especie:</dt><dd class="col-sm-8">Felino</dd>
                                                        <dt class="col-sm-4">Raza:</dt><dd class="col-sm-8">Jaguar</dd>
                                                        <dt class="col-sm-4">Sexo:</dt><dd class="col-sm-8">Macho</dd>
                                                        <dt class="col-sm-4">Estado de Salud:</dt><dd class="col-sm-8">Muy Bueno</dd>
                                                        <dt class="col-sm-4">Fecha de Ingreso:</dt><dd class="col-sm-8">05/10/2025</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="card card-warning card-outline">
                                                <div class="card-header"><h3 class="card-title"><i class="fas fa-drumstick-bite me-2"></i>Alimentación</h3></div>
                                                <div class="card-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Tipo:</dt><dd class="col-sm-8">Carnívoro</dd>
                                                        <dt class="col-sm-4">Cantidad:</dt><dd class="col-sm-8">2 kg</dd>
                                                        <dt class="col-sm-4">Frecuencia:</dt><dd class="col-sm-8">Diaria</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Columna Derecha --}}
                                        <div class="col-lg-5">
                                            <div class="text-center mb-3">
                                                <img src="https://via.placeholder.com/400x300.png/fff0f5/333333?text=Jaguar" class="img-fluid rounded" alt="Foto del Jaguar">
                                            </div>
                                            <div class="card card-warning card-outline">
                                                <div class="card-header"><h3 class="card-title"><i class="fas fa-heartbeat me-2"></i>Estado Actual</h3></div>
                                                <div class="card-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-5">Tipo:</dt><dd class="col-sm-7">Silvestre</dd>
                                                        <dt class="col-sm-5">Estado:</dt><dd class="col-sm-7">Muy Bueno</dd>
                                                        <dt class="col-sm-5">Fecha de Liberación:</dt><dd class="col-sm-7">Pendiente</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- PESTAÑA 2: UBICACIÓN --}}
                                <div class="tab-pane fade" id="location-content" role="tabpanel" aria-labelledby="location-tab">
                                    <h4 class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Ubicación de Rescate</h4>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card card-outline card-secondary h-100">
                                                <div class="card-header"><h3 class="card-title">Dirección de Rescate</h3></div>
                                                <div class="card-body">
                                                    <ul class="list-unstyled">
                                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>El Carmen</li>
                                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>Piraí</li>
                                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>Santa Cruz De La Sierra</li>
                                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>Provincia Andrés Ibáñez</li>
                                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>Santa Cruz</li>
                                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>Bolivia</li>
                                                    </ul>
                                                    <hr>
                                                    <p class="text-muted mt-2"><b>Rescatado por:</b> Lucas</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Ubicación del Reporte</h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="map" class="map-container"></div>
                                        <small class="text-muted">Haga clic en el mapa para marcar la ubicación exacta</small>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                </div>
                                
                                {{-- PESTAÑA 3: ACCIONES --}}
                                <div class="tab-pane fade" id="actions-content" role="tabpanel" aria-labelledby="actions-tab">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="small-box bg-success">
                                                <div class="inner"><h3>Evaluaciones</h3><p>Ver historial médico</p></div>
                                                <div class="icon"><i class="fas fa-file-medical"></i></div>
                                                <a href="#" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="small-box bg-success">
                                                <div class="inner"><h3>Ubicación</h3><p>Gestionar ubicaciones</p></div>
                                                <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
                                                <a href="#" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="small-box bg-purple">
                                                <div class="inner"><h3>Traslados</h3><p>Historial de movimientos</p></div>
                                                <div class="icon"><i class="fas fa-truck-moving"></i></div>
                                                <a href="#" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="small-box bg-warning">
                                                <div class="inner"><h3>Tratamiento</h3><p>Nuevo tratamiento</p></div>
                                                <div class="icon"><i class="fas fa-heartbeat"></i></div>
                                                <a href="#" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="small-box bg-info">
                                                <div class="inner"><h3>Rescatista</h3><p>Ver información</p></div>
                                                <div class="icon"><i class="fas fa-user-shield"></i></div>
                                                <a href="#" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER DEL MODAL --}}
                <div class="modal-footer justify-content-end">
                    <!-- No buttons needed - only X button in header -->
                </div>
            </div>
        </div>
    </div>
    {{-- ---------------------------------------------------------------- --}}
    {{--                         FIN DEL MODAL                            --}}
    {{-- ---------------------------------------------------------------- --}}

@stop

@section('css')
    {{-- Si necesitas estilos adicionales, puedes añadirlos aquí --}}
    <style>
        .small-box .icon {
            font-size: 60px; /* Para que los íconos se vean más grandes en las cajas */
        }
    </style>
@stop

@section('js')
    <script> console.log('Página de detalles cargada!'); </script>
@stop