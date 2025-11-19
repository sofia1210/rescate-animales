@extends('layouts.admin')

@section('title', 'Liberaciones - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Liberaciones</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Liberaciones</li>
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
				<div class="small-box bg-success">
					<div class="inner">
						<h3>6</h3>
						<p>Liberaciones Aprobadas</p>
					</div>
					<div class="icon">
						<i class="fas fa-dove"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>2</h3>
						<p>Pendientes</p>
					</div>
					<div class="icon">
						<i class="fas fa-hourglass-half"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-primary card-outline">
			<div class="card-header d-flex align-items-center">
				<h3 class="card-title mb-0">Listado</h3>
				<div class="ml-auto" style="min-width: 260px;">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-search"></i></span>
						</div>
						<input type="text" id="buscar" class="form-control" placeholder="Buscar por dirección...">
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<table class="table table-sm mb-0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Dirección</th>
							<th>Detalle</th>
							<th>Aprobada</th>
							<th class="text-right">Acciones</th>
						</tr>
					</thead>
					<tbody id="tbody" data-role-allowed="Administrador,Ciudadano" data-role-visibility="disable"></tbody>
				</table>
			</div>
			<div class="card-footer">
				<form id="form">
					<input type="hidden" id="id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Dirección</label>
								<input type="text" class="form-control" id="direccion" placeholder="Dirección">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Detalle</label>
								<input type="text" class="form-control" id="detalle" placeholder="Detalle">
							</div>
						</div>
						<div class="col-md-2 d-flex align-items-center">
							<div class="form-group mb-0">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="aprobada">
									<label class="custom-control-label" for="aprobada">Aprobada</label>
								</div>
							</div>
						</div>
					</div>
					<div class="text-right">
						<button class="btn btn-primary" id="btnGuardar" data-encargado-allowed>Guardar</button>
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
	const $tbody = document.getElementById('tbody');
	const $buscar = document.getElementById('buscar');
	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = db.get('Liberacion').filter(l => (l.direccion || '').toLowerCase().includes(q));
		$tbody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.liberacion_id}</td>
				<td>${r.direccion || '-'}</td>
				<td>${r.detalle || '-'}</td>
				<td>${r.aprobada ? 'Sí' : 'No'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${r.liberacion_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${r.liberacion_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}
	function load(id) {
		const r = db.find('Liberacion', id);
		if (!r) return;
		document.getElementById('id').value = r.liberacion_id;
		document.getElementById('direccion').value = r.direccion || '';
		document.getElementById('detalle').value = r.detalle || '';
		document.getElementById('aprobada').checked = !!r.aprobada;
	}
	function save(e) {
		e.preventDefault();
		const id = Number(document.getElementById('id').value);
		const payload = {
			direccion: document.getElementById('direccion').value.trim(),
			detalle: document.getElementById('detalle').value.trim(),
			aprobada: document.getElementById('aprobada').checked ? 1 : 0
		};
		if (id) db.update('Liberacion', { ...payload, liberacion_id: id });
		else db.create('Liberacion', payload);
		document.getElementById('form').reset();
		render();
	}
	function remove(id) { db.remove('Liberacion', id); render(); }
	document.addEventListener('DOMContentLoaded', function() {
		render();
		$buscar.addEventListener('input', render);
		$tbody.addEventListener('click', function(e) {
			const btn = e.target.closest('button[data-action]');
			if (!btn) return;
			const id = Number(btn.dataset.id);
			if (btn.dataset.action === 'edit') load(id);
			if (btn.dataset.action === 'del') remove(id);
		});
		document.getElementById('btnGuardar').addEventListener('click', save);
	});
})();
</script>
@endsection


