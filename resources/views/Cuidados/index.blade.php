@extends('layouts.admin')

@section('title', 'Cuidados - Rescate Animales')

@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Cuidados</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
					<li class="breadcrumb-item active">Cuidados</li>
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
				<a href="{{ url('/cuidados/crear') }}" class="btn btn-primary btn-sm ml-2" data-role-allowed="Administrador">
					<i class="fas fa-plus"></i> Nuevo
				</a>
				<div class="ml-auto" style="min-width: 260px;">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-search"></i></span>
						</div>
						<input type="text" id="buscar" class="form-control" placeholder="Buscar por detalle...">
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<table class="table table-sm mb-0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Animal</th>
							<th>Tipo</th>
							<th>Detalle</th>
							<th>Fecha</th>
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

	function nombreHoja(id) {
		const h = db.find('Hoja_Animal', id);
		return h ? h.nombre : ('#' + id);
	}
	function nombreTipoCuidado(id) {
		const t = (db.get('Tipo_Cuidado') || []).find(x => Number(x.tipo_cuidado_id) === Number(id));
		return t ? t.nombre : ('#' + id);
	}

	function render() {
		const q = ($buscar.value || '').toLowerCase();
		const rows = (db.get('Cuidado') || []).filter(c => (c.detalle || '').toLowerCase().includes(q));
		$tbody.innerHTML = rows.map(c => `
			<tr>
				<td>${c.cuidado_id}</td>
				<td>${nombreHoja(c.hoja_animal_id)}</td>
				<td>${nombreTipoCuidado(c.tipo_cuidado_id)}</td>
				<td>${c.detalle || '-'}</td>
				<td>${c.fecha || '-'}</td>
				<td class="text-right">
					<button class="btn btn-xs btn-info" data-action="edit" data-id="${c.cuidado_id}"><i class="fas fa-pen"></i></button>
					<button class="btn btn-xs btn-danger" data-action="del" data-id="${c.cuidado_id}"><i class="fas fa-trash"></i></button>
				</td>
			</tr>
		`).join('');
	}

	function remove(id) { db.remove('Cuidado', id); render(); }

	document.addEventListener('DOMContentLoaded', function() {
		render();
		$buscar.addEventListener('input', render);
		$tbody.addEventListener('click', function(e) {
			const btn = e.target.closest('button[data-action]');
			if (!btn) return;
			const id = Number(btn.dataset.id);
			if (btn.dataset.action === 'del') remove(id);
		});
	});
})();
</script>
@endsection


