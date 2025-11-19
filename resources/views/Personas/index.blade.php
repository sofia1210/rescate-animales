@extends('layouts.admin')

@section('title', 'Personas y Solicitudes - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Personas y Solicitudes</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Personas</li>
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
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>3</h3>
						<p>Solicitudes Pendientes</p>
					</div>
					<div class="icon">
						<i class="fas fa-user-clock"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-success">
					<div class="inner">
						<h3>20</h3>
						<p>Personas Registradas</p>
					</div>
					<div class="icon">
						<i class="fas fa-users"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>5</h3>
						<p>Veterinarios</p>
					</div>
					<div class="icon">
						<i class="fas fa-user-doctor"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3>7</h3>
						<p>Rescatistas</p>
					</div>
					<div class="icon">
						<i class="fas fa-people-carry-box"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card card-success card-outline">
					<div class="card-header d-flex align-items-center">
						<h3 class="card-title mb-0">Solicitudes de Rol</h3>
						<span class="badge badge-info ml-2" id="solCount">0</span>
					</div>
					<div class="card-body p-0">
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Rol</th>
									<th>Estado</th>
									<th class="text-right">Acciones</th>
								</tr>
							</thead>
							<tbody id="tablaSolicitudes" data-role-allowed="Administrador" data-role-visibility="disable"></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card card-primary card-outline">
					<div class="card-header d-flex align-items-center">
						<h3 class="card-title mb-0">Personas</h3>
						<div class="ml-auto" style="min-width: 240px;">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
								<input type="text" id="buscarPersona" class="form-control" placeholder="Buscar por nombre...">
							</div>
						</div>
					</div>
					<div class="card-body p-0">
						<table class="table table-sm mb-0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>CI</th>
									<th>Teléfono</th>
									<th>Cuidador</th>
									<th class="text-right">Acciones</th>
								</tr>
							</thead>
							<tbody id="tablaPersonas" data-role-allowed="Administrador" data-role-visibility="disable"></tbody>
						</table>
					</div>
					<div class="card-footer">
						<form id="formPersona">
							<input type="hidden" id="personaId">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nombre</label>
										<input type="text" class="form-control" id="personaNombre" placeholder="Nombre">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Apellido</label>
										<input type="text" class="form-control" id="personaApellido" placeholder="Apellido">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>CI</label>
										<input type="text" class="form-control" id="personaCI" placeholder="CI">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Teléfono</label>
										<input type="text" class="form-control" id="personaTel" placeholder="Teléfono">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group mb-0">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="personaCuidador">
											<label class="custom-control-label" for="personaCuidador">Es Cuidador</label>
										</div>
									</div>
								</div>
							</div>
							<div class="text-right">
								<button class="btn btn-primary" id="btnGuardarPersona" data-encargado-allowed>Guardar</button>
							</div>
						</form>
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
	const $solBody = document.getElementById('tablaSolicitudes');
	const $solCount = document.getElementById('solCount');
	const $perBody = document.getElementById('tablaPersonas');
	const $buscarPersona = document.getElementById('buscarPersona');

	function renderSolicitudes() {
		const rows = db.get('Solicitud_Rol');
		$solCount.textContent = rows.length;
		$solBody.innerHTML = rows.map(r => `
			<tr>
				<td>${r.solicitud_id}</td>
				<td>${r.usuario_id}</td>
				<td>${r.rol_solicitado}</td>
				<td><span class="badge ${r.estado === 'aprobada' ? 'badge-success' : r.estado === 'rechazada' ? 'badge-danger' : 'badge-warning'}">${r.estado}</span></td>
				<td class="text-right">
					<button class="btn btn-xs btn-success" data-action="aprobar" data-id="${r.solicitud_id}"><i class="fas fa-check"></i></button>
					<button class="btn btn-xs btn-danger" data-action="rechazar" data-id="${r.solicitud_id}"><i class="fas fa-times"></i></button>
				</td>
			</tr>
		`).join('');
	}

	function renderPersonas() {
		const q = ($buscarPersona.value || '').toLowerCase();
		const rows = db.get('Persona').filter(p => (`${p.nombre} ${p.apellido}`.toLowerCase()).includes(q));
		$perBody.innerHTML = rows.map(p => `
			<tr>
				<td>${p.persona_id}</td>
				<td>${p.nombre} ${p.apellido || ''}</td>
				<td>${p.ci || '-'}</td>
				<td>${p.telefono || '-'}</td>
				<td>${p.cuidador ? '<span class="badge badge-success">Sí</span>' : '<span class="badge badge-secondary">No</span>'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="editar" data-id="${p.persona_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="eliminar" data-id="${p.persona_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}

	function aprobarSolicitud(id, ok) {
		const row = db.find('Solicitud_Rol', id);
		if (!row) return;
		db.update('Solicitud_Rol', { solicitud_id: id, estado: ok ? 'aprobada' : 'rechazada' });
		if (ok) {
			if (row.rol_solicitado === 'Veterinario') {
				db.create('Veterinario', { persona_id: (db.get('Persona')[0] || {}).persona_id || 0, especialidad: 'General', cv_documentado: 1 });
			}
			if (row.rol_solicitado === 'Rescatista') {
				db.create('Rescatista', { persona_id: (db.get('Persona')[0] || {}).persona_id || 0, cv_documentado: 1 });
			}
			alert('Solicitud aprobada.');
		} else {
			alert('Solicitud rechazada.');
		}
		renderSolicitudes();
	}

	function cargarPersona(id) {
		const p = db.find('Persona', id);
		if (!p) return;
		document.getElementById('personaId').value = p.persona_id;
		document.getElementById('personaNombre').value = p.nombre || '';
		document.getElementById('personaApellido').value = p.apellido || '';
		document.getElementById('personaCI').value = p.ci || '';
		document.getElementById('personaTel').value = p.telefono || '';
		document.getElementById('personaCuidador').checked = !!p.cuidador;
	}

	function guardarPersona(e) {
		e.preventDefault();
		const id = Number(document.getElementById('personaId').value);
		const payload = {
			nombre: document.getElementById('personaNombre').value.trim(),
			apellido: document.getElementById('personaApellido').value.trim(),
			ci: document.getElementById('personaCI').value.trim(),
			telefono: document.getElementById('personaTel').value.trim(),
			cuidador: document.getElementById('personaCuidador').checked ? 1 : 0
		};
		if (id) {
			db.update('Persona', { ...payload, persona_id: id });
		} else {
			db.create('Persona', payload);
		}
		document.getElementById('formPersona').reset();
		renderPersonas();
	}

	function eliminarPersona(id) {
		db.remove('Persona', id);
		renderPersonas();
	}

	document.addEventListener('DOMContentLoaded', function() {
		renderSolicitudes();
		renderPersonas();
		$buscarPersona.addEventListener('input', renderPersonas);
		$solBody.addEventListener('click', function(e) {
			const btn = e.target.closest('button[data-action]');
			if (!btn) return;
			const id = Number(btn.dataset.id);
			if (btn.dataset.action === 'aprobar') aprobarSolicitud(id, true);
			if (btn.dataset.action === 'rechazar') aprobarSolicitud(id, false);
		});
		$perBody.addEventListener('click', function(e) {
			const btn = e.target.closest('button[data-action]');
			if (!btn) return;
			const id = Number(btn.dataset.id);
			if (btn.dataset.action === 'editar') cargarPersona(id);
			if (btn.dataset.action === 'eliminar') eliminarPersona(id);
		});
		document.getElementById('btnGuardarPersona').addEventListener('click', guardarPersona);
	});
})();
</script>
@endsection


