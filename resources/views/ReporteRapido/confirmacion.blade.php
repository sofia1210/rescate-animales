<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte Enviado - Rescate Animales</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<div class="login-box" style="width: 800px; max-width: 90%;">
    <div class="login-logo">
        <a href="#"><b>Rescate</b>Animales</a>
    </div>
    
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <h1 class="h1"><b>¡Reporte Enviado!</b></h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Gracias por ayudarnos. Su reporte ha sido registrado y será procesado por nuestro equipo.</p>

            <!-- Detalles del Reporte -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-receipt mr-2"></i>Detalles del Reporte</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Tipo de Emergencia:</dt>
                        <dd class="col-sm-8">
                            @if($reporte['tipo_emergencia'] == 'incendio')
                                <span class="badge bg-danger"><i class="fas fa-fire mr-1"></i> Incendio</span>
                            @else
                                <span class="badge bg-warning"><i class="fas fa-exclamation-circle mr-1"></i> Otra</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Reportado por:</dt>
                        <dd class="col-sm-8">
                            @if($reporte['tipo_usuario'] == 'rescatista')
                                <span class="badge bg-info"><i class="fas fa-heart mr-1"></i> Rescatista</span>
                            @else
                                <span class="badge bg-secondary"><i class="fas fa-user mr-1"></i> Reportante</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Cantidad de Animales:</dt>
                        <dd class="col-sm-8">{{ $reporte['cantidad_animales'] }}</dd>

                        @if($reporte['tipo_animal'])
                        <dt class="col-sm-4">Tipo de Animales:</dt>
                        <dd class="col-sm-8">
                            @if($reporte['tipo_animal'] == 'domesticos')
                                <i class="fas fa-home mr-1"></i> Domésticos
                            @elseif($reporte['tipo_animal'] == 'silvestres')
                                <i class="fas fa-tree mr-1"></i> Silvestres
                            @else
                                <i class="fas fa-paw mr-1"></i> Mixtos
                            @endif
                        </dd>
                        @endif

                        <dt class="col-sm-4">Ubicación:</dt>
                        <dd class="col-sm-8">
                            <i class="fas fa-map-marker-alt text-danger mr-1"></i> 
                            {{ $reporte['latitud'] }}, {{ $reporte['longitud'] }}
                        </dd>

                        <dt class="col-sm-4">Fecha y Hora:</dt>
                        <dd class="col-sm-8">{{ now()->format('d/m/Y H:i:s') }}</dd>
                    </dl>

                    @if($reporte['observaciones'])
                    <div class="mt-3">
                        <strong><i class="fas fa-comment-dots mr-1"></i> Observaciones:</strong>
                        <p class="text-muted border-left pl-2" style="border-width: 3px !important;">
                            {{ $reporte['observaciones'] }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- CTA Registrarse -->
            <div class="alert alert-info mt-4">
                <h5><i class="icon fas fa-info"></i> ¡Haga seguimiento de su reporte!</h5>
                Regístrese para recibir actualizaciones, ver su historial y participar en la comunidad.
            </div>

            <div class="social-auth-links text-center mt-4 mb-3">
                <a href="{{ route('register') }}" class="btn btn-block btn-primary">
                    <i class="fas fa-user-plus mr-2"></i> Crear una Cuenta
                </a>
                <a href="{{ route('reporte-rapido') }}" class="btn btn-block btn-secondary mt-2">
                    <i class="fas fa-plus mr-2"></i> Enviar otro Reporte
                </a>
            </div>

            <p class="mb-0 text-center">
                <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
            </p>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>