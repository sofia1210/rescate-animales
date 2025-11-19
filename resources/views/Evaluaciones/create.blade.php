@extends('layouts.admin')

@section('title', 'Nueva Evaluación - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Nueva Evaluación Médica</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('evaluaciones.index') }}">Evaluaciones</a></li>
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
								<label>Tratamiento</label>
								<select class="form-control" id="tratamiento"></select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Veterinario</label>
								<select class="form-control" id="veterinario"></select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Descripción</label>
								<input type="text" class="form-control" id="descripcion" placeholder="Descripción">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Fecha</label>
								<input type="date" class="form-control" id="fecha">
							</div>
						</div>
					</div>
					<div class="text-right">
						<a href="{{ route('evaluaciones.index') }}" class="btn btn-secondary">Cancelar</a>
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
		document.getElementById('tratamiento').innerHTML = db.get('Tipo_Tratamiento').map(t => `<option value="${t.tratamiento_id}">${t.nombre}</option>`).join('');
		document.getElementById('veterinario').innerHTML = db.get('Veterinario').map(v => {
			const p = db.find('Persona', v.persona_id);
			const name = p ? (p.nombre + ' ' + (p.apellido||'')) : ('Vet #' + v.veterinario_id);
			return `<option value="${v.veterinario_id}">${name}</option>`;
		}).join('');
	}
	function save(e) {
		e.preventDefault();
		db.create('Evaluacion_Medica', {
			hoja_animal_id: Number(document.getElementById('animal').value),
			tratamiento_id: Number(document.getElementById('tratamiento').value),
			descripcion: document.getElementById('descripcion').value.trim(),
			fecha: document.getElementById('fecha').value || new Date().toISOString().slice(0,10),
			veterinario_id: Number(document.getElementById('veterinario').value)
		});
		window.location.href = "{{ route('evaluaciones.index') }}";
	}
	document.addEventListener('DOMContentLoaded', function() {
		fillCombos();
		document.getElementById('btnGuardar').addEventListener('click', save);
	});
})();
</script>
@endsection


