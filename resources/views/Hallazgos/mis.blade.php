@extends('layouts.admin')

@section('title', 'Mis Hallazgos - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Mis Hallazgos</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Mis Hallazgos</li>
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
							<th>Observaciones</th>
							<th>Cant.</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody id="tbody"></tbody>
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
	const CURRENT_PERSONA_ID = 1; // simulación

	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = (db.get('Reporte') || [])
			.filter(r => Number(r.persona_id || 0) === CURRENT_PERSONA_ID)
			.filter(r => (r.direccion || '').toLowerCase().includes(q));
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
			</tr>
		`).join('');
	}

	document.addEventListener('DOMContentLoaded', function() {
		render();
		$buscar.addEventListener('input', render);
	});
})();
</script>
@endsection


