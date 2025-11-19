@extends('layouts.admin')

@section('title', 'Reportes - Rescate Animales')

@push('styles')
<style>
    
    .chart-bar {
        width: 50px;
        border-radius: 5px 5px 0 0; 
    }
    .bar-chart-container {
        height: 180px; 
        text-align: center;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
    }
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="m-0">Tablero de reportes</h1>
                <p class="text-muted mb-0">Periodo: 1/9/2025 - 5/10/2025</p>
            </div>
            <a href="#" class="btn btn-primary mt-2 mt-md-0">
                <i class="fas fa-file-pdf mr-2"></i> Exportar PDF
            </a>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Mantener métricas básicas; quitar salud y tipos -->
            <div class="col-lg-3 col-6"><div class="small-box bg-primary"><div class="inner"><h3>2</h3><p>Animales en Total</p></div><div class="icon"><i class="fas fa-paw"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3>1</h3><p>Con evaluaciones</p></div><div class="icon"><i class="fas fa-stethoscope"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3>1</h3><p>Buena salud</p></div><div class="icon"><i class="fas fa-heart"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-danger"><div class="inner"><h3>1</h3><p>Mala salud</p></div><div class="icon"><i class="fas fa-heart-broken"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-teal"><div class="inner"><h3>1</h3><p>Domésticos</p></div><div class="icon"><i class="fas fa-cat"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3>1</h3><p>Silvestres</p></div><div class="icon"><i class="fas fa-kiwi-bird"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-secondary"><div class="inner"><h3>3</h3><p>Rescatistas</p></div><div class="icon"><i class="fas fa-users"></i></div></div></div>
            <div class="col-lg-3 col-6"><div class="small-box bg-purple"><div class="inner"><h3>1</h3><p>Veterinarios</p></div><div class="icon"><i class="fas fa-user-md"></i></div></div></div>
        </div>

        <div class="row">
            <!-- quitar bloque “Distribución del Estado de Salud” -->
            <div class="col-md-6">
                <div class="card card-success card-outline">
                    <div class="card-header"><h3 class="card-title"><i class="far fa-chart-bar"></i> Rescates últimos 6 meses</h3></div>
                    <div class="card-body">
                        <div class="bar-chart-container d-flex align-items-end justify-content-around">
                            <div>
                                <div class="chart-bar bg-gradient-success" style="height: 100%;"></div>
                                <p class="text-center mt-2 font-weight-bold">sept</p>
                            </div>
                            <div>
                                <div class="chart-bar bg-gradient-success" style="height: 100%;"></div>
                                <p class="text-center mt-2 font-weight-bold">oct</p>
                            </div>
                        </div>
                        <p class="text-center text-muted mt-3 mb-0">Total: 2 animales rescatados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title"><i class="fas fa-tag"></i> Especies más registradas</h3></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between"><span>Jaguarcito</span><span>1</span></div>
                            <div class="progress" style="height: 20px;"><div class="progress-bar bg-info" role="progressbar" style="width: 100%;"></div></div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between"><span>Felino</span><span>1</span></div>
                            <div class="progress" style="height: 20px;"><div class="progress-bar bg-primary" role="progressbar" style="width: 100%;"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header"><h3 class="card-title">Distribución del Estado de Salud</h3></div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 50%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2"><b>50%</b></div>
                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 50%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2"><b>50%</b></div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span class="font-weight-bold"><i class="fas fa-check-circle text-success"></i> Buena salud: 1</span>
                            <span class="font-weight-bold"><i class="fas fa-times-circle text-danger"></i> Mala salud: 1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listas de tablas (Administrador) -->
        <div class="row" data-role-allowed="Administrador">
          <div class="col-12">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-database mr-2"></i> Listas de tablas (MockDB)</h3>
              </div>
              <div class="card-body" id="admin-tablas-list"></div>
            </div>
          </div>
        </div>
        <div class="row">
            <!-- Solicitudes de cambio de rol -->
            <div class="col-md-6" data-role-allowed="Encargado,Administrador">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-id-card mr-2"></i> Solicitudes de cambio de rol</h3>
                    </div>
                    <div class="card-body">
                        <div id="solicitudesRolContainer"></div>
                    </div>
                </div>
            </div>

            <!-- Hallazgos de animales (Reportes) -->
            <div class="col-md-6" data-role-allowed="Encargado,Administrador">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-binoculars mr-2"></i> Hallazgos de animales</h3>
                    </div>
                    <div class="card-body">
                        <div id="hallazgosContainer"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cuidadores voluntarios -->
        <div class="card card-info card-outline" data-role-allowed="Encargado,Administrador">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users mr-2"></i> Cuidadores voluntarios</h3>
            </div>
            <div class="card-body">
                <div id="cuidadoresContainer"></div>
            </div>
        </div>
    </div>
