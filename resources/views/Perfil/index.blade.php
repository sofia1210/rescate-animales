@extends('layouts.admin')

@section('title', 'Perfil de Usuario')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Perfil de Usuario</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Perfil</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- Datos Personales -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos Personales</h3>
            </div>
            <div class="card-body">
                <form id="perfilForm">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre Completo *</label>
                            <input type="text" class="form-control" id="perfil-nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email *</label>
                            <input type="email" class="form-control" id="perfil-email" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" id="perfil-telefono" placeholder="Opcional">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label>Documento de Identidad</label>
                            <input type="text" class="form-control" id="perfil-documento" placeholder="Opcional">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label>Dirección</label>
                            <input type="text" class="form-control" id="perfil-direccion" placeholder="Opcional">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary" id="btnGuardarPerfil">Guardar Cambios</button>
                <button class="btn btn-secondary" id="btnResetPerfil">Restablecer</button>
            </div>
        </div>

        <!-- Solicitud de Cambio de Rol -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Solicitud de Cambio de Rol</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Selecciona el rol al que deseas cambiar y envía tu solicitud.</p>
                <div class="row">
                    <div class="col-md-6">
                        <label>Rol solicitado *</label>
                        <select class="form-control" id="solicitud-rol">
                            <option value="">Selecciona un rol</option>
                            <option value="Ciudadano">Ciudadano</option>
                            <option value="Rescatista">Rescatista</option>
                            <option value="Cuidador">Cuidador</option>
                            <option value="Veterinario">Veterinario</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Motivo (Opcional)</label>
                        <input type="text" class="form-control" id="solicitud-motivo" placeholder="Describe brevemente el motivo">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-success" id="btnSolicitarCambioRol">Solicitar Cambio de Rol</button>
            </div>
        </div>

        <!-- Estado de Solicitud -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Estado de tu última solicitud</h3>
            </div>
            <div class="card-body">
                <div id="estadoSolicitudContainer">
                    <div class="alert alert-secondary mb-0">
                        No tienes solicitudes recientes.
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-outline-danger" id="btnCancelarSolicitud">Cancelar Solicitud</button>
            </div>
        </div>

        <!-- Modal (confirmación de envío) -->
        <div class="modal fade" id="modalConfirmSolicitud" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">Enviar Solicitud de Cambio de Rol</h5>
                        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p id="confirmSolicitudText" class="mb-1"></p>
                        <p class="text-muted mb-0">Tu solicitud quedará con estado “Pendiente”.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" id="btnConfirmEnviar">Enviar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('css')
<style>
    .gap-2 > * + * { margin-left: .5rem; }
</style>
@endsection

@section('js')
<script>
(function() {
    const LS_PERFIL = 'perfil_usuario';
    const LS_SOLICITUD = 'solicitud_rol';

    function cargarPerfil() {
        try {
            const data = JSON.parse(localStorage.getItem(LS_PERFIL) || '{}');
            document.getElementById('perfil-nombre').value = data.nombre || '';
            document.getElementById('perfil-email').value = data.email || '';
            document.getElementById('perfil-telefono').value = data.telefono || '';
            document.getElementById('perfil-documento').value = data.documento || '';
            document.getElementById('perfil-direccion').value = data.direccion || '';
        } catch(e) {}
    }

    function validarPerfil() { console.warn('Completa al menos Nombre y Email.'); }
    function guardarPerfil() { console.log('Datos guardados correctamente.'); }
    function restablecerPerfil() { console.log('Datos restablecidos.'); }
    function solicitarRol() { console.warn('Selecciona el rol que deseas solicitar.'); }
    function enviarSolicitud() { console.log('Solicitud enviada. Estado: Pendiente.'); }
    function cancelarSolicitud() { console.warn('No hay solicitud que cancelar.'); }
    function solicitudCancelada() { console.log('Solicitud cancelada.'); }
    function renderEstadoSolicitud() {
        const cont = document.getElementById('estadoSolicitudContainer');
        const raw = localStorage.getItem(LS_SOLICITUD);
        if (!raw) {
            cont.innerHTML = '<div class="alert alert-secondary mb-0">No tienes solicitudes recientes.</div>';
            return;
        }
        const s = JSON.parse(raw);
        cont.innerHTML = `
            <div class="alert alert-info mb-2">
                <strong>Rol solicitado:</strong> ${s.rol}<br>
                <strong>Estado:</strong> ${s.estado}<br>
                <small class="text-muted">Fecha: ${s.fecha}</small>
            </div>
            ${s.motivo ? `<p class="text-muted mb-0"><strong>Motivo:</strong> ${s.motivo}</p>` : ''}
        `;
    }

    function solicitarCambioRol() {
        const rol = document.getElementById('solicitud-rol').value;
        if (!rol) {
            alert('Selecciona el rol que deseas solicitar.');
            return;
        }
        const text = `¿Confirmas enviar la solicitud para cambiar tu rol a "${rol}"?`;
        document.getElementById('confirmSolicitudText').textContent = text;
        $('#modalConfirmSolicitud').modal('show');
    }

    function confirmarEnviarSolicitud() {
        const rol = document.getElementById('solicitud-rol').value;
        const motivo = document.getElementById('solicitud-motivo').value.trim();
        const payload = {
            rol,
            motivo,
            estado: 'Pendiente',
            fecha: new Date().toLocaleString()
        };
        localStorage.setItem(LS_SOLICITUD, JSON.stringify(payload));
        $('#modalConfirmSolicitud').modal('hide');
        renderEstadoSolicitud();
        alert('Solicitud enviada. Estado: Pendiente.');
    }

    function cancelarSolicitud() {
        if (!localStorage.getItem(LS_SOLICITUD)) {
            alert('No hay solicitud que cancelar.');
            return;
        }
        if (confirm('¿Deseas cancelar tu última solicitud de cambio de rol?')) {
            localStorage.removeItem(LS_SOLICITUD);
            renderEstadoSolicitud();
            alert('Solicitud cancelada.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        cargarPerfil();
        renderEstadoSolicitud();

        document.getElementById('btnGuardarPerfil').addEventListener('click', function(e) {
            e.preventDefault(); guardarPerfil();
        });
        document.getElementById('btnResetPerfil').addEventListener('click', function(e) {
            e.preventDefault(); resetPerfil();
        });
        document.getElementById('btnSolicitarCambioRol').addEventListener('click', function(e) {
            e.preventDefault(); solicitarCambioRol();
        });
        document.getElementById('btnConfirmEnviar').addEventListener('click', function(e) {
            e.preventDefault(); confirmarEnviarSolicitud();
        });
        document.getElementById('btnCancelarSolicitud').addEventListener('click', function(e) {
            e.preventDefault(); cancelarSolicitud();
        });
    });
})();
</script>
@endsection