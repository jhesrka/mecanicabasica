<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Inventario de Productos en Blanco */
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

    /* Thumbnail de Producto */
    .product-thumb {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }

    .product-thumb-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        border: 1px solid #e2e8f0;
    }

    /* Badges de Categoría y Stock */
    .badge-category {
        background: #eff6ff;
        color: #1e40af;
        border: 1px solid #dbeafe;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 4px 10px;
        text-transform: capitalize;
    }

    .badge-stock-pill {
        font-family: 'Outfit', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-stock-pill.stock-ok { color: #059669; }
    .badge-stock-pill.stock-low { color: #dc2626; }

    .badge-pill-alert {
        padding: 4px 8px;
        font-size: 0.68rem;
        font-weight: 700;
        border-radius: 6px;
        background: #fee2e2;
        color: #b91c1c;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

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

    .preview-box {
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        padding: 12px;
        background: #f8fafc;
        text-align: center;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-box img {
        max-height: 120px;
        border-radius: 8px;
        object-fit: contain;
    }
</style>

<div class="module-container">
    <!-- Header Superior -->
    <div class="module-header">
        <div class="module-title-box">
            <h1>Inventario de Productos</h1>
            <p>Control de existencias, repuestos, precios y movimientos de Kardex</p>
        </div>
        
        <div>
            <button type="button" class="btn-action-orange" onclick="abrirModalCrear()">
                <i class="fa-solid fa-plus"></i>
                <span>Nuevo Producto</span>
            </button>
        </div>
    </div>

    <!-- Mensajes de Alerta -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-4 border-0 rounded-3 shadow-sm" style="background: #ecfdf5; color: #047857; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check me-2 fs-6"></i>
            <div>
                <?php 
                    if($_GET['msg'] == 'guardado') echo "Producto guardado correctamente.";
                    elseif($_GET['msg'] == 'actualizado') echo "Producto actualizado.";
                    elseif($_GET['msg'] == 'ajuste_ok') echo "Stock ajustado y movimiento registrado en Kardex.";
                    elseif($_GET['msg'] == 'error_stock') echo "Error: Stock insuficiente para realizar la salida.";
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
                        <th>Imagen</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Precio Venta</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($productos)): ?>
                        <?php foreach($productos as $prod): ?>
                            <tr class="<?php echo ($prod->estado == 0) ? 'opacity-75' : ''; ?>">
                                <td>
                                    <?php if($prod->imagen): ?>
                                        <img src="/uploads/productos/<?php echo $prod->imagen; ?>" class="product-thumb">
                                    <?php else: ?>
                                        <div class="product-thumb-placeholder">
                                            <i class="fa-regular fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong class="text-dark font-monospace"><?php echo htmlspecialchars($prod->codigo); ?></strong>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($prod->nombre); ?></div>
                                    <?php if($prod->stock <= 5): ?>
                                        <span class="badge-pill-alert"><i class="fa-solid fa-triangle-exclamation me-1"></i> Stock Crítico</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge-category"><?php echo ucfirst($prod->categoria); ?></span>
                                </td>
                                <td>
                                    <span class="badge-stock-pill <?php echo $prod->stock > 5 ? 'stock-ok' : 'stock-low'; ?>">
                                        <?php echo $prod->stock; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark font-monospace">
                                        <?php echo $sistema->simbolo_moneda . ' ' . number_format($prod->precio_venta, 2); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn-table-action text-primary" onclick='editarProducto(<?php echo json_encode($prod); ?>)' title="Editar Producto">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        
                                        <?php if($prod->estado == 1): ?>
                                        <button type="button" class="btn-table-action text-warning" onclick='ajustarStock(<?php echo json_encode($prod); ?>)' title="Ajustar Stock (Kardex)">
                                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                        </button>
                                        <?php endif; ?>

                                        <a href="/productos/historial?id=<?php echo $prod->id; ?>" class="btn-table-action text-secondary" title="Ver Historial Kardex">
                                            <i class="fa-solid fa-list-ul"></i>
                                        </a>
                                        
                                        <?php if($prod->estado == 1): ?>
                                            <button type="button" class="btn-table-action text-danger" onclick="cambiarEstado(<?php echo $prod->id; ?>, 0)" title="Desactivar">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn-table-action text-success" onclick="cambiarEstado(<?php echo $prod->id; ?>, 1)" title="Activar">
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

<!-- Modal Producto Ultra-Premium -->
<div class="modal fade" id="modalProducto" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <div>
                        <h5 id="tituloModal">Nuevo Producto</h5>
                        <small class="text-muted">Ingresa las especificaciones, precios e imagen</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form id="formProducto" action="/productos/guardar" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="prodId">
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label-custom">Código *</label>
                                    <input type="text" class="form-control form-control-custom" name="codigo" id="codigo" placeholder="Ej: REP-001" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label-custom">Nombre del Producto *</label>
                                    <input type="text" class="form-control form-control-custom" name="nombre" id="nombre" placeholder="Ej: Filtro de Aceite Sintético" required>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Categoría Automotriz</label>
                                    <select class="form-select form-select-custom" name="categoria" id="categoria">
                                        <option value="repuesto">Repuestos de Motor</option>
                                        <option value="frenos">Frenos y Suspensión</option>
                                        <option value="fluidos">Lubricantes y Fluidos</option>
                                        <option value="filtros">Filtros (Aceite, Aire, Combustible)</option>
                                        <option value="electrico">Sistema Eléctrico y Baterías</option>
                                        <option value="accesorio">Accesorios y Carrocería</option>
                                        <option value="servicio">Mano de Obra / Servicios</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Stock Inicial</label>
                                    <input type="number" class="form-control form-control-custom" name="stock" id="stock" value="0" readonly>
                                    <small class="text-muted" style="font-size: 0.72rem;">Solo editable al crear nuevo registro.</small>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Precio Compra</label>
                                    <input type="number" step="0.01" class="form-control form-control-custom" name="precio_compra" id="precio_compra" placeholder="0.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Precio Venta *</label>
                                    <input type="number" step="0.01" class="form-control form-control-custom" name="precio_venta" id="precio_venta" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-label-custom">Fotografía / Imagen</label>
                            <div class="preview-box mb-2">
                                <img id="previewImg" src="https://via.placeholder.com/150?text=Sin+Imagen" class="img-fluid">
                            </div>
                            <input type="file" class="form-control form-control-sm form-control-custom" name="imagen" accept="image/*" onchange="previewFile()">
                        </div>
                    </div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-action-orange">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Guardar Producto</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ajuste de Stock (Kardex) Ultra-Premium -->
<div class="modal fade" id="modalAjuste" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header-custom">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge" style="background: #fef3c7; color: #d97706;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <h5>Ajustar Inventario</h5>
                        <small class="text-muted">Movimiento directo registrado en Kardex</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form action="/productos/ajustar" method="POST">
                <input type="hidden" name="id" id="ajusteId">
                <div class="modal-body">
                    <div class="p-3 mb-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <span class="text-muted small d-block mb-1">Producto Seleccionado:</span>
                        <h6 id="ajusteNombre" class="fw-bold text-dark mb-0"></h6>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Tipo de Movimiento</label>
                            <select class="form-select form-select-custom" name="tipo">
                                <option value="entrada">🟢 ENTRADA (Compras / Ingreso)</option>
                                <option value="salida">🔴 SALIDA (Merma / Uso)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Cantidad</label>
                            <input type="number" class="form-control form-control-custom" name="cantidad" required min="1" placeholder="Ej: 5">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label-custom">Motivo / Detalle *</label>
                        <textarea class="form-control form-control-custom" name="motivo" rows="2" required placeholder="Ej: Compra Factura F001 / Repuesto dañado en taller"></textarea>
                    </div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-action-orange">
                        <i class="fa-solid fa-check"></i>
                        <span>Registrar Movimiento</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="formEstado" action="/productos/cambiar-estado" method="POST">
    <input type="hidden" name="id" id="idEstado">
    <input type="hidden" name="nuevo_estado" id="nuevoEstado">
</form>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script>
    const modal = new bootstrap.Modal(document.getElementById('modalProducto'));
    const modalAjuste = new bootstrap.Modal(document.getElementById('modalAjuste'));

    function abrirModalCrear() {
        document.getElementById('formProducto').reset();
        document.getElementById('prodId').value = '';
        document.getElementById('stock').readOnly = false;
        document.getElementById('tituloModal').innerText = 'Nuevo Producto';
        document.getElementById('formProducto').action = '/productos/guardar';
        document.getElementById('previewImg').src = 'https://via.placeholder.com/150?text=Sin+Imagen';
        modal.show();
    }

    function editarProducto(prod) {
        document.getElementById('prodId').value = prod.id;
        document.getElementById('codigo').value = prod.codigo;
        document.getElementById('nombre').value = prod.nombre;
        document.getElementById('categoria').value = prod.categoria;
        document.getElementById('stock').value = prod.stock;
        document.getElementById('stock').readOnly = true;
        document.getElementById('precio_compra').value = prod.precio_compra;
        document.getElementById('precio_venta').value = prod.precio_venta;
        
        if(prod.imagen) document.getElementById('previewImg').src = '/uploads/productos/' + prod.imagen;
        else document.getElementById('previewImg').src = 'https://via.placeholder.com/150?text=Sin+Imagen';

        document.getElementById('tituloModal').innerText = 'Editar Producto';
        document.getElementById('formProducto').action = '/productos/actualizar';
        modal.show();
    }

    function ajustarStock(prod) {
        document.getElementById('ajusteId').value = prod.id;
        document.getElementById('ajusteNombre').innerText = prod.codigo + ' — ' + prod.nombre + ' (Stock Actual: ' + prod.stock + ')';
        modalAjuste.show();
    }

    function cambiarEstado(id, estado) {
        if(confirm('¿Confirmar cambio de estado?')) {
            document.getElementById('idEstado').value = id;
            document.getElementById('nuevoEstado').value = estado;
            document.getElementById('formEstado').submit();
        }
    }

    function previewFile() {
        const preview = document.getElementById('previewImg');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        reader.onloadend = function () { preview.src = reader.result; }
        if (file) reader.readAsDataURL(file);
    }
</script>
