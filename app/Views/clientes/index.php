<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Gestión de Clientes en Blanco */
    .module-container {
        padding: 6px 4px;
    }

    /* Cabecera Superior */
    .module-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 26px;
    }

    .module-title-box h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.85rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 3px;
        letter-spacing: -0.5px;
    }

    .module-title-box p {
        font-size: 0.88rem;
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    /* Botón Naranja de Acción Principal */
    .btn-action-orange {
        background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 10px 20px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(255, 85, 0, 0.35);
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-action-orange:hover {
        background: linear-gradient(135deg, #ff4500 0%, #ff6600 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 85, 0, 0.45);
    }

    /* Contenedor Tarjeta de Tabla Blanco Flotante */
    .card-table-white {
        background: #ffffff;
        border-radius: 20px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.02);
        overflow: hidden;
        padding: 24px;
    }

    /* Sobrescritura Elegante de DataTables */
    .dataTables_wrapper {
        padding: 0;
    }

    /* Botones de Exportación DataTables */
    .dt-buttons {
        margin-bottom: 18px;
        display: inline-flex;
        gap: 8px;
    }

    .dt-buttons .btn {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        color: #475569 !important;
        font-weight: 600 !important;
        font-size: 0.82rem !important;
        padding: 7px 14px !important;
        border-radius: 10px !important;
        transition: all 0.2s ease !important;
        box-shadow: none !important;
    }

    .dt-buttons .btn:hover {
        background: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
        color: #0f172a !important;
        transform: translateY(-1px);
    }

    .dt-buttons .buttons-excel i { color: #10b981; }
    .dt-buttons .buttons-pdf i { color: #ef4444; }
    .dt-buttons .buttons-print i { color: #3b82f6; }

    /* Input de Búsqueda DataTables */
    .dataTables_filter {
        margin-bottom: 18px;
    }

    .dataTables_filter label {
        font-size: 0.86rem;
        font-weight: 600;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dataTables_filter input {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 0.88rem;
        outline: none;
        transition: all 0.2s ease;
        background: #f8fafc;
    }

    .dataTables_filter input:focus {
        border-color: #ff6a00;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.12);
    }

    /* Tabla Personalizada */
    .table-custom {
        margin-bottom: 0 !important;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background: #f8fafc !important;
        color: #64748b !important;
        font-size: 0.74rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        padding: 14px 18px !important;
        border-bottom: 1.5px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .table-custom tbody td {
        padding: 14px 18px !important;
        vertical-align: middle !important;
        color: #334155 !important;
        font-size: 0.92rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    /* Avatar Redondo con Iniciales */
    .client-avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    /* Badges de Estado Redondeados */
    .badge-pill-state {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-pill-state::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .state-activo { background: #dcfce7; color: #15803d; }
    .state-activo::before { background: #22c55e; }

    .state-inactivo { background: #f1f5f9; color: #64748b; }
    .state-inactivo::before { background: #94a3b8; }

    /* Botones de Acción de Fila */
    .btn-table-action {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #475569;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-table-action:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #cbd5e1;
    }

    /* Paginación DataTables */
    .dataTables_paginate {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 4px;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        padding: 6px 12px !important;
        font-size: 0.84rem !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        color: #475569 !important;
        transition: all 0.2s !important;
    }

    .dataTables_paginate .paginate_button:hover {
        background: #f8fafc !important;
        color: #0f172a !important;
    }

    .dataTables_paginate .paginate_button.current {
        background: #ff5500 !important;
        border-color: #ff5500 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    .dataTables_info {
        font-size: 0.84rem;
        color: #64748b;
        margin-top: 20px;
    }

    /* Modal Ultra-Premium */
    .modal-content-custom {
        border: 1px solid #f1f5f9;
        border-radius: 22px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .modal-header-custom {
        background: #ffffff;
        padding: 22px 26px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-icon-badge {
        width: 42px;
        height: 42px;
        background: #fff7ed;
        color: #ea580c;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
    }

    .modal-header-custom h5 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.25rem;
        color: #0f172a;
        margin: 0;
    }

    .modal-body {
        padding: 26px;
    }

    .form-label-custom {
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }

    .form-control-custom {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.92rem;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: #ff6a00;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.12);
        outline: none;
    }

    .modal-footer-custom {
        padding: 18px 26px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-modal-cancel {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        color: #64748b;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: all 0.2s;
    }

    .btn-modal-cancel:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
</style>

<div class="module-container">
    <!-- Header Superior -->
    <div class="module-header">
        <div class="module-title-box">
            <h1>Gestión de Clientes</h1>
            <p>Directorio, historial y fidelización de propietarios y vehículos</p>
        </div>
        
        <div>
            <button type="button" class="btn-action-orange" onclick="abrirModalCrear()">
                <i class="fa-solid fa-plus"></i>
                <span>Nuevo Cliente</span>
            </button>
        </div>
    </div>

    <!-- Mensajes de Alerta -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-4 border-0 rounded-3 shadow-sm" style="background: #ecfdf5; color: #047857; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check me-2 fs-6"></i>
            <div>
                <?php 
                    if($_GET['msg'] == 'guardado') echo "Cliente registrado exitosamente.";
                    elseif($_GET['msg'] == 'actualizado') echo "Datos del cliente actualizados.";
                    elseif($_GET['msg'] == 'estado_cambiado') echo "El estado del cliente ha cambiado.";
                    else echo "Operación realizada correctamente.";
                ?>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Contenedor Tarjeta de Tabla Blanco -->
    <div class="card-table-white">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="datatable">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($clientes)): ?>
                        <?php foreach($clientes as $cliente): ?>
                            <?php 
                                $initials = strtoupper(substr($cliente->nombre, 0, 2));
                                $statusClass = ($cliente->estado == 1) ? 'state-activo' : 'state-inactivo';
                                $statusLabel = ($cliente->estado == 1) ? 'Activo' : 'Inactivo';
                            ?>
                            <tr class="<?php echo ($cliente->estado == 0) ? 'opacity-75' : ''; ?>">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="client-avatar-circle">
                                            <?php echo $initials; ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark"><?php echo htmlspecialchars($cliente->nombre); ?></div>
                                            <small class="text-muted">
                                                <i class="fa-solid fa-location-dot me-1 opacity-75"></i>
                                                <?php echo htmlspecialchars($cliente->direccion ?? 'Sin dirección registrada'); ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark fw-medium">
                                        <i class="fa-solid fa-phone text-muted me-1 small"></i>
                                        <?php echo htmlspecialchars($cliente->telefono ?? '—'); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        <i class="fa-regular fa-envelope text-muted me-1 small"></i>
                                        <?php echo htmlspecialchars($cliente->email ?? '—'); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-pill-state <?php echo $statusClass; ?>">
                                        <?php echo $statusLabel; ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="/clientes/perfil?id=<?php echo $cliente->id; ?>" class="btn-table-action text-primary" title="Ver Historial 360">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <button type="button" class="btn-table-action text-secondary" onclick='editarCliente(<?php echo json_encode($cliente); ?>)' title="Editar Rápido">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        
                                        <?php if($cliente->estado == 1): ?>
                                            <button type="button" class="btn-table-action text-danger" onclick="confirmarCambioEstado(<?php echo $cliente->id; ?>, 0, '<?php echo htmlspecialchars(addslashes($cliente->nombre)); ?>')" title="Desactivar">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn-table-action text-success" onclick="confirmarCambioEstado(<?php echo $cliente->id; ?>, 1, '<?php echo htmlspecialchars(addslashes($cliente->nombre)); ?>')" title="Activar">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Cliente Ultra-Premium -->
<div class="modal fade" id="modalCliente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <h5 id="tituloModal">Nuevo Cliente</h5>
                        <small class="text-muted">Ingresa la información personal y de contacto</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form id="formCliente" action="/clientes/guardar" method="POST">
                <input type="hidden" name="id" id="clienteId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label-custom">Nombre Completo *</label>
                        <input type="text" class="form-control form-control-custom" name="nombre" id="nombre" placeholder="Ej: Juan Pérez Martínez" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Teléfono *</label>
                            <input type="text" class="form-control form-control-custom" name="telefono" id="telefono" placeholder="Ej: 987654321">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-custom" name="email" id="email" placeholder="cliente@correo.com">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label-custom">Dirección / Referencia</label>
                        <input type="text" class="form-control form-control-custom" name="direccion" id="direccion" placeholder="Ej: Av. Principal 123">
                    </div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-action-orange">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Guardar Datos</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="formEstado" action="/clientes/cambiar-estado" method="POST">
    <input type="hidden" name="id" id="idEstado">
    <input type="hidden" name="nuevo_estado" id="nuevoEstado">
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script>
    const modalCliente = new bootstrap.Modal(document.getElementById('modalCliente'));

    function abrirModalCrear() {
        document.getElementById('formCliente').reset();
        document.getElementById('clienteId').value = '';
        document.getElementById('tituloModal').innerText = 'Nuevo Cliente';
        document.getElementById('formCliente').action = '/clientes/guardar';
        modalCliente.show();
    }

    function editarCliente(cliente) {
        document.getElementById('clienteId').value = cliente.id;
        document.getElementById('nombre').value = cliente.nombre;
        document.getElementById('telefono').value = cliente.telefono;
        document.getElementById('email').value = cliente.email;
        document.getElementById('direccion').value = cliente.direccion;
        document.getElementById('tituloModal').innerText = 'Editar Cliente';
        document.getElementById('formCliente').action = '/clientes/actualizar';
        modalCliente.show();
    }

    function confirmarCambioEstado(id, nuevoEstado, nombre) {
        const accion = nuevoEstado === 1 ? 'ACTIVAR' : 'DESACTIVAR';
        if(confirm(`¿Deseas ${accion} al cliente "${nombre}"?`)) {
            document.getElementById('idEstado').value = id;
            document.getElementById('nuevoEstado').value = nuevoEstado;
            document.getElementById('formEstado').submit();
        }
    }
</script>
