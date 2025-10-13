{{-- Este archivo ya no extiende un layout, porque será cargado en un modal. --}}
{{-- No necesita las secciones @section, solo el HTML del contenido del modal --}}

<div class="modal-header">
    <div class="d-flex align-items-center">
        <button type="button" class="btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
        <div>
            <h4 class="modal-title"><b>{{ $animal->nombre }}</b></h4>
            <div class="mt-1">
                <span class="badge bg-success">{{ $animal->tipo }}</span>
                <span class="badge bg-secondary">{{ $animal->especie }}</span>
                <span class="badge bg-success">{{ $animal->estado_salud ?? 'No especificado' }}</span>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success">
        <i class="fas fa-check-circle me-1"></i>
        Cambiar Estado de Salud
    </button>
</div>

<div class="modal-body">
    <div class="card card-primary card-tabs">
        
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="animal-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="info-tab-{{ $animal->nombre }}" data-bs-toggle="tab" href="#info-content-{{ $animal->nombre }}" role="tab" aria-controls="info-content-{{ $animal->nombre }}" aria-selected="true">Información General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="location-tab-{{ $animal->nombre }}" data-bs-toggle="tab" href="#location-content-{{ $animal->nombre }}" role="tab" aria-controls="location-content-{{ $animal->nombre }}" aria-selected="false">Ubicación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="actions-tab-{{ $animal->nombre }}" data-bs-toggle="tab" href="#actions-content-{{ $animal->nombre }}" role="tab" aria-controls="actions-content-{{ $animal->nombre }}" aria-selected="false">Acciones</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="animal-tabs-content-{{ $animal->nombre }}">
                
                <div class="tab-pane fade show active" id="info-content-{{ $animal->nombre }}" role="tabpanel" aria-labelledby="info-tab-{{ $animal->nombre }}">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card card-info card-outline">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle me-2"></i>Información Básica</h3></div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">Especie:</dt><dd class="col-sm-8">{{ $animal->especie }}</dd>
                                        <dt class="col-sm-4">Raza:</dt><dd class="col-sm-8">{{ $animal->raza }}</dd>
                                        <dt class="col-sm-4">Sexo:</dt><dd class="col-sm-8">{{ $animal->sexo ?? 'No especificado' }}</dd>
                                        <dt class="col-sm-4">Estado de Salud:</dt><dd class="col-sm-8">{{ $animal->estado_salud ?? 'No especificado' }}</dd>
                                        <dt class="col-sm-4">Fecha de Ingreso:</dt><dd class="col-sm-8">{{ $animal->fecha_ingreso ? $animal->fecha_ingreso->format('d/m/Y') : 'No especificado' }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="card card-warning card-outline">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-drumstick-bite me-2"></i>Alimentación</h3></div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">Tipo:</dt><dd class="col-sm-8">{{ $animal->alimentacion->tipo ?? 'No especificado' }}</dd>
                                        <dt class="col-sm-4">Cantidad:</dt><dd class="col-sm-8">{{ $animal->alimentacion->cantidad ?? 'No especificado' }}</dd>
                                        <dt class="col-sm-4">Frecuencia:</dt><dd class="col-sm-8">{{ $animal->alimentacion->frecuencia ?? 'No especificado' }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="text-center mb-3">
                                <img src="{{ $animal->imagen }}" class="img-fluid rounded" alt="Foto de {{ $animal->nombre }}">
                            </div>
                            <div class="card card-warning card-outline">
                                <div class="card-header"><h3 class="card-title"><i class="fas fa-heartbeat me-2"></i>Estado Actual</h3></div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-5">Tipo:</dt><dd class="col-sm-7">{{ $animal->tipo }}</dd>
                                        <dt class="col-sm-5">Estado:</dt><dd class="col-sm-7">{{ $animal->estado }}</dd>
                                        <dt class="col-sm-5">Fecha de Liberación:</dt><dd class="col-sm-7">{{ $animal->fecha_liberacion ?? 'Pendiente' }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="location-content-{{ $animal->nombre }}" role="tabpanel" aria-labelledby="location-tab-{{ $animal->nombre }}">
                    <h4 class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Ubicación de Rescate</h4>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card card-outline card-secondary h-100">
                                <div class="card-header"><h3 class="card-title">Dirección de Rescate</h3></div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-map-pin me-2 text-muted"></i>{{ $animal->ubicacion_rescatado ?? 'No especificada' }}</li>
                                    </ul>
                                    <hr>
                                    <p class="text-muted mt-2"><b>Rescatado por:</b> {{ $animal->rescatista }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <img src="/imagenes/mapa-placeholder.png" alt="Mapa de ubicación" class="img-fluid rounded border">
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="actions-content-{{ $animal->nombre }}" role="tabpanel" aria-labelledby="actions-tab-{{ $animal->nombre }}">
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

<div class="modal-footer justify-content-end">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>
