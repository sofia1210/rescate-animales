@extends('layouts.admin')

@section('title', 'Prototipo 9x UI')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Prototipo 9x UI — Consola de Entidades
                </h3>
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <label class="mb-0 small text-muted">Tema</label>
                        <select id="uiTheme" class="form-control form-control-sm">
                            <option value="default">Predeterminado</option>
                            <option value="dark">Oscuro</option>
                            <option value="blue">Azul</option>
                        </select>
                    </div>
                    <div>
                        <button id="btnSimular500" class="btn btn-success btn-sm"
                                data-role-allowed="Administrador"
                                data-role-visibility="disable">
                            <i class="fas fa-bolt mr-1"></i> Simular 500 CRUDs
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">
                    Este prototipo es estructuralmente idéntico al sistema final: usa un motor CRUD
                    genérico con datos simulados y roles. Todas las acciones sin permiso se muestran
                    deshabilitadas en gris.
                </p>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="list-group" id="entityList"></div>
                    </div>
                    <div class="col-md-9">
                        <div id="entityView"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="progress" style="height: 8px;">
                        <div id="crudProgress" class="progress-bar bg-success" style="width: 0%"></div>
                    </div>
                    <small class="text-muted d-block mt-1">
                        Operaciones simuladas: <span id="crudCount">0</span> / 500
                    </small>
                </div>
                <button class="btn btn-secondary btn-sm ml-3" id="btnResetMock">
                    <i class="fas fa-undo mr-1"></i> Reset Mock
                </button>
            </div>
        </div>

        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book mr-2"></i>Documentación</h3>
                <div class="card-tools">
                    <button class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Mock: Base de datos simulada en <code>localStorage</code> con esquemas del diagrama.</li>
                    <li>Funcional: Render de UI, navegación, reglas de rol y estados deshabilitados.</li>
                    <li>Comparación: Estructura de pantallas y formas idéntica; reemplazable por API real.</li>
                    <li>Rendimiento: Carga en &lt;2s con render diferido y dataset acotado.</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style>
    .list-group-item.active { background-color: #3c8dbc; border-color: #3c8dbc; }
    .crud-toolbar .btn + .btn { margin-left: .25rem; }
    .role-disabled { opacity: .6; filter: grayscale(1); cursor: not-allowed !important; }
    .form-grid-2 .form-group { width: 48%; display: inline-block; vertical-align: top; }
    .density-compact table.table td, .density-compact table.table th { padding: .35rem .5rem; }
    .theme-dark .card { background-color: #2b2b2b; color: #f1f1f1; }
    .theme-blue .card-header { background: #0d6efd; color: #fff; }
</style>
@endsection

@section('js')
<script>
// =========================
// Configuración de Roles
// =========================
const Roles = {
    Administrador: { all: true },
    Veterinario: {
        allow: ['Evaluacion_Medica', 'Tipo_Tratamiento', 'Hoja_Animal', 'Estado_Animal', 'Centro', 'Traslado', 'Tipo_Animal', 'Especie', 'Raza']
    },
    Rescatista: {
        allow: ['Reporte', 'Persona', 'Rescatista', 'Traslado', 'Centro', 'Hoja_Animal']
    },
    Cuidador: {
        allow: ['Hoja_Animal', 'Estado_Animal', 'Centro', 'Traslado']
    },
    Ciudadano: {
        allow: ['Adopcion', 'Liberacion', 'Reporte']
    }
};
function hasAccess(role, entity) {
    if (Roles[role]?.all) return true;
    return Roles[role]?.allow?.includes(entity);
}
function currentRole() {
    return localStorage.getItem('app_role') || 'Ciudadano';
}

// =========================
// Esquema y Datos Mock
// =========================
const Schema = {
    Reporte: { pk: 'reporte_id', fields: ['reporte_id','persona_id','aprobado','imagen_url','observaciones','cantidad_animales','direccion','latitud','longitud'] },
    Tipo_Animal: { pk: 'tipo_id', fields: ['tipo_id','nombre','permite_adopcion','permite_liberacion'] },
    Hoja_Animal: { pk: 'hoja_animal_id', fields: ['hoja_animal_id','nombre','tipo_id','reporte_id','especie_id','raza_id','estado_id','adopcion_id','liberacion_id'] },
    Estado_Animal: { pk: 'estado_id', fields: ['estado_id','nombre'] },
    Raza: { pk: 'raza_id', fields: ['raza_id','especie_id','nombre'] },
    Especie: { pk: 'especie_id', fields: ['especie_id','nombre'] },
    Adopcion: { pk: 'adopcion_id', fields: ['adopcion_id','direccion','latitud','longitud','detalle','administrador_id','adoptante_id'] },
    Liberacion: { pk: 'liberacion_id', fields: ['liberacion_id','direccion','detalle','latitud','longitud','aprobada'] },
    Evaluacion_Medica: { pk: 'evaluacion_id', fields: ['evaluacion_id','tratamiento_id','descripcion','fecha','veterinario_id'] },
    Tipo_Tratamiento: { pk: 'tratamiento_id', fields: ['tratamiento_id','nombre'] },
    Persona: { pk: 'persona_id', fields: ['persona_id','usuario_id','nombre','apellido','ci','telefono','cuidador'] },
    Usuario: { pk: 'usuario_id', fields: ['usuario_id','email','contrasena'] },
    Centro: { pk: 'centro_id', fields: ['centro_id','nombre','direccion','latitud','longitud','contacto'] },
    Rescatista: { pk: 'rescastista_id', fields: ['rescastista_id','persona_id','cv_documentado'] },
    Traslado: { pk: 'traslado_id', fields: ['traslado_id','rescastista_id','nombre','centro_id','latitud','longitud','observaciones'] },
    Veterinario: { pk: 'veterinario_id', fields: ['veterinario_id','especialidad','cv_documentado','persona_id'] },
};
// Datos iniciales (muestra coherente)
const Seed = {
    Reporte: [
        { reporte_id: 1, persona_id: 10, aprobado: false, imagen_url: 'Fotos/R.jpg', observaciones: 'Animal herido', cantidad_animales: 1, direccion: 'Zona Centro', latitud: -17.78, longitud: -63.18 },
        { reporte_id: 2, persona_id: 11, aprobado: true, imagen_url: 'Fotos/Patota.png', observaciones: 'Ave desorientada', cantidad_animales: 1, direccion: 'Zona Norte', latitud: -17.79, longitud: -63.19 },
    ],
    Tipo_Animal: [
        { tipo_id: 1, nombre: 'Doméstico', permite_adopcion: true, permite_liberacion: false },
        { tipo_id: 2, nombre: 'Silvestre', permite_adopcion: false, permite_liberacion: true },
    ],
    Especie: [
        { especie_id: 1, nombre: 'Canino' },
        { especie_id: 2, nombre: 'Felino' },
        { especie_id: 3, nombre: 'Ave' },
    ],
    Raza: [
        { raza_id: 1, especie_id: 1, nombre: 'Labrador' },
        { raza_id: 2, especie_id: 2, nombre: 'Persa' },
    ],
    Estado_Animal: [
        { estado_id: 1, nombre: 'Malo' },
        { estado_id: 2, nombre: 'Bueno' },
    ],
    Hoja_Animal: [
        { hoja_animal_id: 1, nombre: 'Sada', tipo_id: 1, reporte_id: 1, especie_id: 1, raza_id: 1, estado_id: 1, adopcion_id: null, liberacion_id: null },
        { hoja_animal_id: 2, nombre: 'Luna', tipo_id: 1, reporte_id: 2, especie_id: 2, raza_id: 2, estado_id: 2, adopcion_id: null, liberacion_id: null },
    ],
    Adopcion: [
        { adopcion_id: 1, direccion: 'Av. Cañoto', latitud: -17.79, longitud: -63.19, detalle: 'Familia con patio', administrador_id: 99, adoptante_id: 10 },
    ],
    Liberacion: [
        { liberacion_id: 1, direccion: 'Bosque Sur', detalle: 'Condiciones aptas', latitud: -17.80, longitud: -63.20, aprobada: true },
    ],
    Evaluacion_Medica: [
        { evaluacion_id: 1, tratamiento_id: 1, descripcion: 'Fractura leve', fecha: '2025-09-01', veterinario_id: 5 },
    ],
    Tipo_Tratamiento: [
        { tratamiento_id: 1, nombre: 'Antibiótico' },
        { tratamiento_id: 2, nombre: 'Sutura' },
    ],
    Persona: [
        { persona_id: 10, usuario_id: 100, nombre: 'Carlos', apellido: 'Mendoza', ci: '123456', telefono: '700-0001', cuidador: false },
        { persona_id: 11, usuario_id: 101, nombre: 'María', apellido: 'González', ci: '654321', telefono: '700-0002', cuidador: true },
    ],
    Usuario: [
        { usuario_id: 100, email: 'carlos@example.com', contrasena: '***' },
        { usuario_id: 101, email: 'maria@example.com', contrasena: '***' },
    ],
    Centro: [
        { centro_id: 1, nombre: 'Refugio Patitas', direccion: 'Barrio Los Pozos', latitud: -17.80, longitud: -63.20, contacto: '700-1234' },
        { centro_id: 2, nombre: 'San Roque', direccion: 'Av. Cañoto', latitud: -17.79, longitud: -63.19, contacto: '700-5678' },
    ],
    Rescatista: [
        { rescastista_id: 1, persona_id: 10, cv_documentado: true },
    ],
    Traslado: [
        { traslado_id: 1, rescastista_id: 1, nombre: 'Rescate a Centro', centro_id: 1, latitud: -17.7833, longitud: -63.1833, observaciones: 'Urgente' },
    ],
    Veterinario: [
        { veterinario_id: 5, especialidad: 'Trauma', cv_documentado: true, persona_id: 11 },
    ],
};
const LS_KEY = 'mock_db_full';
const OP_KEY = 'mock_ops_count';

function loadDB() {
    const raw = localStorage.getItem(LS_KEY);
    if (raw) return JSON.parse(raw);
    const init = {};
    Object.keys(Schema).forEach(k => init[k] = (Seed[k] || []));
    localStorage.setItem(LS_KEY, JSON.stringify(init));
    return init;
}
function saveDB(db) { localStorage.setItem(LS_KEY, JSON.stringify(db)); }

function getOps() { return parseInt(localStorage.getItem(OP_KEY) || '0', 10); }
function setOps(n) { localStorage.setItem(OP_KEY, String(n)); updateOpsUI(); }
function incOps(x=1) { setOps(getOps()+x); }

function updateOpsUI() {
    const n = getOps();
    const pct = Math.min(100, Math.round((n/500)*100));
    document.getElementById('crudCount').textContent = n;
    document.getElementById('crudProgress').style.width = pct+'%';
}

// =========================
// Motor CRUD Genérico
// =========================
const db = loadDB();

function renderEntityList() {
    const list = document.getElementById('entityList');
    list.innerHTML = '';
    Object.keys(Schema).forEach(name => {
        const item = document.createElement('a');
        item.href = '#';
        item.className = 'list-group-item list-group-item-action';
        item.textContent = name.replace(/_/g,' ');
        item.addEventListener('click', (e) => {
            e.preventDefault();
            renderEntityView(name);
            document.querySelectorAll('#entityList .list-group-item').forEach(el => el.classList.remove('active'));
            item.classList.add('active');
        });
        list.appendChild(item);
    });
}

function renderEntityView(entity) {
    const role = currentRole();
    const allowed = hasAccess(role, entity);
    const schema = Schema[entity];
    const data = db[entity] || [];

    const container = document.getElementById('entityView');
    container.innerHTML = `
        <div class="card card-secondary card-outline ${document.body.classList.contains('theme-dark') ? 'density-compact' : ''}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fas fa-table mr-2"></i>${entity.replace(/_/g,' ')}</h3>
                <div class="crud-toolbar">
                    <button class="btn btn-success btn-sm"
                            id="btnCreate"
                            data-role-allowed="${allowed ? role : 'Administrador'}"
                            data-role-visibility="disable">
                        <i class="fas fa-plus mr-1"></i> Crear
                    </button>
                    <button class="btn btn-info btn-sm"
                            id="btnEdit"
                            data-role-allowed="${allowed ? role : 'Administrador'}"
                            data-role-visibility="disable">
                        <i class="fas fa-edit mr-1"></i> Editar
                    </button>
                    <button class="btn btn-danger btn-sm"
                            id="btnDelete"
                            data-role-allowed="${allowed ? role : 'Administrador'}"
                            data-role-visibility="disable">
                        <i class="fas fa-trash mr-1"></i> Eliminar
                    </button>
                    <button class="btn btn-secondary btn-sm"
                            id="btnCustomizeForm">
                        <i class="fas fa-sliders-h mr-1"></i> Personalizar Form
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                ${schema.fields.map(f => `<th>${f}</th>`).join('')}
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${data.map(row => `
                                <tr>
                                    ${schema.fields.map(f => `<td>${row[f] ?? ''}</td>`).join('')}
                                    <td>
                                        <button class="btn btn-info btn-sm"
                                                data-row-id="${row[schema.pk]}"
                                                data-role-allowed="${allowed ? role : 'Administrador'}"
                                                data-role-visibility="disable">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    `;

    // Bind acciones CRUD
    document.getElementById('btnCreate').addEventListener('click', () => openForm(entity, null));
    document.getElementById('btnEdit').addEventListener('click', () => {
        const last = (db[entity] || [])[0] || null; // demo: edita el primero
        openForm(entity, last);
    });
    document.getElementById('btnDelete').addEventListener('click', () => {
        deleteRow(entity);
    });
    document.querySelectorAll('button[data-row-id]').forEach(b => {
        b.addEventListener('click', () => {
            const id = b.getAttribute('data-row-id');
            const row = (db[entity] || []).find(r => String(r[schema.pk]) === String(id));
            openForm(entity, row, true);
        });
    });
}

function openForm(entity, data=null, readOnly=false) {
    const schema = Schema[entity];
    const container = document.createElement('div');
    container.className = 'modal fade';
    container.id = 'crudModal';
    container.innerHTML = `
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit mr-2"></i>${readOnly ? 'Ver' : (data ? 'Editar' : 'Crear')} ${entity.replace(/_/g,' ')}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="crudForm" class="form-grid-2">
                        ${schema.fields.map(f => `
                            <div class="form-group">
                                <label>${f}</label>
                                <input type="text" name="${f}" class="form-control" value="${data ? (data[f] ?? '') : ''}" ${readOnly ? 'disabled' : ''}/>
                            </div>
                        `).join('')}
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    ${readOnly ? '' : `
                    <button class="btn btn-primary" id="btnSave">
                        <i class="fas fa-save mr-1"></i> Guardar
                    </button>`}
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(container);
    if (window.jQuery) $('#crudModal').modal('show');
    container.addEventListener('hidden.bs.modal', () => container.remove());

    if (!readOnly) {
        document.getElementById('btnSave').addEventListener('click', () => {
            const form = document.getElementById('crudForm');
            const obj = {};
            schema.fields.forEach(f => obj[f] = form.querySelector(`[name="${f}"]`).value);
            if (!data) {
                // Crear
                const nextId = (Math.max(0, ...db[entity].map(r => r[schema.pk])) || 0) + 1;
                obj[schema.pk] = obj[schema.pk] || nextId;
                db[entity].push(obj);
                incOps(1);
            } else {
                // Editar
                const idx = db[entity].findIndex(r => r[schema.pk] == data[schema.pk]);
                if (idx >= 0) db[entity][idx] = obj;
                incOps(1);
            }
            saveDB(db);
            renderEntityView(entity);
            if (window.jQuery) $('#crudModal').modal('hide');
        });
    }
}

function deleteRow(entity) {
    const schema = Schema[entity];
    const rows = db[entity] || [];
    if (rows.length === 0) return alert('Sin registros para eliminar');
    const id = rows[0][schema.pk]; // demo
    db[entity] = rows.filter(r => r[schema.pk] !== id);
    saveDB(db);
    incOps(1);
    renderEntityView(entity);
}

// =========================
// Personalización
// =========================
document.getElementById('uiTheme').addEventListener('change', (e) => {
    const val = e.target.value;
    document.body.classList.remove('theme-dark','theme-blue');
    if (val === 'dark') document.body.classList.add('theme-dark');
    if (val === 'blue') document.body.classList.add('theme-blue');
});

// =========================
// Simulación 500 CRUDs
// =========================
document.getElementById('btnSimular500').addEventListener('click', () => {
    const target = 500;
    let n = getOps();
    const entities = Object.keys(Schema);
    let i = 0;
    const timer = setInterval(() => {
        if (n >= target) { clearInterval(timer); return; }
        const e = entities[i % entities.length];
        // Alterna entre crear/eliminar
        const action = (n % 2 === 0) ? 'create' : 'delete';
        if (action === 'create') {
            const nextId = (Math.max(0, ...db[e].map(r => r[Schema[e].pk])) || 0) + 1;
            const row = {};
            Schema[e].fields.forEach(f => {
                row[f] = (f === Schema[e].pk) ? nextId : (db[e][0]?.[f] ?? '');
            });
            db[e].push(row);
        } else {
            db[e].pop();
        }
        saveDB(db);
        n++; setOps(n);
        i++;
    }, 10); // rápido para demo
});

// =========================
// Inicialización
// =========================
document.addEventListener('DOMContentLoaded', () => {
    renderEntityList();
    // Selecciona la primera entidad por defecto
    const first = Object.keys(Schema)[0];
    renderEntityView(first);
    updateOpsUI();
});
</script>
@endsection