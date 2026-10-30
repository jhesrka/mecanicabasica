<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Gestión de Personal en Blanco */
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

    /* Avatar Nativo con Iniciales */
    .user-avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.82rem;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(255, 85, 0, 0.35);
    }

    .user-avatar-circle.avatar-tech {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.35);
    }

    .user-avatar-circle.avatar-seller {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.35);
    }

    /* Badges de Roles con Punto Luminoso */
    .badge-pill-role {
        padding: 6px 12px;
        font-size: 0.74rem;
        font-weight: 700;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pill-role::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .role-admin { background: #fee2e2; color: #b91c1c; }
    .role-admin::before { background: #ef4444; }

    .role-tecnico { background: #e0f2fe; color: #0369a1; }
    .role-tecnico::before { background: #0284c7; }

    .role-vendedor { background: #dcfce7; color: #15803d; }
    .role-vendedor::before { background: #22c55e; }

    /* Badges de Estado */
    .badge-pill-state {
        padding: 5px 10px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .state-active { background: #ecfdf5; color: #047857; }
    .state-blocked { background: #f1f5f9; color: #64748b; }

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
        cursor: pointer;
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

    .form-control-custom, .form-select-custom {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.92rem;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus, .form-select-custom:focus {
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
            <h1>Gestión de Personal</h1>
            <p>Administración de cuentas de acceso, roles y permisos de colaboradores</p>
        </div>
        
        <div>
            <button type="button" class="btn-action-orange" onclick="abrirModalCrear()">
                <i class="fa-solid fa-user-plus"></i>
                <span>Nuevo Usuario</span>
            </button>
        </div>
    </div>

    <!-- Mensajes de Alerta -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-4 border-0 rounded-3 shadow-sm" style="background: #ecfdf5; color: #047857; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check me-2 fs-6"></i>
            <div>
                <?php 
                    if($_GET['msg'] == 'guardado') echo "Usuario creado correctamente en el sistema.";
                    elseif($_GET['msg'] == 'actualizado') echo "Datos de acceso actualizados.";
                    elseif($_GET['msg'] == 'error_propio') echo "Advertencia: No puedes desactivar tu propia cuenta activa.";
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
                        <th>Nombre / Colaborador</th>
                        <th>Email / Usuario</th>
                        <th>Rol Asignado</th>
                        <th>Estado de Acceso</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($usuarios)): ?>
                        <?php foreach($usuarios as $user): ?>
                            <?php 
                                $initials = strtoupper(substr($user->nombre, 0, 2));
                                $avatarClass = '';
                                if($user->rol == 'tecnico') $avatarClass = 'avatar-tech';
                                if($user->rol == 'vendedor') $avatarClass = 'avatar-seller';

                                $roleBadge = 'role-admin';
                                $roleLabel = 'ADMINISTRADOR';
                                if($user->rol == 'tecnico') { $roleBadge = 'role-tecnico'; $roleLabel = 'TÉCNICO'; }
                                if($user->rol == 'vendedor') { $roleBadge = 'role-vendedor'; $roleLabel = 'VENDEDOR'; }
                            ?>
                            <tr class="<?php echo ($user->estado == 0) ? 'opacity-75' : ''; ?>">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar-circle <?php echo $avatarClass; ?>">
                                            <?php echo $initials; ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark"><?php echo htmlspecialchars($user->nombre); ?></div>
                                            <small class="text-muted">ID: #<?php echo str_pad($user->id, 3, '0', STR_PAD_LEFT); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark fw-medium">
                                        <i class="fa-regular fa-envelope text-muted me-1 small"></i>
                                        <?php echo htmlspecialchars($user->email); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-pill-role <?php echo $roleBadge; ?>">
                                        <?php echo $roleLabel; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($user->estado == 1): ?>
                                        <span class="badge-pill-state state-active">
                                            <i class="fa-solid fa-circle-check"></i> Activo
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-pill-state state-blocked">
                                            <i class="fa-solid fa-lock"></i> Bloqueado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn-table-action text-primary" onclick='editarUsuario(<?php echo json_encode($user); ?>)' title="Editar Datos">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        
                                        <?php if($user->id != $_SESSION['user_id']): ?>
                                            <?php if($user->estado == 1): ?>
                                                <button type="button" class="btn-table-action text-danger" onclick="cambiarEstado(<?php echo $user->id; ?>, 0)" title="Bloquear Acceso">
                                                    <i class="fa-solid fa-lock"></i>
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn-table-action text-success" onclick="cambiarEstado(<?php echo $user->id; ?>, 1)" title="Permitir Acceso">
                                                    <i class="fa-solid fa-lock-open"></i>
                                                </button>
                                            <?php endif; ?>
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

<!-- Modal Personal Ultra-Premium -->
<div class="modal fade" id="modalUsuario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <h5 id="tituloModal">Nuevo Usuario</h5>
                        <small class="text-muted">Crea o actualiza los permisos de acceso al sistema</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form id="formUsuario" action="/usuarios/guardar" method="POST">
                <input type="hidden" name="id" id="userId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label-custom">Nombre Completo *</label>
                        <input type="text" class="form-control form-control-custom" name="nombre" id="nombre" placeholder="Ej: Roberto Gómez Mendoza" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Correo Electrónico (Login) *</label>
                        <input type="email" class="form-control form-control-custom" name="email" id="email" placeholder="usuario@taller.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Contraseña de Acceso</label>
                        <input type="password" class="form-control form-control-custom" name="password" id="password" placeholder="••••••••">
                        <small class="text-muted d-block mt-1" id="passHelp" style="font-size: 0.76rem;"></small>
                    </div>
                    <div class="mb-2">
                        <label class="form-label-custom">Rol y Nivel de Permisos *</label>
                        <select class="form-select form-select-custom" name="rol" id="rol" required>
                            <option value="tecnico">Técnico (Órdenes y Diagnósticos)</option>
                            <option value="vendedor">Vendedor (Punto de Venta y Clientes)</option>
                            <option value="admin">Administrador (Control Total del Sistema)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-action-orange">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Guardar Usuario</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="formEstado" action="/usuarios/cambiar-estado" method="POST">
    <input type="hidden" name="id" id="idEstado">
    <input type="hidden" name="nuevo_estado" id="nuevoEstado">
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script>
    const modal = new bootstrap.Modal(document.getElementById('modalUsuario'));

    function abrirModalCrear() {
        document.getElementById('formUsuario').reset();
        document.getElementById('userId').value = '';
        document.getElementById('tituloModal').innerText = 'Nuevo Usuario';
        document.getElementById('formUsuario').action = '/usuarios/guardar';
        document.getElementById('passHelp').innerText = 'Obligatoria para nuevos usuarios.';
        document.getElementById('password').required = true;
        modal.show();
    }

    function editarUsuario(user) {
        document.getElementById('userId').value = user.id;
        document.getElementById('nombre').value = user.nombre;
        document.getElementById('email').value = user.email;
        document.getElementById('rol').value = user.rol;
        document.getElementById('password').value = ''; 
        document.getElementById('password').required = false;
        
        document.getElementById('tituloModal').innerText = 'Editar Usuario';
        document.getElementById('formUsuario').action = '/usuarios/actualizar';
        document.getElementById('passHelp').innerText = 'Dejar en blanco si deseas mantener la contraseña actual.';
        modal.show();
    }

    function cambiarEstado(id, estado) {
        const accion = estado === 1 ? 'ACTIVAR' : 'BLOQUEAR';
        if(confirm(`¿Confirmas que deseas ${accion} el acceso de este usuario?`)) {
            document.getElementById('idEstado').value = id;
            document.getElementById('nuevoEstado').value = estado;
            document.getElementById('formEstado').submit();
        }
    }
</script>
