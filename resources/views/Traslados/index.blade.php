@extends('layouts.admin')

@section('title', 'Traslados - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Traslados</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Traslados</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-header d-flex align-items-center">
				<h3 class="card-title mb-0">Listado</h3>
				<a href="{{ url('/traslados/crear') }}" class="btn btn-primary btn-sm ml-2" data-role-allowed="Administrador">
					<i class="fas fa-plus"></i> Nuevo
				</a>
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
							<th>Rescatista</th>
							<th>Centro</th>
							<th>Nombre</th>
							<th>Observaciones</th>
							<th class="text-right">Acciones</th>
						</tr>
					</thead>
					<tbody id="tbody" data-role-allowed="Administrador" data-role-visibility="disable"></tbody>
				</table>
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
	function fillCombos() {
		document.getElementById('rescatista').innerHTML = db.get('Rescatista').map(r => {
			const p = db.find('Persona', r.persona_id);
			const name = p ? (p.nombre + ' ' + (p.apellido || '')) : ('Resc #' + r.rescatista_id);
			return `<option value="${r.rescatista_id}">${name}</option>`;
		}).join('');
		document.getElementById('centro').innerHTML = db.get('Centro').map(c => `<option value="${c.centro_id}">${c.nombre}</option>`).join('');
	}
	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = db.get('Traslado').map(t => ({
			...t,
			_rescatista: db.find('Rescatista', t.rescastista_id), // nota: prototipo mantiene nombre así
			_centro: db.find('Centro', t.centro_id)
		})).filter(r => (r.nombre || '').toLowerCase().includes(q) || (r._centro?.nombre || '').toLowerCase().includes(q));
		$tbody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.traslado_id}</td>
				<td>${(function(){ const rr=r._rescatista; if(!rr) return '-'; const p=db.find('Persona', rr.persona_id); return p ? (p.nombre + ' ' + (p.apellido||'')) : ('Resc #' + rr.rescatista_id) })()}</td>
				<td>${r._centro?.nombre || '-'}</td>
				<td>${r.nombre || '-'}</td>
				<td>${r.observaciones || '-'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${r.traslado_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${r.traslado_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}
	function load(id) {
		const r = db.find('Traslado', id);
		if (!r) return;
		document.getElementById('id').value = r.traslado_id;
		document.getElementById('rescatista').value = r.rescastista_id || '';
		document.getElementById('centro').value = r.centro_id || '';
		document.getElementById('nombre').value = r.nombre || '';
		document.getElementById('obs').value = r.observaciones || '';
	}
	function save(e) {
		e.preventDefault();
		const id = Number(document.getElementById('id').value);
		const payload = {
			rescastista_id: Number(document.getElementById('rescatista').value),
			centro_id: Number(document.getElementById('centro').value),
			nombre: document.getElementById('nombre').value.trim(),
			observaciones: document.getElementById('obs').value.trim()
		};
		if (id) db.update('Traslado', { ...payload, traslado_id: id });
		else db.create('Traslado', payload);
		document.getElementById('form').reset();
		render();
	}
	function remove(id) { db.remove('Traslado', id); render(); }
	document.addEventListener('DOMContentLoaded', function() {
		fillCombos();
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


