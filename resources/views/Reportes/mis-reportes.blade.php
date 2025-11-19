@extends('layouts.admin')

@section('title', 'Mis Reportes')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-clipboard-list text-primary mr-2"></i>
                    Mis Reportes
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Mis Reportes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-2"></i> Historial</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Estado actual</th>
                                <th>Ubicación</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="mis-reportes-tbody">
                            <!-- Llenado por JS: datos de ejemplo -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Ver Ubicación del Traslado -->
<div class="modal fade" id="verUbicacionTrasladoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">
                    <i class="fas fa-route mr-2"></i> Ubicación de Traslado
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="mapaUbicacionTraslado" style="height: 320px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
// Cargar desde MockDB
function renderMisReportes() {
    const reportes = (window.MockDB ? window.MockDB.get('Reporte') : []);
    const $tbody = document.getElementById('mis-reportes-tbody');
    $tbody.innerHTML = '';

    reportes.forEach(r => {
        const ubTxt = (Number.isFinite(r.latitud) && Number.isFinite(r.longitud))
            ? `${Number(r.latitud).toFixed(5)}, ${Number(r.longitud).toFixed(5)}`
            : '-';
        $tbody.insertAdjacentHTML('beforeend', `
            <tr data-id="${r.reporte_id}">
                <td>-</td>
                <td>Reporte</td>
                <td><span class="badge ${r.aprobado ? 'badge-success' : 'badge-secondary'}">${r.aprobado ? 'Aprobado' : 'Pendiente'}</span></td>
                <td>${ubTxt}</td>
                <td class="text-right">
                    <button class="btn btn-info btn-sm ver-ubicacion" data-id="${r.reporte_id}">
                        <i class="fas fa-map-marker-alt mr-1"></i> Ver ubicación
                    </button>
                </td>
            </tr>
        `);
    });

    document.querySelectorAll('.ver-ubicacion').forEach(btn => {
        btn.addEventListener('click', e => {
            const id = parseInt(e.currentTarget.dataset.id, 10);
            const r = reportes.find(x => Number(x.reporte_id) === id);
            if (!r) return;
            $('#verUbicacionTrasladoModal').modal('show');
            setTimeout(() => {
                const map = L.map('mapaUbicacionTraslado').setView([-17.7833, -63.1833], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
                if (Number.isFinite(r.latitud) && Number.isFinite(r.longitud)) {
                    const mk = L.marker([Number(r.latitud), Number(r.longitud)]).addTo(map)
                        .bindPopup(`<b>Reporte #${r.reporte_id}</b><br>${r.direccion || ''}`);
                    const group = L.featureGroup([mk]);
                    map.fitBounds(group.getBounds().pad(0.2));
                }
                setTimeout(() => map.invalidateSize(), 0);
            }, 150);
        });
    });
}

document.addEventListener('DOMContentLoaded', renderMisReportes);
</script>
@endsection