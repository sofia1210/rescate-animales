<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rescate Animales')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('Fotos/Patota.png') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <div class="ml-auto d-flex align-items-center">
            <span class="mr-2">Rol:</span>
            <select id="roleSwitcher" class="form-control form-control-sm" style="width:auto;">
                <option value="Ciudadano">Ciudadano</option>
                <option value="Brigadista">Brigadista</option>
                <option value="Cuidador">Cuidador</option>
                <option value="Veterinario">Veterinario</option>
                <option value="Administrador">Administrador</option>
            </select>
            <span id="roleBadge" class="badge badge-info ml-2">Ciudadano</span>
        </div>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <img src="{{ asset('Fotos/Patota.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><b>Rescate</b>Animales</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <!-- Menú lateral: ajustar visibilidad por rol según diagrama -->
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item" data-role-allowed="Ciudadano,Brigadista,Cuidador,Veterinario,Administrador">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i><p>Inicio</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Brigadista,Cuidador,Veterinario,Administrador">
                        <a href="{{ route('animales.index') }}" class="nav-link {{ request()->is('animales*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paw"></i><p>Animales</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Ciudadano,Veterinario,Administrador">
                        <a href="{{ route('adopciones.index') }}" class="nav-link {{ request()->is('adopciones*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-heart"></i><p>Adopciones</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i><p>Reportes</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('centros.index') }}" class="nav-link {{ request()->is('centros*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i><p>Centros</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Ciudadano,Brigadista,Cuidador,Veterinario,Administrador">
                        <a href="{{ route('perfil.index') }}" class="nav-link {{ request()->is('perfil*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i><p>Perfil</p>
                        </a>
                    </li>
                </ul>
            </nav>
            {{-- ========================================================== --}}
            {{--         SECCIÓN DE CERRAR SESIÓN (AL FINAL)                --}}
            {{-- ========================================================== --}}
             <div class="sidebar-footer">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="/login" class="nav-link bg-danger">
                            <i class="nav-icon fas fa-right-from-bracket"></i>
                            <p>Cerrar Sesión</p>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2024-{{ date('Y') }} <a href="#">Rescate Animales</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- Librerías JS (asegurar Bootstrap antes de AdminLTE) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
if (typeof window.jQuery === 'undefined') {
    document.write('<script src="{{ asset("vendor/jquery/jquery.min.js") }}"><\/script>');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@yield('js')

</body>
</html>

<!-- Script de cambio de rol: añade clase al body para el tema -->
<script>
(function() {
    const ROLE_KEY = 'app_role';
    const DEFAULT_ROLE = 'Ciudadano';
    const roleSwitcher = document.getElementById('roleSwitcher');
    const roleBadge = document.getElementById('roleBadge');

    function parseAllowed(el) {
        const val = el.getAttribute('data-role-allowed') || '';
        return val.split(',').map(s => s.trim()).filter(Boolean);
    }

    function applyRole(role) {
        if (roleBadge) roleBadge.textContent = role;
        document.querySelectorAll('[data-role-allowed]').forEach(el => {
            const allowed = parseAllowed(el);
            const visible = allowed.length === 0 || allowed.includes(role);
            el.classList.toggle('role-hidden', !visible);
        });
        localStorage.setItem(ROLE_KEY, role);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const saved = localStorage.getItem(ROLE_KEY) || DEFAULT_ROLE;
        if (roleSwitcher) {
            roleSwitcher.value = saved;
            roleSwitcher.addEventListener('change', function(e) {
                applyRole(e.target.value);
            });
        }
        applyRole(saved);
    });

    // Shim de compatibilidad para data-bs-* en Bootstrap 4
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('[data-bs-toggle="modal"],[data-toggle="modal"]');
        if (!trigger) return;
        const sel = trigger.getAttribute('data-bs-target') || trigger.getAttribute('data-target') || trigger.getAttribute('href');
        if (sel && window.jQuery) {
            e.preventDefault();
            $(sel).modal('show');
        }
    });
    document.addEventListener('click', function(e) {
        const dismiss = e.target.closest('[data-bs-dismiss="modal"],[data-dismiss="modal"]');
        if (!dismiss) return;
        const modal = dismiss.closest('.modal');
        if (modal && window.jQuery) {
            e.preventDefault();
            $(modal).modal('hide');
        }
    });
})();
</script>
<style>
.role-hidden { display: none !important; }
/* Se quita todo el CSS de "colores según rol" */
</style>

@yield('js')