@extends('layouts.admin')

@section('title', 'Rescatistas - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Rescatistas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Rescatistas</li>
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
				<a href="{{ url('/rescatistas/crear') }}" class="btn btn-primary btn-sm ml-2" data-role-allowed="Administrador">
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
							<th>Persona</th>
							<th>CV</th>
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
	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = db.get('Rescatista').map(v => ({
			...v,
			_persona: (db.get('Persona').find(p => p.persona_id === v.persona_id) || null)
		})).filter(r => {
			const name = r._persona ? `${r._persona.nombre} ${r._persona.apellido||''}`.toLowerCase() : '';
			return name.includes(q);
		});
		$tbody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.rescatista_id}</td>
				<td>${r._persona ? (r._persona.nombre + ' ' + (r._persona.apellido||'')) : '-'}</td>
				<td>${r.cv_documentado ? 'Sí' : 'No'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${r.rescatista_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${r.rescatista_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}
	function load(id) {
		const r = db.find('Rescatista', id);
		if (!r) return;
		document.getElementById('id').value = r.rescatista_id;
		document.getElementById('persona').value = (db.get('Persona').find(p => p.persona_id === r.persona_id)?.nombre) || '';
		document.getElementById('cv').checked = !!r.cv_documentado;
	}
	function save(e) {
		e.preventDefault();
		const id = Number(document.getElementById('id').value);
		const personaName = document.getElementById('persona').value.trim();
		const persona = db.get('Persona').find(p => (`${p.nombre} ${p.apellido||''}`).toLowerCase().includes(personaName.toLowerCase()));
		const payload = {
			persona_id: persona ? persona.persona_id : 0,
			cv_documentado: document.getElementById('cv').checked ? 1 : 0
		};
		if (id) db.update('Rescatista', { ...payload, rescatista_id: id });
		else db.create('Rescatista', payload);
		document.getElementById('form').reset();
		render();
	}
	function remove(id) { db.remove('Rescatista', id); render(); }
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


