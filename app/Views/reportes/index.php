<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Reportes Gerenciales en Blanco */
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
        margin-bottom: 24px;
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

    .btn-action-outline {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        font-size: 0.86rem;
        padding: 9px 18px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .btn-action-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    /* Barra de Filtro de Fechas Flotante */
    .filter-card-white {
        background: #ffffff;
        border-radius: 18px;
        padding: 18px 24px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.04);
        margin-bottom: 26px;
    }

    .filter-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #475569;
        margin-bottom: 6px;
        display: block;
    }

    .form-control-date {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control-date:focus {
        border-color: #ff6a00;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.12);
    }

    .btn-filter-orange {
        background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 9px 20px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(255, 85, 0, 0.35);
        transition: all 0.2s ease;
        width: 100%;
        cursor: pointer;
    }

    .btn-filter-orange:hover {
        background: linear-gradient(135deg, #ff4500 0%, #ff6600 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 85, 0, 0.45);
    }

    /* Tarjetas KPI Financieras */
    .kpi-card-white {
        background: #ffffff;
        border-radius: 20px;
        padding: 22px 24px;
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
        border-radius: 0 4px 4px 0;
    }

    .kpi-income::before { background: #10b981; }
    .kpi-expense::before { background: #ef4444; }

    .kpi-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .kpi-income .kpi-label { color: #059669; }
    .kpi-expense .kpi-label { color: #dc2626; }

    .kpi-number-income {
        font-family: 'Outfit', sans-serif;
        font-size: 2.1rem;
        font-weight: 800;
        color: #059669;
        line-height: 1;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .kpi-number-expense {
        font-family: 'Outfit', sans-serif;
        font-size: 2.1rem;
        font-weight: 800;
        color: #dc2626;
        line-height: 1;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .kpi-subtext {
        font-size: 0.78rem;
        color: #64748b;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Tarjeta Protagónica de Utilidad Neta */
    .card-utility-box {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 20px;
        padding: 24px 28px;
        color: #ffffff;
        text-align: center;
        box-shadow: 0 12px 30px rgba(3, 105, 161, 0.28);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .card-utility-box::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -30%;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
    }

    .utility-tag {
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 4px;
    }

    .utility-number {
        font-family: 'Outfit', sans-serif;
        font-size: 2.85rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -1px;
    }

    .utility-sub {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.75);
        font-weight: 500;
        margin-top: 4px;
    }

    /* Contenedores de Gráficos Blancos Flotantes */
    .card-chart-white {
        background: #ffffff;
        border-radius: 20px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.02);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-chart-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-chart-header h2 {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-chart-header h2 i {
        color: #ff5500;
        font-size: 1.1rem;
    }

    .card-chart-body {
        padding: 22px;
        flex-grow: 1;
    }
</style>

<div class="module-container">
    <!-- Header Superior -->
    <div class="module-header">
        <div class="module-title-box">
            <h1>Reportes Gerenciales</h1>
            <p>Métricas de rendimiento financiero, balance de utilidad y estadísticas de taller</p>
        </div>
        
        <div>
            <button type="button" class="btn-action-outline" onclick="window.print()">
                <i class="fa-solid fa-print"></i>
                <span>Imprimir Reporte</span>
            </button>
        </div>
    </div>

    <!-- Barra de Filtro de Fechas -->
    <div class="filter-card-white">
        <form action="/reportes" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="filter-label"><i class="fa-regular fa-calendar me-1 text-primary"></i> Desde:</label>
                <input type="date" class="form-control form-control-date w-100" name="desde" value="<?php echo $fechaInicio; ?>">
            </div>
            <div class="col-md-3">
                <label class="filter-label"><i class="fa-regular fa-calendar-check me-1 text-primary"></i> Hasta:</label>
                <input type="date" class="form-control form-control-date w-100" name="hasta" value="<?php echo $fechaFin; ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-filter-orange">
                    <i class="fa-solid fa-filter"></i>
                    <span>Filtrar</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Tarjetas de Balance Financiero -->
    <div class="row g-4 mb-4">
        <!-- Ingresos Totales -->
        <div class="col-md-3">
            <div class="kpi-card-white kpi-income">
                <div>
                    <div class="kpi-label">Total Ingresos</div>
                    <div class="kpi-number-income">
                        <?php echo $sistema->simbolo_moneda . ' ' . number_format($balance['ingresos_totales'], 2); ?>
                    </div>
                </div>
                <div class="kpi-subtext">
                    <i class="fa-solid fa-arrow-trend-up text-success"></i>
                    <span>Ventas + Servicios</span>
                </div>
            </div>
        </div>

        <!-- Gastos Totales -->
        <div class="col-md-3">
            <div class="kpi-card-white kpi-expense">
                <div>
                    <div class="kpi-label">Total Gastos</div>
                    <div class="kpi-number-expense">
                        <?php echo $sistema->simbolo_moneda . ' ' . number_format($balance['gastos'], 2); ?>
                    </div>
                </div>
                <div class="kpi-subtext">
                    <i class="fa-solid fa-arrow-trend-down text-danger"></i>
                    <span>Gastos Operativos</span>
                </div>
            </div>
        </div>

        <!-- Utilidad Neta (Ganancia Real) -->
        <div class="col-md-6">
            <div class="card-utility-box">
                <div class="utility-tag">Utilidad Neta (Ganancia Real)</div>
                <div class="utility-number">
                    <?php echo $sistema->simbolo_moneda . ' ' . number_format($balance['utilidad'], 2); ?>
                </div>
                <div class="utility-sub">Balance neto: Ingresos cobrados menos gastos registrados</div>
            </div>
        </div>
    </div>

    <!-- Gráficos de Estadísticas -->
    <div class="row g-4 mb-4">
        <!-- Estado de Órdenes -->
        <div class="col-lg-4">
            <div class="card-chart-white">
                <div class="card-chart-header">
                    <h2>
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Estado de Órdenes (Global)</span>
                    </h2>
                </div>
                <div class="card-chart-body">
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="chartEstados"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 5 Productos Más Vendidos -->
        <div class="col-lg-8">
            <div class="card-chart-white">
                <div class="card-chart-header">
                    <h2>
                        <i class="fa-solid fa-trophy text-warning"></i>
                        <span>Top 5 Productos Más Vendidos</span>
                    </h2>
                    <span class="badge bg-light text-secondary border px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                        Ranking de salida
                    </span>
                </div>
                <div class="card-chart-body">
                    <div style="position: relative; height: 260px; width: 100%;">
                        <canvas id="chartProductos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Tendencia Financiera (6 Meses) -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card-chart-white">
                <div class="card-chart-header">
                    <h2>
                        <i class="fa-solid fa-chart-line text-primary"></i>
                        <span>Tendencia Financiera (Últimos 6 Meses)</span>
                    </h2>
                    <span class="badge bg-light text-secondary border px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                        Ingresos vs Gastos
                    </span>
                </div>
                <div class="card-chart-body">
                    <div style="position: relative; height: 320px; width: 100%;">
                        <canvas id="chartHistorial"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const commonOptions = { responsive: true, maintainAspectRatio: false };

    // 1. Gráfico de Estados de Órdenes
    const dEstado = <?php echo $chartEstados; ?>;
    new Chart(document.getElementById('chartEstados'), {
        type: 'doughnut',
        data: {
            labels: dEstado.labels,
            datasets: [{ data: dEstado.data, backgroundColor: dEstado.colors, borderWidth: 2, borderColor: '#ffffff' }]
        },
        options: { 
            ...commonOptions, 
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: { boxWidth: 12, padding: 14, font: { family: 'Plus Jakarta Sans', size: 12 } }
                } 
            } 
        }
    });

    // 2. Gráfico de Productos Más Vendidos
    const dProd = <?php echo $chartProductos; ?>;
    new Chart(document.getElementById('chartProductos'), {
        type: 'bar',
        data: {
            labels: dProd.labels,
            datasets: [{ 
                label: 'Und. Vendidas', 
                data: dProd.data, 
                backgroundColor: '#ff5500', 
                borderRadius: 8,
                hoverBackgroundColor: '#ff7700'
            }]
        },
        options: { 
            ...commonOptions, 
            scales: { 
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // 3. Gráfico de Tendencia Histórica (Ingresos vs Gastos)
    const dHist = <?php echo $chartHistorial; ?>;
    new Chart(document.getElementById('chartHistorial'), {
        type: 'line',
        data: {
            labels: dHist.labels,
            datasets: [
                {
                    label: 'Ingresos',
                    data: dHist.ingreso,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.08)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 4,
                    pointBackgroundColor: '#10b981'
                },
                {
                    label: 'Gastos',
                    data: dHist.gasto,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.08)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 4,
                    pointBackgroundColor: '#ef4444'
                }
            ]
        },
        options: { 
            ...commonOptions, 
            scales: { 
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { color: '#f8fafc' } }
            },
            plugins: {
                legend: { 
                    position: 'top',
                    labels: { boxWidth: 14, font: { family: 'Plus Jakarta Sans', size: 12, weight: 600 } }
                }
            }
        }
    });
</script>
