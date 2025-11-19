@extends('layouts.admin')

@section('title', 'Nuevo Traslado - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Registrar Traslado</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('traslados.index') }}">Traslados</a></li>
					<li class="breadcrumb-item active">Crear</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="card card-primary card-outline">
			<div class="card-body">
				<form id="form">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Rescatista</label>
								<select class="form-control" id="rescatista"></select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Centro</label>
								<select class="form-control" id="centro"></select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Nombre traslado</label>
								<input type="text" class="form-control" id="nombre" placeholder="Nombre traslado">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Observaciones</label>
								<input type="text" class="form-control" id="obs" placeholder="Observaciones">
							</div>
						</div>
					</div>
					<div class="text-right">
						<a href="{{ route('traslados.index') }}" class="btn btn-secondary">Cancelar</a>
						<button class="btn btn-primary" id="btnGuardar">Guardar</button>
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
	function fillCombos() {
		document.getElementById('rescatista').innerHTML = db.get('Rescatista').map(r => {
			const p = db.find('Persona', r.persona_id);
			const name = p ? (p.nombre + ' ' + (p.apellido||'')) : ('Resc #' + r.rescatista_id);
			return `<option value="${r.rescatista_id}">${name}</option>`;
		}).join('');
		document.getElementById('centro').innerHTML = db.get('Centro').map(c => `<option value="${c.centro_id}">${c.nombre}</option>`).join('');
	}
	function save(e) {
		e.preventDefault();
		db.create('Traslado', {
			rescastista_id: Number(document.getElementById('rescatista').value),
			centro_id: Number(document.getElementById('centro').value),
			nombre: document.getElementById('nombre').value.trim(),
			observaciones: document.getElementById('obs').value.trim()
		});
		window.location.href = "{{ route('traslados.index') }}";
	}
	document.addEventListener('DOMContentLoaded', function() {
		fillCombos();
		document.getElementById('btnGuardar').addEventListener('click', save);
	});
})();
</script>
@endsection


