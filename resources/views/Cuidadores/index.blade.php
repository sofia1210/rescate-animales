@extends('layouts.admin')

@section('title', 'Cuidadores - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Cuidadores</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Cuidadores</li>
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
						<h3>9</h3>
						<p>Cuidadores Activos</p>
					</div>
					<div class="icon">
						<i class="fas fa-hands-holding-child"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>2</h3>
						<p>Nuevos este mes</p>
					</div>
					<div class="icon">
						<i class="fas fa-user-plus"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-primary card-outline">
			<div class="card-header d-flex align-items-center">
				<h3 class="card-title mb-0">Listado</h3>
				<div class="ml-auto" style="min-width: 240px;">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-search"></i></span>
						</div>
						<input type="text" id="buscar" class="form-control" placeholder="Buscar...">
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<table class="table table-sm mb-0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Usuario</th>
							<th>Fecha Compromiso</th>
							<th class="text-right">Acciones</th>
						</tr>
					</thead>
					<tbody id="tbody" data-role-allowed="Administrador" data-role-visibility="disable"></tbody>
				</table>
			</div>
			<div class="card-footer">
				<form id="form">
					<input type="hidden" id="id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Usuario ID</label>
								<input type="number" class="form-control" id="usuarioId" placeholder="Usuario ID">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Fecha Compromiso</label>
								<input type="date" class="form-control" id="fecha">
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
		const rows = db.get('Cuidador').filter(c => String(c.usuario_id||'').includes(q));
		$tbody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.cuidador_id}</td>
				<td>${r.usuario_id || '-'}</td>
				<td>${r.fecha_compromiso || '-'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${r.cuidador_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${r.cuidador_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}
	function load(id) {
		const r = db.find('Cuidador', id);
		if (!r) return;
		document.getElementById('id').value = r.cuidador_id;
		document.getElementById('usuarioId').value = r.usuario_id || '';
		document.getElementById('fecha').value = r.fecha_compromiso || '';
	}
	function save(e) {
		e.preventDefault();
		const id = Number(document.getElementById('id').value);
		const payload = {
			usuario_id: Number(document.getElementById('usuarioId').value || 0),
			fecha_compromiso: document.getElementById('fecha').value || new Date().toISOString().slice(0,10)
		};
		if (id) db.update('Cuidador', { ...payload, cuidador_id: id });
		else db.create('Cuidador', payload);
		document.getElementById('form').reset();
		render();
	}
	function remove(id) { db.remove('Cuidador', id); render(); }
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


