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
                <option value="Rescatista">Rescatista</option>
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
                    <li class="nav-item" data-role-allowed="Ciudadano,Rescatista,Cuidador,Veterinario,Administrador">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i><p>Inicio</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Rescatista,Cuidador,Veterinario,Administrador">
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
                    <li class="nav-item" data-role-allowed="Ciudadano,Rescatista,Cuidador,Veterinario,Administrador">
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

    function findInteractiveTargets(el) {
        const selector = 'a, button, .btn, .nav-link, input[type="button"], input[type="submit"]';
        return el.matches(selector) ? [el] : Array.from(el.querySelectorAll(selector));
    }

    function applyRole(role) {
        if (roleBadge) roleBadge.textContent = role;

        document.querySelectorAll('[data-role-allowed]').forEach(el => {
            const allowed = parseAllowed(el);
            const permitted = allowed.length === 0 || allowed.includes(role);
            if (role === 'Administrador') permitted = true;
            const visibility = (el.getAttribute('data-role-visibility') || 'hide').toLowerCase(); // 'hide' | 'disable'
            const targets = findInteractiveTargets(el);

            const enableTarget = (target) => {
                target.classList.remove('role-disabled','disabled','btn-secondary');
                target.removeAttribute('aria-disabled');
                target.style.pointerEvents = '';
                target.tabIndex = 0;
                if (target.dataset.roleOriginalHref) {
                    target.setAttribute('href', target.dataset.roleOriginalHref);
                    delete target.dataset.roleOriginalHref;
                }
                if (target.dataset.roleOriginalBtnColor) {
                    target.classList.add(target.dataset.roleOriginalBtnColor);
                    target.classList.remove('btn-secondary');
                    delete target.dataset.roleOriginalBtnColor;
                }
            };

            const disableTarget = (target) => {
                target.classList.add('role-disabled','disabled');
                target.setAttribute('aria-disabled','true');
                target.style.pointerEvents = 'none';
                target.tabIndex = -1;

                if (target.tagName === 'A') {
                    if (!target.dataset.roleOriginalHref && target.hasAttribute('href')) {
                        target.dataset.roleOriginalHref = target.getAttribute('href');
                    }
                    target.setAttribute('href','javascript:void(0)');
                }

                if (target.classList.contains('btn')) {
                    const colorClass = Array.from(target.classList).find(c =>
                        /^(btn-primary|btn-success|btn-info|btn-warning|btn-danger|btn-dark|btn-light|btn-outline-.*)$/.test(c)
                    );
                    if (colorClass && !target.dataset.roleOriginalBtnColor) {
                        target.dataset.roleOriginalBtnColor = colorClass;
                        target.classList.remove(colorClass);
                    }
                    target.classList.add('btn-secondary');
                }
            };

            if (permitted) {
                el.classList.remove('role-hidden');
                targets.forEach(enableTarget);
            } else {
                if (visibility === 'disable') {
                    el.classList.remove('role-hidden');
                    targets.forEach(disableTarget);
                } else {
                    el.classList.add('role-hidden');
                    // Limpia cualquier estado previo de deshabilitado si aplica
                    targets.forEach(enableTarget);
                }
            }
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

    // Definición y datos semilla de MockDB (solo si no existe)
    if (!window.MockDB) {
        const MockDB = (function() {
            const schema = {
                Centro: { pk: 'centro_id' },
                Tipo_Animal: { pk: 'tipo_id' },
                Hoja_Animal: { pk: 'hoja_animal_id' },
                Evaluacion_Medica: { pk: 'evaluacion_id' },
                Tipo_Tratamiento: { pk: 'tratamiento_id' },
                Tipo_Cuidado: { pk: 'tipo_cuidado_id' },
                Cuidado: { pk: 'cuidado_id' },
                Traslado: { pk: 'traslado_id' },
                Adopcion: { pk: 'adopcion_id' },
                Liberacion: { pk: 'liberacion_id' },
                Reporte: { pk: 'reporte_id' },
                Solicitud_Rol: { pk: 'solicitud_id' }
            };
            const data = {
                Centro: [
                    { centro_id: 1, nombre: 'Centro Norte', direccion: 'Av. Norte 123', latitud: -12.05, longitud: -77.05, contacto: '999-111' },
                    { centro_id: 2, nombre: 'Centro Sur', direccion: 'Av. Sur 456', latitud: -12.10, longitud: -77.10, contacto: '999-222' },
                ],
                Tipo_Animal: [
                    { tipo_id: 1, nombre: 'Perro', permite_adopcion: 1, permite_liberacion: 0 },
                    { tipo_id: 2, nombre: 'Gato', permite_adopcion: 1, permite_liberacion: 0 },
                    { tipo_id: 3, nombre: 'Ave', permite_adopcion: 0, permite_liberacion: 1 },
                ],
                Hoja_Animal: [
                    { hoja_animal_id: 1, nombre: 'Firulais', tipo_id: 1, estado_id: 1, centro_id: 1, adopcion_id: null, liberacion_id: null },
                ],
                Evaluacion_Medica: [],
                Tipo_Tratamiento: [
                    { tratamiento_id: 1, nombre: 'Vacunación' },
                    { tratamiento_id: 2, nombre: 'Desparasitación' },
                ],
                Tipo_Cuidado: [
                    { tipo_cuidado_id: 1, nombre: 'Alimentación' },
                    { tipo_cuidado_id: 2, nombre: 'Limpieza' },
                ],
                Cuidado: [],
                Traslado: [],
                Adopcion: [],
                Liberacion: [],
                Reporte: [
                    { reporte_id: 1, tipo_id: 1, aprobado: 1, imagen_url: 'Fotos/Patota.png', direccion: 'Av. Siempreviva 742', latitud: -12.12, longitud: -77.12 }
                ],
                Solicitud_Rol: []
            };
            const nextId = Object.keys(schema).reduce((acc, name) => {
                const pk = schema[name].pk;
                const rows = data[name] || [];
                const max = rows.reduce((m, r) => Math.max(m, Number(r[pk] || 0)), 0);
                acc[name] = max + 1;
                return acc;
            }, {});
            const api = {
                schema,
                get(name) { return (data[name] || []).map(r => ({...r})); },
                find(name, id) { const pk = schema[name].pk; return (data[name] || []).find(r => Number(r[pk]) === Number(id)) || null; },
                create(name, row) {
                    const pk = schema[name].pk;
                    const id = row[pk] ? Number(row[pk]) : nextId[name]++;
                    const rec = { ...row, [pk]: id };
                    data[name] = data[name] || [];
                    data[name].push(rec);
                    return { ...rec };
                },
                update(name, row) {
                    const pk = schema[name].pk;
                    const id = Number(row[pk]);
                    if (!id) return null;
                    const arr = data[name] || [];
                    const idx = arr.findIndex(r => Number(r[pk]) === id);
                    if (idx >= 0) {
                        arr[idx] = { ...arr[idx], ...row };
                        return { ...arr[idx] };
                    }
                    return null;
                },
                remove(name, id) {
                    const pk = schema[name].pk;
                    const arr = data[name] || [];
                    const i = arr.findIndex(r => Number(r[pk]) === Number(id));
                    if (i >= 0) arr.splice(i, 1);
                }
            };
            return api;
        })();
        window.MockDB = MockDB;
    }

    // Eliminado: listener de formulario de solicitud en layout (se gestiona en Perfil)
    document.getElementById('form-solicitar-rol').addEventListener('submit', function(ev) {
        ev.preventDefault();
        const usuarioId = 100; // simulado
        const rol = (document.getElementById('rol-solicitado').value || '').trim();
        const motivo = (document.getElementById('rol-motivo').value || '').trim();
        if (!rol) return;

        window.MockDB.create('Solicitud_Rol', {
            usuario_id: usuarioId,
            rol_solicitado: rol,
            motivo: motivo,
            estado: 'pendiente',
            fecha: new Date().toISOString().slice(0,10)
        });

        $('#solicitarRolModal').modal('hide');
        setTimeout(() => alert('Solicitud enviada. Un Administrador la revisará.'), 100);
    });
})();
</script>
</body>
</html>