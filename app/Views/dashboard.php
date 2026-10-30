<?php require_once __DIR__ . '/partials/header.php'; ?>

<style>
    /* Estilos Premium para la Vista Dashboard en Blanco */
    .dashboard-container {
        padding: 6px 4px;
    }

    /* Cabecera Superior */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
    }

    .dashboard-title-box h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.85rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 3px;
        letter-spacing: -0.5px;
    }

    .dashboard-title-box p {
        font-size: 0.88rem;
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    /* Botones de Cabecera */
    .btn-action-outline {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        font-size: 0.86rem;
        padding: 9px 16px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .btn-action-orange {
        background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.88rem;
        padding: 9px 18px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(255, 85, 0, 0.35);
        transition: all 0.2s ease;
    }

    .btn-action-orange:hover {
        background: linear-gradient(135deg, #ff4500 0%, #ff6600 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 85, 0, 0.45);
    }

    /* Dropdown Menú de Nuevo */
    .dropdown-menu-custom {
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        padding: 8px;
        min-width: 180px;
    }

    .dropdown-menu-custom .dropdown-item {
        border-radius: 8px;
        padding: 9px 14px;
        font-size: 0.88rem;
        font-weight: 500;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
    }

    .dropdown-menu-custom .dropdown-item:hover {
        background: #fff7ed;
        color: #ea580c;
    }

    /* Tarjetas KPI Premium Flotantes */
    .kpi-card-white {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px 26px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.02);
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .kpi-card-white:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px -4px rgba(15, 23, 42, 0.08), 0 8px 18px rgba(15, 23, 42, 0.04);
        border-color: #e2e8f0;
    }

    /* Acento de barra lateral fina */
    .kpi-card-white::before {
        content: '';
        position: absolute;
        top: 14px;
        bottom: 14px;
        left: 0;
        width: 4.5px;
        border-radius: 0 4px 4px 0;
    }

    .kpi-warning::before { background: #f59e0b; }
    .kpi-success::before { background: #10b981; }
    .kpi-primary::before { background: #2563eb; }

    .kpi-top-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .kpi-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .kpi-warning .kpi-label { color: #d97706; }
    .kpi-success .kpi-label { color: #059669; }
    .kpi-primary .kpi-label { color: #2563eb; }

    .kpi-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        transition: transform 0.25s ease;
    }

    .kpi-card-white:hover .kpi-icon-circle {
        transform: scale(1.08) rotate(3deg);
    }

    .kpi-warning .kpi-icon-circle {
        background: #fef3c7;
        color: #d97706;
    }

    .kpi-success .kpi-icon-circle {
        background: #d1fae5;
        color: #059669;
    }

    .kpi-primary .kpi-icon-circle {
        background: #dbeafe;
        color: #2563eb;
    }

    .kpi-number {
        font-family: 'Outfit', sans-serif;
        font-size: 2.15rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        letter-spacing: -0.5px;
    }

    /* Tabla de Órdenes Recientes */
    .card-table-white {
        background: #ffffff;
        border-radius: 20px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04);
        overflow: hidden;
        margin-top: 10px;
    }

    .card-table-header {
        padding: 20px 26px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-table-header h2 {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-table-header h2 i {
        color: #2563eb;
        font-size: 1.1rem;
    }

    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 14px 26px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }

    .table-custom tbody td {
        padding: 16px 26px;
        vertical-align: middle;
        color: #334155;
        font-size: 0.92rem;
        border-bottom: 1px solid #f1f5f9;
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

    .state-pendiente {
        background: #fef3c7;
        color: #b45309;
    }
    .state-pendiente::before { background: #f59e0b; }

    .state-reparado {
        background: #e0f2fe;
        color: #0369a1;
    }
    .state-reparado::before { background: #0284c7; }

    .state-entregado {
        background: #dcfce7;
        color: #15803d;
    }
    .state-entregado::before { background: #22c55e; }

    /* Empty State Limpio */
    .empty-state-box {
        padding: 45px 20px;
        text-align: center;
    }

    .empty-state-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 14px;
    }

    .empty-state-text {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .table-card-footer {
        padding: 14px 26px;
        background: #ffffff;
        border-top: 1px solid #f1f5f9;
        text-align: center;
    }

    .table-card-footer a {
        color: #2563eb;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .table-card-footer a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
</style>

<div class="dashboard-container">
    <!-- Header Superior -->
    <div class="dashboard-header">
        <div class="dashboard-title-box">
            <h1>Panel de Control</h1>
            <p>Resumen general y métricas en tiempo real de tu taller</p>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <a href="/ordenes" class="btn-action-outline">
                <i class="fa-regular fa-clipboard"></i>
                <span>Ver Órdenes</span>
            </a>
            <a href="/ventas" class="btn-action-outline">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Ver Ventas</span>
            </a>
            
            <div class="dropdown">
                <button type="button" class="btn-action-orange dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-plus"></i>
                    <span>Nuevo</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="/ordenes">
                            <i class="fa-regular fa-clipboard text-primary"></i>
                            <span>Nueva Orden</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/ventas/crear">
                            <i class="fa-solid fa-cart-plus text-success"></i>
                            <span>Nueva Venta</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/clientes">
                            <i class="fa-regular fa-user text-warning"></i>
                            <span>Nuevo Cliente</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Las 3 Tarjetas KPI Flotantes -->
    <div class="row g-4 mb-4">
        <!-- Tarjeta 1: Pendientes -->
        <div class="col-md-4">
            <div class="kpi-card-white kpi-warning">
                <div class="kpi-top-row">
                    <div>
                        <div class="kpi-label">Vehículos en Taller (Pendientes)</div>
                    </div>
                    <div class="kpi-icon-circle">
                        <i class="fa-solid fa-car"></i>
                    </div>
                </div>
                <div class="kpi-number"><?php echo $pendientes; ?></div>
            </div>
        </div>

        <!-- Tarjeta 2: Listos para Entregar -->
        <div class="col-md-4">
            <div class="kpi-card-white kpi-success">
                <div class="kpi-top-row">
                    <div>
                        <div class="kpi-label">Listos para Entregar</div>
                    </div>
                    <div class="kpi-icon-circle">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="kpi-number"><?php echo $listos; ?></div>
            </div>
        </div>

        <!-- Tarjeta 3: Ingresos del Mes -->
        <div class="col-md-4">
            <div class="kpi-card-white kpi-primary">
                <div class="kpi-top-row">
                    <div>
                        <div class="kpi-label">Ingresos del Mes</div>
                    </div>
                    <div class="kpi-icon-circle">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="kpi-number">
                    <?php echo $sistema->simbolo_moneda . ' ' . number_format($ingresos, 2); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Últimas Órdenes Recibidas -->
    <div class="card-table-white">
        <div class="card-table-header">
            <h2>
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Últimas 5 Órdenes Recibidas</span>
            </h2>
            <span class="badge bg-light text-secondary border px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                Actividad reciente
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Cliente</th>
                        <th>Vehículo / Placa</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-end">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($recientes)): ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state-box">
                                    <div class="empty-state-icon">
                                        <i class="fa-solid fa-clipboard-check"></i>
                                    </div>
                                    <div class="empty-state-text">Todo al día. No hay actividad reciente en las órdenes.</div>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($recientes as $orden): ?>
                            <?php 
                                $classState = 'state-pendiente';
                                if($orden->estado == 'reparado') $classState = 'state-reparado';
                                if($orden->estado == 'entregado') $classState = 'state-entregado';
                            ?>
                            <tr>
                                <td>
                                    <strong class="text-dark font-monospace"><?php echo 'ORD-' . str_pad($orden->id, 4, '0', STR_PAD_LEFT); ?></strong>
                                </td>
                                <td class="fw-medium text-dark"><?php echo htmlspecialchars($orden->cliente); ?></td>
                                <td>
                                    <?php 
                                        $placaDash = !empty($orden->placa) ? $orden->placa : (!empty($orden->equipo_serie) ? $orden->equipo_serie : '');
                                    ?>
                                    <?php if(!empty($placaDash)): ?>
                                        <span class="badge bg-dark text-white font-monospace px-2 py-1 me-1" style="font-size: 0.76rem; letter-spacing: 1px;"><?php echo htmlspecialchars($placaDash); ?></span>
                                    <?php endif; ?>
                                    <span class="fw-medium text-dark"><?php echo htmlspecialchars($orden->equipo_marca . ' ' . $orden->equipo_modelo); ?></span>
                                </td>
                                <td class="text-muted"><?php echo date('d/m/Y', strtotime($orden->fecha_recepcion)); ?></td>
                                <td>
                                    <span class="badge-pill-state <?php echo $classState; ?>">
                                        <?php echo ucfirst($orden->estado); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/ordenes/detalle?id=<?php echo $orden->id; ?>" class="btn btn-sm btn-light border rounded-pill px-3 fw-semibold text-primary" title="Ver Detalles">
                                        <i class="fa-solid fa-eye me-1"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="table-card-footer">
            <a href="/ordenes">
                Ver todas las órdenes registradas <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
