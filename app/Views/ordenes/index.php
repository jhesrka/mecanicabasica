<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Órdenes de Servicio en Blanco */
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

    /* Badges de Estado Redondeados */
    .badge-pill-state {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-transform: capitalize;
    }

    .badge-pill-state::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .state-pendiente { background: #fef3c7; color: #b45309; }
    .state-pendiente::before { background: #f59e0b; }

    .state-diagnostico { background: #e0e7ff; color: #4338ca; }
    .state-diagnostico::before { background: #6366f1; }

    .state-reparado { background: #e0f2fe; color: #0369a1; }
    .state-reparado::before { background: #0284c7; }

    .state-entregado { background: #dcfce7; color: #15803d; }
    .state-entregado::before { background: #22c55e; }

    .state-cancelado { background: #fee2e2; color: #b91c1c; }
    .state-cancelado::before { background: #ef4444; }

    /* Botones de Acción de Fila */
    .btn-table-action {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #475569;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.2s ease;
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

    .modal-step-title {
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #ff5500;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-step-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #f1f5f9;
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
            <h1>Órdenes de Servicio</h1>
            <p>Control y trazabilidad de ingresos, diagnósticos y reparaciones</p>
        </div>
        
        <div>
            <button type="button" class="btn-action-orange" data-bs-toggle="modal" data-bs-target="#modalOrden">
                <i class="fa-solid fa-plus"></i>
                <span>Nueva Orden</span>
            </button>
        </div>
    </div>

    <!-- Mensajes de Alerta -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-4 border-0 rounded-3 shadow-sm" style="background: #ecfdf5; color: #047857; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check me-2 fs-6"></i>
            <div>
                <?php 
                    if($_GET['msg'] == 'guardado') echo "Orden generada exitosamente.";
                    elseif($_GET['msg'] == 'estado_actualizado') echo "Estado de la orden actualizado correctamente.";
                    else echo "Acción realizada con éxito.";
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
                        <th># Ticket</th>
                        <th>Cliente</th>
                        <th>Vehículo / Placa</th>
                        <th>Fecha Ingreso</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($ordenes)): ?>
                        <?php foreach($ordenes as $orden): ?>
                            <?php 
                                $badgeClass = 'state-pendiente';
                                if($orden->estado == 'diagnostico') $badgeClass = 'state-diagnostico';
                                if($orden->estado == 'reparado') $badgeClass = 'state-reparado';
                                if($orden->estado == 'entregado') $badgeClass = 'state-entregado';
                                if($orden->estado == 'cancelado') $badgeClass = 'state-cancelado';
                            ?>
                            <tr>
                                <td>
                                    <strong class="text-dark font-monospace"><?php echo 'ORD-' . str_pad($orden->id, 4, '0', STR_PAD_LEFT); ?></strong>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?php echo htmlspecialchars($orden->cliente_nombre); ?></div>
                                    <small class="text-muted"><i class="fa-solid fa-phone me-1 opacity-75"></i> <?php echo htmlspecialchars($orden->cliente_telefono); ?></small>
                                </td>
                                <td>
                                    <?php 
                                        $placaMostrar = !empty($orden->placa) ? $orden->placa : (!empty($orden->equipo_serie) ? $orden->equipo_serie : 'S/P');
                                        $tipoVehiculo = !empty($orden->equipo_tipo) ? $orden->equipo_tipo : 'Auto';
                                    ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-dark text-white px-2 py-1 font-monospace" style="letter-spacing: 1px; border: 1px solid #475569; font-size: 0.78rem;">
                                            <i class="fa-solid fa-car me-1 text-warning"></i><?php echo htmlspecialchars($placaMostrar); ?>
                                        </span>
                                        <span class="fw-semibold text-dark"><?php echo htmlspecialchars($orden->equipo_marca . ' ' . $orden->equipo_modelo); ?></span>
                                    </div>
                                    <small class="text-muted text-truncate d-inline-block mt-1" style="max-width: 280px;">
                                        <i class="fa-solid fa-wrench me-1 text-secondary opacity-75"></i><?php echo htmlspecialchars(substr($orden->falla_reportada, 0, 45)) . '...'; ?>
                                    </small>
                                </td>
                                <td class="text-muted">
                                    <?php echo date('d/m/Y H:i', strtotime($orden->fecha_recepcion)); ?>
                                </td>
                                <td>
                                    <span class="badge-pill-state <?php echo $badgeClass; ?>">
                                        <?php echo ucfirst($orden->estado); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <div class="dropdown">
                                            <button type="button" class="btn-table-action dropdown-toggle" data-bs-toggle="dropdown">
                                                Estado
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 p-1" style="border-radius: 12px; font-size: 0.86rem;">
                                                <li><form action="/ordenes/cambiar-estado" method="POST"><input type="hidden" name="id" value="<?php echo $orden->id; ?>"><input type="hidden" name="nuevo_estado" value="pendiente"><button class="dropdown-item rounded-2 py-2">Pendiente</button></form></li>
                                                <li><form action="/ordenes/cambiar-estado" method="POST"><input type="hidden" name="id" value="<?php echo $orden->id; ?>"><input type="hidden" name="nuevo_estado" value="diagnostico"><button class="dropdown-item rounded-2 py-2">En Diagnóstico</button></form></li>
                                                <li><form action="/ordenes/cambiar-estado" method="POST"><input type="hidden" name="id" value="<?php echo $orden->id; ?>"><input type="hidden" name="nuevo_estado" value="reparado"><button class="dropdown-item rounded-2 py-2">Reparado</button></form></li>
                                                <li><hr class="dropdown-divider my-1"></li>
                                                <li><form action="/ordenes/cambiar-estado" method="POST"><input type="hidden" name="id" value="<?php echo $orden->id; ?>"><input type="hidden" name="nuevo_estado" value="entregado"><button class="dropdown-item text-success rounded-2 py-2"><i class="fa-solid fa-circle-check me-1"></i> Entregar</button></form></li>
                                            </ul>
                                        </div>

                                        <a href="/ordenes/detalle?id=<?php echo $orden->id; ?>" class="btn-table-action text-primary" title="Ver Detalle">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
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

<!-- Modal Nueva Orden Ultra-Premium -->
<div class="modal fade" id="modalOrden" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h5>Nueva Orden de Servicio</h5>
                        <small class="text-muted">Ingresa los datos para generar el ticket</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="/ordenes/guardar" method="POST">
                <div class="modal-body">
                    <!-- Paso 1: Cliente -->
                    <div class="modal-step-title">
                        <span>1. Datos del Cliente</span>
                    </div>
                    <div class="mb-4">
                        <label class="form-label-custom">Seleccionar Cliente *</label>
                        <select class="form-select form-select-custom" name="cliente_id" required>
                            <option value="">-- Buscar y Seleccionar Cliente --</option>
                            <?php foreach($clientes as $cliente): ?>
                                <?php if($cliente->estado == 1): ?>
                                    <option value="<?php echo $cliente->id; ?>">
                                        <?php echo htmlspecialchars($cliente->nombre . ' — Tel: ' . $cliente->telefono); ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Paso 2: Datos del Vehículo -->
                    <div class="modal-step-title">
                        <span>2. Datos del Vehículo</span>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label-custom">Placa (Patente) *</label>
                            <input type="text" class="form-control form-control-custom font-monospace fw-bold text-uppercase" name="placa" placeholder="Ej: ABC-123" required style="letter-spacing: 1.5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Tipo de Vehículo *</label>
                            <select class="form-select form-select-custom" name="equipo_tipo" required>
                                <option value="Automóvil / Sedán">Automóvil / Sedán</option>
                                <option value="SUV / Crossover">SUV / Crossover</option>
                                <option value="Camioneta / Pick-up">Camioneta / Pick-up</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="Motocicleta">Motocicleta</option>
                                <option value="Van / Miniván">Van / Miniván</option>
                                <option value="Camión / Comercial">Camión / Comercial</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Marca del Vehículo *</label>
                            <input type="text" class="form-control form-control-custom" name="equipo_marca" placeholder="Ej: Toyota, Nissan, Hyundai" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label-custom">Modelo</label>
                            <input type="text" class="form-control form-control-custom" name="equipo_modelo" placeholder="Ej: Hilux, Corolla, Tucson">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Año Fabricación</label>
                            <input type="number" class="form-control form-control-custom" name="anio" placeholder="Ej: 2020" min="1950" max="<?php echo date('Y') + 1; ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Color</label>
                            <input type="text" class="form-control form-control-custom" name="color" placeholder="Ej: Blanco, Plata, Negro">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label-custom">Kilometraje Actual</label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-custom" name="kilometraje" placeholder="Ej: 85400">
                                <span class="input-group-text bg-light border-0 text-muted small">Km</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Nivel de Combustible</label>
                            <select class="form-select form-select-custom" name="nivel_combustible">
                                <option value="Reserva">⛽ Reserva</option>
                                <option value="1/4">⛽ 1/4 de Tanque</option>
                                <option value="1/2" selected>⛽ 1/2 de Tanque</option>
                                <option value="3/4">⛽ 3/4 de Tanque</option>
                                <option value="Lleno">⛽ Tanque Lleno</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">N° VIN / Chasis (Opcional)</label>
                            <input type="text" class="form-control form-control-custom text-uppercase" name="vin_chasis" placeholder="N° Chasis / Motor">
                        </div>
                    </div>

                    <!-- Paso 3: Detalle del Servicio -->
                    <div class="modal-step-title">
                        <span>3. Detalle del Servicio</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Falla Reportada por el Cliente *</label>
                        <textarea class="form-control form-control-custom" name="falla_reportada" rows="3" placeholder="Describe los síntomas, fallas o requerimientos del servicio..." required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label-custom">Fecha Promesa de Entrega</label>
                        <input type="date" class="form-control form-control-custom" name="fecha_promesa">
                    </div>
                </div>

                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-action-orange">
                        <i class="fa-solid fa-check"></i>
                        <span>Generar Ticket de Servicio</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
