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

        <!-- Compromiso para ser Cuidador -->
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">Compromiso para ser Cuidador</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Para ser <strong>Cuidador</strong>, solo debes comprometerte con el cuidado responsable de los animales.</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="chkCompromisoCuidador">
                    <label class="form-check-label" for="chkCompromisoCuidador">
                        Me comprometo a seguir las políticas de cuidado responsable.
                    </label>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-warning" id="btnConvertirmeCuidador">Convertirme en Cuidador</button>
            </div>
        </div>

        <!-- Solicitud de Cambio de Rol (Veterinario / Rescatista) -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Solicitud de Cambio de Rol</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Para ser <strong>Veterinario</strong> o <strong>Rescatista</strong>, envía una solicitud y adjunta tu CV.</p>
                <div class="row">
                    <div class="col-md-4">
                        <label>Rol solicitado *</label>
                        <select class="form-control" id="solicitud-rol">
                            <option value="">Selecciona un rol</option>
                            <option value="Rescatista">Rescatista</option>
                            <option value="Veterinario">Veterinario</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Motivo (Opcional)</label>
                        <input type="text" class="form-control" id="solicitud-motivo" placeholder="Describe brevemente el motivo">
                    </div>
                    <div class="col-md-4">
                        <label>Adjuntar CV *</label>
                        <input type="file" class="form-control-file" id="solicitud-cv" accept=".pdf,.doc,.docx">
                        <small class="text-muted d-block mt-1">Formatos permitidos: PDF, DOC, DOCX.</small>
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
    const ROLE_KEY = 'app_role';

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
                ${s.cv_nombre ? `<strong>CV:</strong> ${s.cv_nombre}<br>` : ''}
                <small class="text-muted">Fecha: ${s.fecha}</small>
            </div>
            ${s.motivo ? `<p class="text-muted mb-0"><strong>Motivo:</strong> ${s.motivo}</p>` : ''}
        `;
    }

    // Compromiso directo para Cuidador
    function convertirCuidador() {
        const ok = document.getElementById('chkCompromisoCuidador').checked;
        if (!ok) {
            alert('Debes aceptar el compromiso para continuar.');
            return;
        }
        localStorage.setItem(ROLE_KEY, 'Cuidador');
        const roleSwitcher = document.getElementById('roleSwitcher');
        if (roleSwitcher) {
            roleSwitcher.value = 'Cuidador';
            // Dispara el cambio para aplicar permisos
            const evt = new Event('change', { bubbles: true });
            roleSwitcher.dispatchEvent(evt);
        }
        // Guarda marca de compromiso en perfil (simulado)
        try {
            const p = JSON.parse(localStorage.getItem(LS_PERFIL) || '{}');
            p.compromiso_cuidador = true;
            localStorage.setItem(LS_PERFIL, JSON.stringify(p));
        } catch(e) {}
        alert('Ahora eres Cuidador. ¡Gracias por tu compromiso!');
    }

    // Solicitud para Veterinario/Rescatista con CV
    function solicitarCambioRol() {
        const rol = document.getElementById('solicitud-rol').value;
        if (!rol || !['Rescatista','Veterinario'].includes(rol)) {
            alert('Selecciona Veterinario o Rescatista.');
            return;
        }
        const cv = document.getElementById('solicitud-cv').files[0];
        if (!cv) {
            alert('Adjunta tu CV para enviar la solicitud.');
            return;
        }
        const text = `¿Confirmas enviar la solicitud para cambiar tu rol a "${rol}" adjuntando tu CV?`;
        document.getElementById('confirmSolicitudText').textContent = text;
        $('#modalConfirmSolicitud').modal('show');
    }

    function confirmarEnviarSolicitud() {
        const rol = document.getElementById('solicitud-rol').value;
        const motivo = document.getElementById('solicitud-motivo').value.trim();
        const cvFile = document.getElementById('solicitud-cv').files[0];
        if (!rol || !cvFile) {
            alert('Selecciona el rol y adjunta tu CV.');
            return;
        }
        const payload = {
            rol,
            motivo,
            estado: 'Pendiente',
            fecha: new Date().toLocaleString(),
            cv_nombre: cvFile.name
        };
        localStorage.setItem(LS_SOLICITUD, JSON.stringify(payload));

        // Simula persistencia en MockDB
        if (window.MockDB) {
            window.MockDB.create('Solicitud_Rol', {
                usuario_id: 100, // simulado
                rol_solicitado: rol,
                motivo,
                estado: 'pendiente',
                fecha: new Date().toISOString().slice(0,10),
                cv_nombre: cvFile.name
            });
        }

        $('#modalConfirmSolicitud').modal('hide');
        renderEstadoSolicitud();
        alert('Solicitud enviada. Estado: Pendiente.');
    }

    function cancelarSolicitud() {
        const raw = localStorage.getItem(LS_SOLICITUD);
        if (!raw) {
            alert('No hay solicitud que cancelar.');
            return;
        }
        if (confirm('¿Deseas cancelar tu última solicitud de cambio de rol?')) {
            const s = JSON.parse(raw);
            // Marca como cancelada en MockDB (si existe id, aquí se omite y se simula)
            // Opcionalmente podríamos registrar una entrada de cancelación
            localStorage.removeItem(LS_SOLICITUD);
            renderEstadoSolicitud();
            alert('Solicitud cancelada.');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        cargarPerfil();
        renderEstadoSolicitud();

        document.getElementById('btnGuardarPerfil').addEventListener('click', function(e) {
            e.preventDefault(); console.log('Datos guardados correctamente.');
        });
        document.getElementById('btnResetPerfil').addEventListener('click', function(e) {
            e.preventDefault(); console.log('Datos restablecidos.');
        });

        document.getElementById('btnConvertirmeCuidador').addEventListener('click', function(e) {
            e.preventDefault(); convertirCuidador();
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