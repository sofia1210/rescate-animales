@extends('layouts.admin')

@section('title', 'Hoja de Vida - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Hoja de Vida del Animal</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Hoja de Vida</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7">
				<div class="card card-primary card-outline">
					<div class="card-header d-flex align-items-center">
						<h3 class="card-title mb-0">Buscar</h3>
						<div class="ml-auto">
							<input class="form-control form-control-sm" id="q" placeholder="Nombre del animal...">
						</div>
					</div>
					<div class="card-body p-0">
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Estado</th>
									<th>Centro</th>
									<th class="text-right">Acciones</th>
								</tr>
							</thead>
							<tbody id="tbody" data-role-allowed="Administrador" data-role-visibility="disable"></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="card card-success card-outline">
					<div class="card-header">
						<h3 class="card-title mb-0">Registrar / Editar Hoja</h3>
					</div>
					<div class="card-body">
						<form id="form">
							<input type="hidden" id="id">
							<div class="form-group">
								<label>Nombre</label>
								<input type="text" class="form-control form-control-sm" id="nombre">
							</div>
							<div class="form-group">
								<label>Tipo</label>
								<select class="form-control form-control-sm" id="tipo"></select>
							</div>
							<div class="form-group">
								<label>Estado de Salud</label>
								<select class="form-control form-control-sm" id="estado">
									<option value="1">Malo</option>
									<option value="2">Bueno</option>
								</select>
							</div>
							<div class="form-group">
								<label>Centro</label>
								<select class="form-control form-control-sm" id="centro"></select>
							</div>
						</form>
					</div>
					<div class="card-footer d-flex">
						<button class="btn btn-success btn-sm mr-2" id="btnGuardar" data-encargado-allowed>Guardar</button>
						<button class="btn btn-info btn-sm mr-2" id="btnEstado" data-encargado-allowed>Actualizar Estado</button>
						<button class="btn btn-warning btn-sm" id="btnUbicacion" data-encargado-allowed>Actualizar Ubicación</button>
					</div>
				</div>
				<div class="card card-secondary card-outline">
					<div class="card-header">
						<h3 class="card-title mb-0">Historial</h3>
					</div>
					<div class="card-body p-2">
						<ul class="list-unstyled mb-0" id="historial"></ul>
					</div>
				</div>
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
	const $q = document.getElementById('q');
	const $tipo = document.getElementById('tipo');
	const $centro = document.getElementById('centro');
	const $hist = document.getElementById('historial');

	function fillCombos() {
		$tipo.innerHTML = db.get('Tipo_Animal').map(t => `<option value="${t.tipo_id}">${t.nombre}</option>`).join('');
		$centro.innerHTML = db.get('Centro').map(c => `<option value="${c.centro_id}">${c.nombre}</option>`).join('');
	}

	function render() {
		const q = ($q.value || '').toLowerCase();
		const rows = db.get('Hoja_Animal').filter(h => (h.nombre || '').toLowerCase().includes(q));
		$tbody.innerHTML = rows.map(h => `
			<tr>
				<td>${h.hoja_animal_id}</td>
				<td>${h.nombre}</td>
				<td>${(db.find('Tipo_Animal', h.tipo_id)?.nombre) || '-'}</td>
				<td>${h.estado_id == 1 ? 'Malo' : 'Bueno'}</td>
				<td>${(db.find('Centro', h.centro_id)?.nombre) || '-'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${h.hoja_animal_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${h.hoja_animal_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}

	function load(id) {
		const h = db.find('Hoja_Animal', id);
		if (!h) return;
		document.getElementById('id').value = h.hoja_animal_id;
		document.getElementById('nombre').value = h.nombre || '';
		document.getElementById('tipo').value = h.tipo_id || '';
		document.getElementById('estado').value = h.estado_id || 1;
		document.getElementById('centro').value = h.centro_id || '';
		renderHistorial(id);
	}

	function renderHistorial(id) {
		// Prototipo: mostrar eventos, si existieran (estado/ubicación) en un arreglo simple pegado a la hoja
		const h = db.find('Hoja_Animal', id);
		const hist = (h && h._historial) || [];
		$hist.innerHTML = hist.map(ev => `<li class="mb-1"><span class="badge badge-secondary mr-2">${ev.fecha}</span>${ev.tipo}: ${ev.detalle}</li>`).join('') || '<li class="text-muted">Sin eventos.</li>';
	}

	function guardar(e) {
		e.preventDefault();
		const id = Number(document.getElementById('id').value);
		const payload = {
			nombre: document.getElementById('nombre').value.trim(),
			tipo_id: Number(document.getElementById('tipo').value),
			estado_id: Number(document.getElementById('estado').value),
			centro_id: Number(document.getElementById('centro').value)
		};
		if (id) db.update('Hoja_Animal', { ...payload, hoja_animal_id: id });
		else db.create('Hoja_Animal', payload);
		render();
	}

	function actualizarEstado() {
		const id = Number(document.getElementById('id').value);
		if (!id) return alert('Carga primero una hoja.');
		const estado = Number(document.getElementById('estado').value);
		const rec = db.update('Hoja_Animal', { hoja_animal_id: id, estado_id: estado });
		const fecha = new Date().toLocaleString();
		(rec._historial = rec._historial || []).push({ fecha, tipo: 'Estado', detalle: estado === 1 ? 'Malo' : 'Bueno' });
		renderHistorial(id);
	}

	function actualizarUbicacion() {
		const id = Number(document.getElementById('id').value);
		if (!id) return alert('Carga primero una hoja.');
		const centro = Number(document.getElementById('centro').value);
		const rec = db.update('Hoja_Animal', { hoja_animal_id: id, centro_id: centro });
		const fecha = new Date().toLocaleString();
		(rec._historial = rec._historial || []).push({ fecha, tipo: 'Ubicación', detalle: (db.find('Centro', centro)?.nombre) || '-' });
		renderHistorial(id);
	}

	function remove(id) { db.remove('Hoja_Animal', id); render(); }

	document.addEventListener('DOMContentLoaded', function() {
		fillCombos();
		render();
		$q.addEventListener('input', render);
		document.getElementById('tbody').addEventListener('click', function(e) {
			const btn = e.target.closest('button[data-action]');
			if (!btn) return;
			const id = Number(btn.dataset.id);
			if (btn.dataset.action === 'edit') load(id);
			if (btn.dataset.action === 'del') remove(id);
		});
		document.getElementById('btnGuardar').addEventListener('click', guardar);
		document.getElementById('btnEstado').addEventListener('click', function(e) { e.preventDefault(); actualizarEstado(); });
		document.getElementById('btnUbicacion').addEventListener('click', function(e) { e.preventDefault(); actualizarUbicacion(); });
	});
})();
</script>
@endsection


