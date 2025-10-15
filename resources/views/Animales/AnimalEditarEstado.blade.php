{{-- ---------------------------------------------------------------- --}}
{{--             INICIO DEL MODAL 'CAMBIAR ESTADO DE SALUD'           --}}
{{-- ---------------------------------------------------------------- --}}
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 1rem;">

            {{-- HEADER --}}
            <div class="modal-header border-0">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="fa-stack fa-2x">
                          <i class="fas fa-circle fa-stack-2x text-success" style="opacity: 0.1;"></i>
                          <i class="fas fa-user-shield fa-stack-1x text-success"></i>
                        </span>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="changeStatusModalLabel">Cambiar Estado de Salud</h5>
                        <span class="badge bg-success">Jaguar</span>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            {{-- BODY --}}
            <div class="modal-body px-4">
                {{-- Estado Actual --}}
                <div class="p-3 mb-4 rounded-3" style="background-color: #f8f9fa;">
                    <p class="text-muted mb-2">
                        <i class="fas fa-info-circle text-success me-2"></i>
                        Estado de Salud Actual
                    </p>
                    <span class="badge fs-6 border border-success text-success bg-white py-2 px-3">
                        Muy Bueno
                    </span>
                </div>

                {{-- Nuevo Estado --}}
                <p class="fw-bold text-dark">Nuevo Estado de Salud</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="status-option">
                            <input type="radio" name="health_status" value="estable" class="d-none">
                            <div class="status-card">
                                <h6><span class="status-dot bg-warning"></span>Estable</h6>
                                <p class="text-muted small">El animal está en condición estable, sin complicaciones</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="status-option">
                            <input type="radio" name="health_status" value="muy_bueno" class="d-none" checked>
                            <div class="status-card">
                                <h6><span class="status-dot bg-success"></span>Muy Bueno</h6>
                                <p class="text-muted small">El animal está en excelente condición de salud</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="status-option">
                            <input type="radio" name="health_status" value="bueno" class="d-none">
                            <div class="status-card">
                                <h6><span class="status-dot bg-primary"></span>Bueno</h6>
                                <p class="text-muted small">El animal está en buena condición de salud</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="status-option">
                            <input type="radio" name="health_status" value="malo" class="d-none">
                            <div class="status-card">
                                <h6><span class="status-dot" style="background-color: #fd7e14;"></span>Malo</h6>
                                <p class="text-muted small">El animal requiere atención médica</p>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="status-option">
                            <input type="radio" name="health_status" value="muy_malo" class="d-none">
                            <div class="status-card">
                                <h6><span class="status-dot bg-danger"></span>Muy Malo</h6>
                                <p class="text-muted small">El animal está en condición crítica</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-outline-secondary w-100" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-secondary w-100 disabled">Cambiar Estado</button>
            </div>
        </div>
    </div>
</div>
{{-- ---------------------------------------------------------------- --}}
{{--              FIN DEL MODAL 'CAMBIAR ESTADO DE SALUD'             --}}
{{-- ---------------------------------------------------------------- --}}