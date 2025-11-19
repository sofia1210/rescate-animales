@extends('layouts.admin')

@section('title', 'Evaluaciones Médicas - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Evaluaciones Médicas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Evaluaciones</li>
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
				<a href="{{ url('/evaluaciones/crear') }}" class="btn btn-primary btn-sm ml-2" data-role-allowed="Administrador">
					<i class="fas fa-plus"></i> Nuevo
				</a>
				<div class="ml-auto" style="min-width: 260px;">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-search"></i></span>
						</div>
						<input type="text" id="buscar" class="form-control" placeholder="Buscar por descripción...">
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<table class="table table-sm mb-0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tratamiento</th>
							<th>Descripción</th>
							<th>Fecha</th>
							<th>Veterinario</th>
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
		document.getElementById('tratamiento').innerHTML = db.get('Tipo_Tratamiento').map(t => `<option value="${t.tratamiento_id}">${t.nombre}</option>`).join('');
		document.getElementById('veterinario').innerHTML = db.get('Veterinario').map(v => {
			const p = db.find('Persona', v.persona_id);
			const name = p ? (p.nombre + ' ' + (p.apellido || '')) : ('Vet #' + v.veterinario_id);
			return `<option value="${v.veterinario_id}">${name}</option>`;
		}).join('');
	}

	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = db.get('Evaluacion_Medica').filter(r => (r.descripcion || '').toLowerCase().includes(q));
		$tbody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.evaluacion_id}</td>
				<td>${db.find('Tipo_Tratamiento', r.tratamiento_id)?.nombre || '-'}</td>
				<td>${r.descripcion || '-'}</td>
				<td>${r.fecha || '-'}</td>
				<td>${(function(){const v=db.find('Veterinario', r.veterinario_id); if(!v) return '-'; const p=db.find('Persona', v.persona_id); return p ? (p.nombre + ' ' + (p.apellido||'')) : ('Vet #' + v.veterinario_id)})()}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${r.evaluacion_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${r.evaluacion_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}
	function load(id) {
		const r = db.find('Evaluacion_Medica', id);
		if (!r) return;
		document.getElementById('id').value = r.evaluacion_id;
		document.getElementById('tratamiento').value = r.tratamiento_id || '';
		document.getElementById('descripcion').value = r.descripcion || '';
		document.getElementById('fecha').value = r.fecha || '';
		document.getElementById('veterinario').value = r.veterinario_id || '';
	}
	function save(e) {
		e.preventDefault();
		const id = Number(document.getElementById('id').value);
		const payload = {
			tratamiento_id: Number(document.getElementById('tratamiento').value),
			descripcion: document.getElementById('descripcion').value.trim(),
			fecha: document.getElementById('fecha').value || new Date().toISOString().slice(0,10),
			veterinario_id: Number(document.getElementById('veterinario').value)
		};
		if (id) db.update('Evaluacion_Medica', { ...payload, evaluacion_id: id });
		else db.create('Evaluacion_Medica', payload);
		document.getElementById('form').reset();
		render();
	}
	function remove(id) { db.remove('Evaluacion_Medica', id); render(); }

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


