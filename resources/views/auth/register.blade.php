<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Rescate Animales</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Rescate</b>Animales</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registrar una nueva cuenta</p>

                <form action="#" method="post">
                    @csrf
                    <!-- Nombre -->
                    <div class="input-group mb-3">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                               placeholder="Nombre" value="{{ old('nombre') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                        </div>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Apellido -->
                    <div class="input-group mb-3">
                        <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" 
                               placeholder="Apellido" value="{{ old('apellido') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-id-card-alt"></span></div>
                        </div>
                        @error('apellido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Nombre de usuario -->
                    <div class="input-group mb-3">
                        <input type="text" name="usuario" class="form-control @error('usuario') is-invalid @enderror" 
                               placeholder="Nombre de usuario" value="{{ old('usuario') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               placeholder="Correo electrónico" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Contraseña" required>
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" 
                               placeholder="Confirmar contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               placeholder="Teléfono" value="{{ old('phone') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        
                   
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block align-center">Registrar</button>
                        </div>
                       
                    </div>
                </form>

             


                <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
            </div>
            
        </div>
        
    </div>
   

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