</section>

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function renderSolicitudes() {
        const cont = document.getElementById('solicitudesRolContainer');
        if (!cont) return;
        const rows = (window.MockDB ? window.MockDB.get('Solicitud_Rol') : []);
        if (!rows.length) { cont.innerHTML = '<div class="alert alert-secondary mb-0">No hay solicitudes.</div>'; return; }
        cont.innerHTML = `
            <table class="table table-sm">
                <thead><tr><th>Usuario</th><th>Rol</th><th>CV</th><th>Estado</th><th>Fecha</th><th>Acciones</th></tr></thead>
                <tbody>
                    ${rows.map(r => `
                        <tr>
                            <td>${r.usuario_id ?? '-'}</td>
                            <td>${r.rol_solicitado}</td>
                            <td>${r.cv_nombre ?? '-'}</td>
                            <td>${r.estado}</td>
                            <td>${r.fecha}</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-encargado-allowed="true" data-action="aprobar-solicitud" data-id="${r.solicitud_id}">Aprobar</button>
                                <button class="btn btn-danger btn-sm" data-encargado-allowed="true" data-action="rechazar-solicitud" data-id="${r.solicitud_id}">Rechazar</button>
                            </td>
                        </tr>
                    ).join('')}
                </tbody>
            </table>
        `;
    }

    function renderHallazgos() {
        const cont = document.getElementById('hallazgosContainer');
        if (!cont) return;
        const rows = (window.MockDB ? window.MockDB.get('Reporte') : []);
        if (!rows.length) { cont.innerHTML = '<div class="alert alert-secondary mb-0">No hay hallazgos reportados.</div>'; return; }
        cont.innerHTML = `
            <table class="table table-sm">
                <thead><tr><th>Tipo</th><th>Dirección</th><th>Lat/Lon</th><th>Aprobado</th><th>Acciones</th></tr></thead>
                <tbody>
                    ${rows.map(r => `
                        <tr>
                            <td>${r.tipo_id ?? '-'}</td>
                            <td>${r.direccion ?? '-'}</td>
                            <td>${r.latitud ?? '-'}, ${r.longitud ?? '-'}</td>
                            <td>${r.aprobado ? 'Sí' : 'No'}</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-encargado-allowed="true" data-action="aprobar-reporte" data-id="${r.reporte_id}">Aprobar</button>
                                <button class="btn btn-danger btn-sm" data-encargado-allowed="true" data-action="rechazar-reporte" data-id="${r.reporte_id}">Rechazar</button>
                            </td>
                        </tr>
                    ).join('')}
                </tbody>
            </table>
        `;
    }

    function renderCuidadores() {
        const cont = document.getElementById('cuidadoresContainer');
        if (!cont) return;
        const rows = (window.MockDB ? (window.MockDB.get('Cuidador') || []) : []);
        if (!rows.length) { cont.innerHTML = '<div class="alert alert-secondary mb-0">No hay cuidadores registrados (comprometidos).</div>'; return; }
        cont.innerHTML = `
            <table class="table table-sm">
                <thead><tr><th>Usuario</th><th>Fecha de Compromiso</th></tr></thead>
                <tbody>
                    ${rows.map(r => `<tr><td>${r.usuario_id ?? '-'}</td><td>${r.fecha_compromiso ?? '-'}</td></tr>`).join('')}
                </tbody>
            </table>
        `;
    }

    document.body.addEventListener('click', function(e) {
        const btn = e.target.closest('button[data-action]');
        if (!btn || !window.MockDB) return;
        const act = btn.getAttribute('data-action');
        const id = Number(btn.getAttribute('data-id'));
        if (act === 'aprobar-solicitud' || act === 'rechazar-solicitud') {
            const row = window.MockDB.find('Solicitud_Rol', id);
            if (!row) return;
            row.estado = (act === 'aprobar-solicitud') ? 'aprobado' : 'rechazado';
            window.MockDB.update('Solicitud_Rol', row);
            renderSolicitudes();
            alert(`Solicitud ${row.estado}.`);
        } else if (act === 'aprobar-reporte' || act === 'rechazar-reporte') {
            const row = window.MockDB.find('Reporte', id);
            if (!row) return;
            row.aprobado = (act === 'aprobar-reporte') ? 1 : 0;
            window.MockDB.update('Reporte', row);
            renderHallazgos();
            alert(`Reporte ${row.aprobado ? 'aprobado' : 'rechazado'}.`);
        }
    });

    renderSolicitudes();
    renderHallazgos();
    renderCuidadores();
});
</script>
@endsection

<!-- Modal datos -->
<div class="modal fade" id="adminDataModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="adminDataModalTitle">Tabla</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-sm table-striped">
            <thead><tr id="adminDataHead"></tr></thead>
            <tbody id="adminDataBody"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const cont = document.getElementById('admin-tablas-list');
  if (!window.MockDB || !cont) return;
  const schema = window.MockDB.schema;
  const buildCard = (name, count) => `
    <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
      <strong>${name}</strong>
      <div>
        <span class="badge badge-primary mr-2">${count} filas</span>
        <button class="btn btn-sm btn-info ver-tabla" data-name="${name}"><i class="fas fa-eye mr-1"></i> Ver</button>
      </div>
    </div>`;
  cont.innerHTML = Object.keys(schema).map(n => buildCard(n, window.MockDB.get(n).length)).join('');

  cont.querySelectorAll('.ver-tabla').forEach(btn => {
    btn.addEventListener('click', function() {
      const name = this.dataset.name;
      const rows = window.MockDB.get(name);
      const fields = schema[name].fields;
      document.getElementById('adminDataModalTitle').textContent = `Tabla: ${name}`;
      const head = document.getElementById('adminDataHead');
      const body = document.getElementById('adminDataBody');
      head.innerHTML = fields.map(f => `<th>${f}</th>`).join('');
      body.innerHTML = rows.map(r => `<tr>${fields.map(f => `<td>${r[f] != null ? r[f] : ''}</td>`).join('')}</tr>`).join('');
      $('#adminDataModal').modal('show');
    });
  });
});
</script>
@endpush
@endsection