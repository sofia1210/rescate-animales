<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte Enviado - Rescate Animales</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        .success-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        .success-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 40px;
            text-align: center;
            max-width: 800px;
            width: 100%;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h2 class="text-success mb-3">¡Reporte Enviado Exitosamente!</h2>
        <p class="text-muted mb-4">Su reporte de emergencia ha sido registrado y será procesado por nuestro equipo de rescate.</p>
        <!-- Card de Detalles del Reporte -->
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>Detalles del Reporte
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-5">Tipo de Emergencia:</dt>
                            <dd class="col-sm-7">
                                @if($reporte['tipo_emergencia'] == 'incendio')
                                    <i class="fas fa-fire text-danger mr-1"></i> Incendio
                                @else
                                    <i class="fas fa-exclamation-circle text-warning mr-1"></i> Otra Emergencia
                                @endif
                            </dd>
                            
                            <dt class="col-sm-5">Tipo de Usuario:</dt>
                            <dd class="col-sm-7">
                                @if($reporte['tipo_usuario'] == 'rescatista')
                                    <i class="fas fa-heart text-danger mr-1"></i> Rescatista
                                @else
                                    <i class="fas fa-user mr-1"></i> Reportante
                                @endif
                            </dd>
                            
                            @if($reporte['tipo_usuario'] == 'rescatista' && $reporte['ci'])
                            <dt class="col-sm-5">Cédula de Identidad:</dt>
                            <dd class="col-sm-7">{{ $reporte['ci'] }}</dd>
                            @endif
                            
                            <dt class="col-sm-5">Cantidad de Animales:</dt>
                            <dd class="col-sm-7">{{ $reporte['cantidad_animales'] }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row">
                            @if($reporte['tipo_animal'])
                            <dt class="col-sm-5">Tipo de Animales:</dt>
                            <dd class="col-sm-7">
                                @if($reporte['tipo_animal'] == 'domesticos')
                                    <i class="fas fa-home mr-1"></i> Domésticos
                                @elseif($reporte['tipo_animal'] == 'silvestres')
                                    <i class="fas fa-tree mr-1"></i> Silvestres
                                @else
                                    <i class="fas fa-paw mr-1"></i> Mixtos
                                @endif
                            </dd>
                            @endif
                            
                            <dt class="col-sm-5">Ubicación:</dt>
                            <dd class="col-sm-7">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i> 
                                {{ $reporte['latitud'] }}, {{ $reporte['longitud'] }}
                            </dd>
                            
                            <dt class="col-sm-5">Fecha y Hora:</dt>
                            <dd class="col-sm-7">{{ now()->format('d/m/Y H:i:s') }}</dd>
                        </dl>
                    </div>
                </div>
                
                @if($reporte['observaciones'])
                <div class="row mt-3">
                    <div class="col-12">
                        <h5><i class="fas fa-comment mr-2"></i>Observaciones:</h5>
                        <div class="alert alert-info">
                            {{ $reporte['observaciones'] }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Card de Información Importante -->
        <div class="card card-warning card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i>¿Desea hacer seguimiento de su reporte?
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Beneficios de registrarse:</strong>
                </div>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success mr-2"></i>Recibir actualizaciones sobre el estado de su reporte</li>
                    <li><i class="fas fa-check text-success mr-2"></i>Acceso al historial de sus reportes</li>
                    <li><i class="fas fa-check text-success mr-2"></i>Notificaciones sobre el progreso del rescate</li>
                    <li><i class="fas fa-check text-success mr-2"></i>Participar en futuras actividades de rescate</li>
                </ul>
            </div>
        </div>
        
        <!-- Botones de Acción -->
        <div class="row mt-4">
            <div class="col-md-4 mb-2">
                <a href="{{ route('reporte-rapido') }}" class="btn btn-outline-primary btn-block btn-lg">
                    <i class="fas fa-plus mr-2"></i> Nuevo Reporte
                </a>
            </div>
            <div class="col-md-4 mb-2">
                <a href="{{ route('register') }}" class="btn btn-primary btn-block btn-lg">
                    <i class="fas fa-user-plus mr-2"></i> Registrarse
                </a>
            </div>
            <div class="col-md-4 mb-2">
                <a href="{{ route('login') }}" class="btn btn-success btn-block btn-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                </a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
