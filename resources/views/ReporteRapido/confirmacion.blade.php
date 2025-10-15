<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte Enviado - Rescate Animales</title>

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
            max-width: 500px;
            width: 100%;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        .report-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }
        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
        }
        .detail-value {
            color: #6c757d;
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
        
        <div class="report-details">
            <h5 class="mb-3"><i class="fas fa-info-circle"></i> Detalles del Reporte</h5>
            
            <div class="detail-item">
                <span class="detail-label">Tipo de Emergencia:</span>
                <span class="detail-value">
                    @if($reporte['tipo_emergencia'] == 'incendio')
                        <i class="fas fa-fire text-danger"></i> Incendio
                    @else
                        <i class="fas fa-exclamation-circle text-warning"></i> Otra Emergencia
                    @endif
                </span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Tipo de Usuario:</span>
                <span class="detail-value">
                    @if($reporte['tipo_usuario'] == 'rescatista')
                        <i class="fas fa-heart text-danger"></i> Rescatista
                    @else
                        <i class="fas fa-user"></i> Reportante
                    @endif
                </span>
            </div>
            
            @if($reporte['tipo_usuario'] == 'rescatista' && $reporte['ci'])
            <div class="detail-item">
                <span class="detail-label">Cédula de Identidad:</span>
                <span class="detail-value">{{ $reporte['ci'] }}</span>
            </div>
            @endif
            
            <div class="detail-item">
                <span class="detail-label">Cantidad de Animales:</span>
                <span class="detail-value">{{ $reporte['cantidad_animales'] }}</span>
            </div>
            
            @if($reporte['tipo_animal'])
            <div class="detail-item">
                <span class="detail-label">Tipo de Animales:</span>
                <span class="detail-value">
                    @if($reporte['tipo_animal'] == 'domesticos')
                        <i class="fas fa-home"></i> Domésticos
                    @elseif($reporte['tipo_animal'] == 'silvestres')
                        <i class="fas fa-tree"></i> Silvestres
                    @else
                        <i class="fas fa-paw"></i> Mixtos
                    @endif
                </span>
            </div>
            @endif
            
            @if($reporte['observaciones'])
            <div class="detail-item">
                <span class="detail-label">Observaciones:</span>
                <span class="detail-value">{{ $reporte['observaciones'] }}</span>
            </div>
            @endif
            
            <div class="detail-item">
                <span class="detail-label">Ubicación:</span>
                <span class="detail-value">
                    <i class="fas fa-map-marker-alt text-danger"></i> 
                    {{ $reporte['latitud'] }}, {{ $reporte['longitud'] }}
                </span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Fecha y Hora:</span>
                <span class="detail-value">{{ now()->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>
        
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>Importante:</strong> Nuestro equipo de rescate revisará su reporte y se pondrá en contacto si es necesario. 
            En caso de emergencia extrema, llame inmediatamente a los servicios de emergencia locales.
        </div>
        
        <div class="row mt-4">
            <div class="col-6">
                <a href="{{ route('reporte-rapido') }}" class="btn btn-outline-primary btn-block">
                    <i class="fas fa-plus"></i> Nuevo Reporte
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('login') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-home"></i> Volver al Login
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
