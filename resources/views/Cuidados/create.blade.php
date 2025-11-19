@extends('layouts.admin')

@section('title', 'Nuevo Cuidado - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Registrar Cuidado</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('cuidados.index') }}">Cuidados</a></li>
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
								<label>Animal</label>
								<select class="form-control" id="animal"></select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tipo de Cuidado</label>
								<select class="form-control" id="tipo"></select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Fecha</label>
								<input type="date" class="form-control" id="fecha">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Detalle</label>
								<input type="text" class="form-control" id="detalle" placeholder="Detalle del cuidado">
							</div>
						</div>
					</div>
					<div class="text-right">
						<a href="{{ route('cuidados.index') }}" class="btn btn-secondary">Cancelar</a>
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
		document.getElementById('animal').innerHTML = db.get('Hoja_Animal').map(h => `<option value="${h.hoja_animal_id}">${h.nombre}</option>`).join('');
		document.getElementById('tipo').innerHTML = db.get('Tipo_Cuidado').map(t => `<option value="${t.tipo_cuidado_id}">${t.nombre}</option>`).join('');
	}
	function save(e) {
		e.preventDefault();
		db.create('Cuidado', {
			hoja_animal_id: Number(document.getElementById('animal').value),
			tipo_cuidado_id: Number(document.getElementById('tipo').value),
			detalle: document.getElementById('detalle').value.trim(),
			fecha: document.getElementById('fecha').value || new Date().toISOString().slice(0,10),
			cuidador_persona_id: 3
		});
		window.location.href = "{{ route('cuidados.index') }}";
	}
	document.addEventListener('DOMContentLoaded', function() {
		fillCombos();
		document.getElementById('btnGuardar').addEventListener('click', save);
	});
})();
</script>
@endsection

