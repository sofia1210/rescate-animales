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
    <style>
        .role-hidden { display: none !important; }
    </style>
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
                <option value="Encargado">Encargado</option>
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
                    <li class="nav-item" data-role-allowed="Cuidador,Veterinario,Encargado,Administrador">
                        <a href="{{ route('animales.index') }}" class="nav-link {{ request()->is('animales*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paw"></i><p>Animales</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Ciudadano,Cuidador,Rescatista,Veterinario,Encargado,Administrador">
                        <a href="{{ route('adopciones.index') }}" class="nav-link {{ request()->is('adopciones*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-heart"></i><p>Adopciones</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i><p>Reportes</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador,Encargado">
                        <a href="{{ route('hallazgos.index') }}" class="nav-link {{ request()->is('hallazgos*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-location-dot"></i><p>Hallazgos</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador,Encargado">
                        <a href="{{ route('personas.index') }}" class="nav-link {{ request()->is('personas*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i><p>Personas</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('veterinarios.index') }}" class="nav-link {{ request()->is('veterinarios*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-doctor"></i><p>Veterinarios</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('rescatistas.index') }}" class="nav-link {{ request()->is('rescatistas*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-people-carry-box"></i><p>Rescatistas</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('centros.index') }}" class="nav-link {{ request()->is('centros*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i><p>Centros</p>
                        </a>
                    </li>
                    <!-- Cuidadores ahora es un flag en Persona -->
                    <li class="nav-item" data-role-allowed="Administrador">
                        <!-- Hoja de Vida fusionada en Gestión de Animales -->
                    </li>
                    <li class="nav-item" data-role-allowed="Veterinario,Administrador">
                        <a href="{{ route('evaluaciones.index') }}" class="nav-link {{ request()->is('evaluaciones*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope"></i><p>Evaluaciones Médicas</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Veterinario,Cuidador,Administrador">
                        <a href="{{ route('cuidados.index') }}" class="nav-link {{ request()->is('cuidados*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding-heart"></i><p>Cuidados</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Administrador">
                        <a href="{{ route('traslados.index') }}" class="nav-link {{ request()->is('traslados*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck-medical"></i><p>Traslados</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Ciudadano,Cuidador,Rescatista,Veterinario,Encargado,Administrador">
                        <a href="{{ route('liberaciones.index') }}" class="nav-link {{ request()->is('liberaciones*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dove"></i><p>Liberaciones</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Ciudadano,Rescatista,Cuidador,Veterinario,Administrador">
                        <a href="{{ route('perfil.index') }}" class="nav-link {{ request()->is('perfil*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i><p>Perfil</p>
                        </a>
                    </li>
                    <li class="nav-item" data-role-allowed="Ciudadano,Rescatista">
                        <a href="{{ route('mis-hallazgos.index') }}" class="nav-link {{ request()->is('mis-hallazgos*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-location-dot"></i><p>Mis Hallazgos</p>
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
    // Bootstrap de rol desde la sesión del login (flash)
    const INIT_ROLE = {!! json_encode(session('set_role')) !!};

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
            let permitted = allowed.length === 0 || allowed.includes(role);
            if (role === 'Administrador') permitted = true;
            const visibility = (el.getAttribute('data-role-visibility') || 'hide').toLowerCase();
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

        // Restricción global por defecto para Encargado (solo lectura),
        // exceptuando elementos marcados explícitamente como permitidos.
        if (role === 'Encargado') {
            const interactive = Array.from(document.querySelectorAll('button, .btn, input[type="submit"], input[type="button"]'));
            interactive.forEach(target => {
                if (target.closest('.navbar') || target.closest('.main-sidebar')) return;
                if (target.hasAttribute('data-encargado-allowed')) return;
                target.classList.add('role-disabled','disabled');
                target.setAttribute('aria-disabled','true');
                target.style.pointerEvents = 'none';
                target.tabIndex = -1;
                const colorClass = Array.from(target.classList).find(c => /^(btn-primary|btn-success|btn-info|btn-warning|btn-danger|btn-dark|btn-light|btn-outline-.*)$/.test(c));
                if (colorClass) {
                    if (!target.dataset.roleOriginalBtnColor) target.dataset.roleOriginalBtnColor = colorClass;
                    target.classList.remove(colorClass);
                    target.classList.add('btn-secondary');
                }
            });
        }

        localStorage.setItem(ROLE_KEY, role);
    }

    document.addEventListener('DOMContentLoaded', function() {
        let saved = localStorage.getItem(ROLE_KEY) || DEFAULT_ROLE;
        if (INIT_ROLE) {
            saved = INIT_ROLE;
            localStorage.setItem(ROLE_KEY, saved);
        }
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
                Especie: { pk: 'especie_id' },
                Raza: { pk: 'raza_id' },
                Estado_Animal: { pk: 'estado_id' },
                Hoja_Animal: { pk: 'hoja_animal_id' },
                Evaluacion_Medica: { pk: 'evaluacion_id' },
                Tipo_Tratamiento: { pk: 'tratamiento_id' },
                Tipo_Cuidado: { pk: 'tipo_cuidado_id' },
                Cuidado: { pk: 'cuidado_id' },
                Traslado: { pk: 'traslado_id' },
                Adopcion: { pk: 'adopcion_id' },
                Liberacion: { pk: 'liberacion_id' },
                Reporte: { pk: 'reporte_id' },
                Solicitud_Rol: { pk: 'solicitud_id' },
                Persona: { pk: 'persona_id' },
                Veterinario: { pk: 'veterinario_id' },
                Rescatista: { pk: 'rescatista_id' },
                Cuidador: { pk: 'cuidador_id' }
            };
            const data = {
                Centro: [
                    { centro_id: 1, nombre: 'Centro Norte', direccion: 'Av. Beni 123', latitud: -17.7500, longitud: -63.2000, contacto: '999-111' },
                    { centro_id: 2, nombre: 'Centro Sur', direccion: 'Av. Santos Dumont 456', latitud: -17.8400, longitud: -63.1700, contacto: '999-222' },
                ],
                Tipo_Animal: [
                    { tipo_id: 1, nombre: 'Perro', permite_adopcion: 1, permite_liberacion: 0 },
                    { tipo_id: 2, nombre: 'Gato', permite_adopcion: 1, permite_liberacion: 0 },
                    { tipo_id: 3, nombre: 'Ave', permite_adopcion: 0, permite_liberacion: 1 },
                ],
                Especie: [
                    { especie_id: 1, nombre: 'Canino' },
                    { especie_id: 2, nombre: 'Felino' },
                    { especie_id: 3, nombre: 'Ave' },
                ],
                Raza: [
                    { raza_id: 1, especie_id: 1, nombre: 'Labrador' },
                    { raza_id: 2, especie_id: 2, nombre: 'Siamés' },
                    { raza_id: 3, especie_id: 3, nombre: 'Loro' },
                ],
                Estado_Animal: [
                    { estado_id: 1, nombre: 'Malo' },
                    { estado_id: 2, nombre: 'Bueno' },
                ],
                Hoja_Animal: [
                    { hoja_animal_id: 1, nombre: 'Firulais', tipo_id: 1, especie_id: 1, raza_id: 1, estado_id: 2, centro_id: 1, adopcion_id: null, liberacion_id: null },
                    { hoja_animal_id: 2, nombre: 'Luna', tipo_id: 2, especie_id: 2, raza_id: 2, estado_id: 2, centro_id: 2, adopcion_id: null, liberacion_id: null },
                    { hoja_animal_id: 3, nombre: 'Lorito', tipo_id: 3, especie_id: 3, raza_id: 3, estado_id: 1, centro_id: 3, adopcion_id: null, liberacion_id: null },
                ],
                Evaluacion_Medica: [
                    { evaluacion_id: 1, hoja_animal_id: 1, tratamiento_id: 1, descripcion: 'Vacunación anual', fecha: '2025-09-10', veterinario_id: 1 },
                    { evaluacion_id: 2, hoja_animal_id: 2, tratamiento_id: 2, descripcion: 'Desparasitación inicial', fecha: '2025-09-12', veterinario_id: 2 },
                ],
                Tipo_Tratamiento: [
                    { tratamiento_id: 1, nombre: 'Vacunación' },
                    { tratamiento_id: 2, nombre: 'Desparasitación' },
                ],
                Tipo_Cuidado: [
                    { tipo_cuidado_id: 1, nombre: 'Alimentación' },
                    { tipo_cuidado_id: 2, nombre: 'Limpieza' },
                ],
                Cuidado: [
                    { cuidado_id: 1, hoja_animal_id: 1, tipo_cuidado_id: 1, fecha: '2025-09-11', detalle: 'Alimento balanceado 500g', cuidador_persona_id: 3 },
                    { cuidado_id: 2, hoja_animal_id: 2, tipo_cuidado_id: 2, fecha: '2025-09-12', detalle: 'Baño y cepillado', cuidador_persona_id: 4 },
                ],
                Traslado: [
                    { traslado_id: 1, rescastista_id: 1, nombre: 'Traslado inicial', centro_id: 1, latitud: -12.12, longitud: -77.12, observaciones: 'Ingreso a Centro Norte', hoja_animal_id: 1 },
                    { traslado_id: 2, rescastista_id: 2, nombre: 'Derivación', centro_id: 2, latitud: -12.10, longitud: -77.11, observaciones: 'Derivado a Centro Sur', hoja_animal_id: 2 },
                ],
                Adopcion: [
                    { adopcion_id: 1, direccion: 'Calle Flores 123', latitud: -12.11, longitud: -77.09, detalle: 'Familia con patio', administrador_id: 99, adoptante_id: 10 },
                ],
                Liberacion: [
                    { liberacion_id: 1, direccion: 'Reserva Natural Norte', detalle: 'Condiciones aptas', latitud: -12.20, longitud: -77.20, aprobada: 1 },
                ],
                Reporte: [
                    { reporte_id: 1, persona_id: 1, tipo_id: 1, aprobado: 0, estado: 'pendiente', imagen_url: 'Fotos/Patota.png', direccion: 'Av. Siempreviva 742', latitud: -12.12, longitud: -77.12, observaciones: 'Animal herido', cantidad_animales: 1 },
                    { reporte_id: 2, persona_id: 2, tipo_id: 2, aprobado: 1, estado: 'aprobado', imagen_url: 'Fotos/R.jpg', direccion: 'Plaza Central 100', latitud: -12.13, longitud: -77.13, observaciones: 'Gato abandonado', cantidad_animales: 1 },
                    { reporte_id: 3, persona_id: 3, tipo_id: 3, aprobado: 0, estado: 'rechazado', imagen_url: 'Fotos/OIP.jpg', direccion: 'Parque del Este', latitud: -12.09, longitud: -77.07, observaciones: 'Ave lastimada', cantidad_animales: 2 },
                    { reporte_id: 4, persona_id: 1, tipo_id: 1, aprobado: 0, estado: 'pendiente', imagen_url: 'Fotos/OIP.jpg', direccion: 'Av. Libertad 555', latitud: -12.15, longitud: -77.10, observaciones: 'Perro agresivo', cantidad_animales: 1 },
                    { reporte_id: 5, persona_id: 3, tipo_id: 3, aprobado: 1, estado: 'aprobado', imagen_url: 'Fotos/R.jpg', direccion: 'Bosque de Pinos', latitud: -12.18, longitud: -77.22, observaciones: 'Ave rescatada', cantidad_animales: 1 },
                ],
                Solicitud_Rol: [
                    { solicitud_id: 1, usuario_id: 200, rol_solicitado: 'Veterinario', motivo: 'Tengo experiencia clínica', estado: 'pendiente', fecha: new Date().toISOString().slice(0,10) },
                    { solicitud_id: 2, usuario_id: 201, rol_solicitado: 'Rescatista', motivo: 'Experiencia en campo', estado: 'pendiente', fecha: new Date().toISOString().slice(0,10) }
                ],
                Persona: [
                    { persona_id: 1, usuario_id: 200, nombre: 'María', apellido: 'García', ci: '123456', telefono: '70000001' },
                    { persona_id: 2, usuario_id: 201, nombre: 'Juan', apellido: 'Pérez', ci: '654321', telefono: '70000002' },
                    { persona_id: 3, usuario_id: 202, nombre: 'Lucía', apellido: 'Ramos', ci: '789123', telefono: '70000003' },
                    { persona_id: 4, usuario_id: 203, nombre: 'Carlos', apellido: 'Flores', ci: '987321', telefono: '70000004' },
                    { persona_id: 5, usuario_id: 204, nombre: 'Ana', apellido: 'Suárez', ci: '222333', telefono: '70000005' },
                    { persona_id: 6, usuario_id: 205, nombre: 'Pedro', apellido: 'Gómez', ci: '333444', telefono: '70000006' }
                ],
                Veterinario: [
                    { veterinario_id: 1, persona_id: 3, especialidad: 'Clínica', cv_documentado: 1 },
                    { veterinario_id: 2, persona_id: 4, especialidad: 'Fauna Silvestre', cv_documentado: 1 },
                ],
                Rescatista: [
                    { rescatista_id: 1, persona_id: 1, cv_documentado: 1 },
                    { rescatista_id: 2, persona_id: 2, cv_documentado: 1 }
                ],
                Cuidador: [
                    { cuidador_id: 1, usuario_id: 300, fecha_compromiso: '2025-09-01' },
                    { cuidador_id: 2, usuario_id: 301, fecha_compromiso: '2025-09-10' },
                    { cuidador_id: 3, usuario_id: 302, fecha_compromiso: '2025-09-15' },
                ]
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
    (function() {
        const form = document.getElementById('form-solicitar-rol');
        if (!form) return;
        form.addEventListener('submit', function(ev) {
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

    // Helper global: crea tile layer con fallback de proveedores
    window.createLeafletTileWithFallback = function(map) {
        const providers = [
            { url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', attr: '© OpenStreetMap contributors' },
            { url: 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', attr: '© OpenStreetMap France, HOT' },
            { url: 'https://{s}.tile.openstreetmap.de/{z}/{x}/{y}.png', attr: '© OpenStreetMap DE' },
            { url: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', attr: '© Carto, © OpenStreetMap' }
        ];
        let idx = 0;
        let layer = null;

        function use(i) {
            if (layer) { try { map.removeLayer(layer); } catch(e) {} }
            const p = providers[i];
            layer = L.tileLayer(p.url, { attribution: p.attr });
            layer.on('tileerror', function() {
                idx++;
                if (idx < providers.length) {
                    console.warn('Proveedor de mapas falló, cambiando al siguiente:', p.url);
                    use(idx);
                } else {
                    console.error('No se pudo cargar ningún proveedor de mapas');
                }
            });
            layer.addTo(map);
        }

        use(0);
        return layer;
    };
})();
</script>
@yield('js')
</body>
</html>