<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Control de Gastos y Egresos en Blanco */
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

    /* Tarjeta Métrica KPI Flotante */
    .kpi-card-white {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px 28px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.02);
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kpi-card-white:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 36px -4px rgba(15, 23, 42, 0.08);
        border-color: #e2e8f0;
    }

    .kpi-card-white::before {
        content: '';
        position: absolute;
        top: 14px;
        bottom: 14px;
        left: 0;
        width: 4.5px;
        background: #ef4444;
        border-radius: 0 4px 4px 0;
    }

    .kpi-label {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #dc2626;
        margin-bottom: 6px;
    }

    .kpi-number-danger {
        font-family: 'Outfit', sans-serif;
        font-size: 2.3rem;
        font-weight: 800;
        color: #dc2626;
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .kpi-icon-circle-danger {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: #fee2e2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: transform 0.25s ease;
    }

    .kpi-card-white:hover .kpi-icon-circle-danger {
        transform: scale(1.08) rotate(3deg);
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

    /* Badges de Categoría */
    .badge-category-expense {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        font-size: 0.76rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 5px 12px;
    }

    /* Monto de Egreso */
    .expense-amount {
        font-family: 'Outfit', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: #dc2626;
        letter-spacing: -0.3px;
    }

    /* Botones de Acción de Fila */
    .btn-table-action-danger {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 0.82rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-table-action-danger:hover {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fca5a5;
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
        background: #fee2e2;
        color: #dc2626;
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

    .input-group-text-custom {
        border: 1.5px solid #e2e8f0;
        border-right: none;
        background: #f8fafc;
        color: #64748b;
        font-weight: 700;
        border-radius: 12px 0 0 12px;
        padding: 10px 14px;
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
            <h1>Control de Gastos y Egresos</h1>
            <p>Trazabilidad de compras, servicios del local, sueldos y salidas de dinero</p>
        </div>
        
        <div>
            <button type="button" class="btn-action-orange" data-bs-toggle="modal" data-bs-target="#modalGasto">
                <i class="fa-solid fa-plus"></i>
                <span>Registrar Gasto</span>
            </button>
        </div>
    </div>

    <!-- Mensajes de Alerta -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-4 border-0 rounded-3 shadow-sm" style="background: #ecfdf5; color: #047857; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check me-2 fs-6"></i>
            <div>
                <?php 
                    if($_GET['msg'] == 'guardado') echo "Gasto registrado correctamente en el sistema.";
                    elseif($_GET['msg'] == 'eliminado') echo "Registro de gasto eliminado con éxito.";
                    else echo "Operación realizada correctamente.";
                ?>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tarjeta Métrica KPI Flotante -->
    <?php 
        $total = 0;
        foreach($gastos as $g) $total += $g->monto;
    ?>
    <div class="kpi-card-white">
        <div>
            <div class="kpi-label">Total Gastos (Histórico)</div>
            <div class="kpi-number-danger"><?php echo $sistema->simbolo_moneda . ' ' . number_format($total, 2); ?></div>
        </div>
        <div class="kpi-icon-circle-danger">
            <i class="fa-solid fa-money-bill-transfer"></i>
        </div>
    </div>

    <!-- Contenedor Tarjeta de Tabla Blanco -->
    <div class="card-table-white">
        <div class="table-responsive">
            <table class="table table-custom align-middle" id="datatable">
                <thead>
                    <tr>
                        <th>Fecha y Hora</th>
                        <th>Descripción del Gasto</th>
                        <th>Categoría</th>
                        <th>Registrado Por</th>
                        <th class="text-end">Monto</th>
                        <th class="text-end">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($gastos)): ?>
                        <?php foreach($gastos as $g): ?>
                            <tr>
                                <td data-sort="<?php echo strtotime($g->fecha); ?>" class="text-muted">
                                    <i class="fa-regular fa-clock me-1 opacity-75"></i>
                                    <?php echo date('d/m/Y H:i', strtotime($g->fecha)); ?>
                                </td>
                                <td>
                                    <strong class="text-dark"><?php echo htmlspecialchars($g->descripcion); ?></strong>
                                </td>
                                <td>
                                    <span class="badge-category-expense"><?php echo htmlspecialchars($g->categoria); ?></span>
                                </td>
                                <td>
                                    <span class="small text-muted">
                                        <i class="fa-regular fa-user me-1 opacity-75"></i>
                                        <?php echo htmlspecialchars($g->usuario_nombre ?? 'Sistema'); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="expense-amount">
                                        - <?php echo $sistema->simbolo_moneda . ' ' . number_format($g->monto, 2); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <form action="/gastos/eliminar" method="POST" onsubmit="return confirm('¿Confirmar la eliminación de este registro de gasto?');" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $g->id; ?>">
                                        <button type="submit" class="btn-table-action-danger" title="Eliminar Registro">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Registrar Gasto Ultra-Premium -->
<div class="modal fade" id="modalGasto" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <h5>Registrar Nuevo Egreso</h5>
                        <small class="text-muted">Ingresa el concepto y monto de la salida de dinero</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="/gastos/guardar" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label-custom">Descripción del Gasto *</label>
                        <input type="text" class="form-control form-control-custom" name="descripcion" placeholder="Ej: Pago de Luz, Repuestos urgente, Alquiler local..." required>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Monto *</label>
                            <div class="input-group">
                                <span class="input-group-text-custom"><?php echo $sistema->simbolo_moneda; ?></span>
                                <input type="number" step="0.01" class="form-control form-control-custom" name="monto" placeholder="0.00" style="border-radius: 0 12px 12px 0;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Categoría</label>
                            <select class="form-select form-select-custom" name="categoria">
                                <option value="General">General</option>
                                <option value="Servicios">Servicios (Luz/Agua/Internet)</option>
                                <option value="Alquiler">Alquiler</option>
                                <option value="Repuestos">Compra Repuestos</option>
                                <option value="Personal">Personal / Sueldos</option>
                                <option value="Publicidad">Publicidad / Marketing</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-action-orange">
                        <i class="fa-solid fa-check"></i>
                        <span>Registrar Salida</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
