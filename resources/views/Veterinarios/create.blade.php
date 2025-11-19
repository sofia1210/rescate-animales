@extends('layouts.admin')

@section('title', 'Nuevo Veterinario - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Registrar Veterinario</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('veterinarios.index') }}">Veterinarios</a></li>
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
						<div class="col-md-6">
							<div class="form-group">
								<label>Persona (texto)</label>
								<input type="text" class="form-control" id="persona" placeholder="Nombre o ID persona">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Especialidad</label>
								<input type="text" class="form-control" id="especialidad" placeholder="Especialidad">
							</div>
						</div>
						<div class="col-md-2 d-flex align-items-center">
							<div class="form-group mb-0">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="cv">
									<label class="custom-control-label" for="cv">CV Documentado</label>
								</div>
							</div>
						</div>
					</div>
					<div class="text-right">
						<a href="{{ route('veterinarios.index') }}" class="btn btn-secondary">Cancelar</a>
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
	function save(e) {
		e.preventDefault();
		const personaName = document.getElementById('persona').value.trim();
		const persona = db.get('Persona').find(p => (`${p.nombre} ${p.apellido||''}`).toLowerCase().includes(personaName.toLowerCase()));
		db.create('Veterinario', {
			persona_id: persona ? persona.persona_id : 0,
			especialidad: document.getElementById('especialidad').value.trim(),
			cv_documentado: document.getElementById('cv').checked ? 1 : 0
		});
		window.location.href = "{{ route('veterinarios.index') }}";
	}
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('btnGuardar').addEventListener('click', save);
	});
})();
</script>
@endsection


