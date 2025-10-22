<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte Rápido - Rescate Animales</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        .map-container {
            height: 600px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }
        .emergency-header {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .ci-field {
            display: none;
        }
        .content-wrapper {
            margin-left: 0 !important;
        }
        .main-header {
            margin-left: 0 !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('login') }}" class="nav-link">
                    <i class="fas fa-arrow-left"></i> Volver al Login
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 text-center">
                        <h1 class="m-0">Reporte Rápido de Emergencia</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="emergency-header text-center">
                            <h3>Reporte de Animales en Riesgo</h3>
                            <p class="mb-0">Complete el formulario para reportar animales en situación de emergencia</p>
                        </div>

                        <div class="row">
                            <!-- Mapa -->
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h3 class="card-title">Ubicación del Reporte</h3>
                                    </div>
                                    <div class="card-body p-0 d-flex flex-column">
                                        <div id="map" class="map-container"></div>
                                        <div class="p-3 border-top">
                                            <div class="alert alert-info mb-0" role="alert">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Haga clic en el mapa para marcar la ubicación exacta del reporte.
                                                Puede arrastrar el marcador, hacer zoom y usar su ubicación actual
                                                desde el botón del formulario.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulario -->
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h3 class="card-title">Información del Reporte</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="reporteForm" action="{{ route('reporte-rapido.store') }}" method="POST">
                                            @csrf
                                            
                                            <!-- Tipo de reporte -->
                                            <div class="form-group">
                                                <label>Tipo de Emergencia</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_emergencia" id="incendio" value="incendio" checked>
                                                    <label class="form-check-label" for="incendio">
                                                        Animales en Incendio
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_emergencia" id="otro" value="otro">
                                                    <label class="form-check-label" for="otro">
                                                        Otra Emergencia
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Tipo de usuario -->
                                            <div class="form-group">
                                                <label>¿Qué tipo de usuario es usted?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_usuario" id="reportante" value="reportante" checked>
                                                    <label class="form-check-label" for="reportante">Solo estoy reportando</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_usuario" id="rescatista" value="rescatista">
                                                    <label class="form-check-label" for="rescatista">Soy rescatista</label>
                                                </div>
                                            </div>

                                            <!-- Campo CI para rescatistas -->
                                            <div class="form-group ci-field" id="ciField">
                                                <label for="ci">Cédula de Identidad</label>
                                                <input type="text" class="form-control" id="ci" name="ci" placeholder="Ingrese su CI">
                                            </div>

                                            <!-- Cantidad de animales -->
                                            <div class="form-group">
                                                <label for="cantidad_animales">Cantidad de animales</label>
                                                <input type="number" class="form-control" id="cantidad_animales" name="cantidad_animales" placeholder="Ingrese un número" min="1" required>
                                            </div>

                                            <!-- Tipo de animales -->
                                            <div class="form-group">
                                                <label>Tipo de animales (Opcional)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_animal" id="domesticos" value="domesticos">
                                                    <label class="form-check-label" for="domesticos">
                                                        Domésticos
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_animal" id="silvestres" value="silvestres">
                                                    <label class="form-check-label" for="silvestres">
                                                        Silvestres
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_animal" id="mixtos" value="mixtos">
                                                    <label class="form-check-label" for="mixtos">
                                                        Mixtos
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Observaciones -->
                                            <div class="form-group">
                                                <label for="observaciones">Observaciones adicionales</label>
                                                <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Describa la situación, estado de los animales, condiciones del lugar, etc."></textarea>
                                            </div>

                                            <!-- Coordenadas ocultas -->
                                            <input type="hidden" id="latitud" name="latitud">
                                            <input type="hidden" id="longitud" name="longitud">

                                            <!-- Llevar a un centro -->
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="llevarCentro" name="llevar_centro">
                                                    <label class="form-check-label" for="llevarCentro">Estoy llevando al animal a un centro</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-none" id="centroDestinoGroup">
                                                <label for="centro_destino">Centro de destino</label>
                                                <select class="form-control" id="centro_destino" name="centro_destino">
                                                    <option value="">Seleccione un centro</option>
                                                    <option value="Centro de Rescate Animal Central">Centro de Rescate Animal Central</option>
                                                    <option value="Centro Municipal de Bienestar Animal">Centro Municipal de Bienestar Animal</option>
                                                    <option value="Refugio Amigos de los Animales">Refugio Amigos de los Animales</option>
                                                </select>
                                            </div>

                                            <!-- Botón de envío -->
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger btn-lg btn-block">Enviar Reporte</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Rescate Animales</b> - Sistema de Emergencias
        </div>
        <strong>Copyright &copy; 2024 <a href="#">Rescate Animales</a>.</strong> Todos los derechos reservados.
    </footer>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar Envío de Reporte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <p class="mb-3">¿Está seguro de que desea enviar este reporte de emergencia?</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Importante:</strong> Una vez enviado, el reporte será procesado por nuestro equipo de rescate.
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-danger" id="confirmarEnvio">
                    <i class="fas fa-paper-plane mr-2"></i>Enviar Reporte
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4: necesario para $('#modal-default').modal('show') -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    
    var map = L.map('map').setView([-17.7833, -63.1833], 13); 
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = null;

    
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        
        marker = L.marker(e.latlng).addTo(map);
        
        
        document.getElementById('latitud').value = e.latlng.lat;
        document.getElementById('longitud').value = e.latlng.lng;
    });

    
    document.querySelectorAll('input[name="tipo_usuario"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const ciField = document.getElementById('ciField');
            const ciInput = document.getElementById('ci');
            
            if (this.value === 'rescatista') {
                ciField.style.display = 'block';
                ciInput.required = true;
            } else {
                ciField.style.display = 'none';
                ciInput.required = false;
                ciInput.value = '';
            }
        });
    });

    
    // Mostrar/ocultar selección de centro
    document.getElementById('llevarCentro').addEventListener('change', function() {
        const group = document.getElementById('centroDestinoGroup');
        const select = document.getElementById('centro_destino');
        if (this.checked) {
            group.classList.remove('d-none');
            select.required = true;
        } else {
            group.classList.add('d-none');
            select.required = false;
            select.value = '';
        }
    });
    
    // Validación antes de enviar + modal de confirmación (si hay jQuery)
    document.getElementById('reporteForm').addEventListener('submit', function(e) {
        const latitud = document.getElementById('latitud').value;
        const longitud = document.getElementById('longitud').value;
        if (!latitud || !longitud) {
            e.preventDefault();
            alert('Por favor, marque la ubicación en el mapa antes de enviar el reporte.');
            return;
        }
        const llevarCentro = document.getElementById('llevarCentro').checked;
        const centro = document.getElementById('centro_destino').value;
        if (llevarCentro && !centro) {
            e.preventDefault();
            alert('Seleccione el centro de destino.');
            return;
        }
        if (window.jQuery) {
            e.preventDefault();
            $('#modal-default').modal('show');
        }
    });

    
    document.getElementById('confirmarEnvio').addEventListener('click', function() {
        $('#modal-default').modal('hide');
        
        
        document.getElementById('reporteForm').submit();
    });
</script>
</body>
</html>
