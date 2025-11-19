@extends('layouts.admin')

@section('title', 'Hallazgos - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Hallazgos de Animales</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Hallazgos</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<!-- Métricas (hardcodeadas para prototipo) -->
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>12</h3>
						<p>Total Reportes</p>
					</div>
					<div class="icon">
						<i class="fas fa-location-dot"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>5</h3>
						<p>Pendientes</p>
					</div>
					<div class="icon">
						<i class="fas fa-hourglass-half"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-success">
					<div class="inner">
						<h3>7</h3>
						<p>Aprobados</p>
					</div>
					<div class="icon">
						<i class="fas fa-check"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-danger">
					<div class="inner">
						<h3>0</h3>
						<p>Rechazados</p>
					</div>
					<div class="icon">
						<i class="fas fa-times"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-primary card-outline">
			<div class="card-header d-flex align-items-center">
				<h3 class="card-title mb-0 mr-3">Hallazgos de animales en peligro</h3>
				<span class="badge badge-info" id="countBadge">0</span>
				<div class="ml-auto" style="min-width: 260px;">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-search"></i></span>
						</div>
						<input type="text" id="buscarDireccion" class="form-control" placeholder="Buscar por dirección...">
					</div>
				</div>
			</div>
			<div class="card-body p-2">
				<div class="table-responsive">
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Dirección</th>
								<th>Observaciones</th>
								<th>Cant.</th>
								<th>Estado</th>
								<th class="text-right">Acciones</th>
							</tr>
						</thead>
						<tbody id="tablaHallazgos" data-role-allowed="Administrador" data-role-visibility="disable">
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="card card-secondary card-outline">
			<div class="card-header">
				<h3 class="card-title">Modificar Hallazgo</h3>
			</div>
			<div class="card-body">
				<form id="formEditar">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="editId">ID</label>
								<input type="number" class="form-control" id="editId" placeholder="ID">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="editDireccion">Dirección</label>
								<input type="text" class="form-control" id="editDireccion" placeholder="Dirección">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="editObs">Observaciones</label>
								<input type="text" class="form-control" id="editObs" placeholder="Observaciones">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="editCant">Cantidad</label>
								<input type="number" min="1" class="form-control" id="editCant" placeholder="1">
							</div>
						</div>
					</div>
					<div class="text-right">
						<button class="btn btn-primary" id="btnGuardarCambios" data-encargado-allowed>Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')
<script>
(function() {
	const db = window.MockDB;
	const $tbody = document.getElementById('tablaHallazgos');
	const $count = document.getElementById('countBadge');
	const $buscar = document.getElementById('buscarDireccion');

	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = (db ? db.get('Reporte') : []).filter(r => (r.direccion || '').toLowerCase().includes(q));
		$count.textContent = rows.length;
		$tbody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.reporte_id}</td>
				<td>${r.direccion || '-'}</td>
				<td>${r.observaciones || '-'}</td>
				<td>${r.cantidad_animales || 1}</td>
				<td>${
					(r.estado === 'aprobado') ? '<span class="badge badge-success">Aprobado</span>' :
					(r.estado === 'rechazado') ? '<span class="badge badge-danger">Rechazado</span>' :
					'<span class="badge badge-warning">Pendiente</span>'
				}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-success" data-action="aprobar" data-id="${r.reporte_id}"><i class="fas fa-check"></i></button>
					<button class="btn btn-xs btn-danger" data-action="rechazar" data-id="${r.reporte_id}"><i class="fas fa-times"></i></button>
					<button class="btn btn-xs btn-info" data-action="cargar" data-id="${r.reporte_id}"><i class="fas fa-pen"></i></button>
				</td>
			</tr>
		`).join('');
	}

	function aprobar(id, ok) {
		const rec = db.find('Reporte', id);
		if (!rec) return;
		db.update('Reporte', { reporte_id: id, aprobado: ok ? 1 : 0, estado: ok ? 'aprobado' : 'rechazado' });
		render();
	}

	function cargarEdicion(id) {
		const rec = db.find('Reporte', id);
		if (!rec) return;
		document.getElementById('editId').value = rec.reporte_id;
		document.getElementById('editDireccion').value = rec.direccion || '';
		document.getElementById('editObs').value = rec.observaciones || '';
		document.getElementById('editCant').value = rec.cantidad_animales || 1;
	}

	document.addEventListener('DOMContentLoaded', function() {
		render();
		$buscar.addEventListener('input', render);
		$tbody.addEventListener('click', function(e) {
			const btn = e.target.closest('button[data-action]');
			if (!btn) return;
			const id = Number(btn.dataset.id);
			const action = btn.dataset.action;
			if (action === 'aprobar') aprobar(id, true);
			if (action === 'rechazar') aprobar(id, false);
			if (action === 'cargar') cargarEdicion(id);
		});
		document.getElementById('btnGuardarCambios').addEventListener('click', function(e) {
			e.preventDefault();
			const id = Number(document.getElementById('editId').value);
			if (!id) return;
			db.update('Reporte', {
				reporte_id: id,
				direccion: document.getElementById('editDireccion').value.trim(),
				observaciones: document.getElementById('editObs').value.trim(),
				cantidad_animales: Number(document.getElementById('editCant').value || 1)
			});
			render();
		});
	});
})();
</script>
@endsection


