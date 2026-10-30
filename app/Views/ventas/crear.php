<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Punto de Venta (POS) en Blanco */
    .pos-container {
        padding: 6px 4px;
    }

    /* Cabecera Superior */
    .pos-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 26px;
    }

    .pos-title-box h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.85rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 3px;
        letter-spacing: -0.5px;
    }

    .pos-title-box p {
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

    /* Tarjetas Blancas Flotantes */
    .pos-card-white {
        background: #ffffff;
        border-radius: 20px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.02);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .pos-card-body {
        padding: 24px;
    }

    .pos-card-header-clean {
        padding: 18px 24px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pos-card-header-clean h2 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pos-card-header-clean h2 i {
        color: #ff5500;
    }

    /* Input y Selector de Búsqueda */
    .form-label-pos {
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #475569;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-add-product {
        background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(255, 85, 0, 0.35);
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-add-product:hover {
        background: linear-gradient(135deg, #ff4500 0%, #ff6600 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(255, 85, 0, 0.45);
    }

    /* Tabla del Carrito */
    .table-cart {
        margin-bottom: 0 !important;
    }

    .table-cart thead th {
        background: #f8fafc !important;
        color: #64748b !important;
        font-size: 0.74rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        padding: 14px 20px !important;
        border-bottom: 1.5px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .table-cart tbody td {
        padding: 14px 20px !important;
        vertical-align: middle !important;
        color: #334155 !important;
        font-size: 0.92rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .table-cart tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Tarjeta Total a Pagar Naranja Deportivo / Cobalto */
    .card-total-box {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 20px;
        padding: 28px 24px;
        color: #ffffff;
        text-align: center;
        box-shadow: 0 10px 25px rgba(3, 105, 161, 0.25);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .card-total-box::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -30%;
        width: 140px;
        height: 140px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
    }

    .total-title-tag {
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 4px;
    }

    .total-number-display {
        font-family: 'Outfit', sans-serif;
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -1px;
    }

    /* Botón Confirmar Venta */
    .btn-confirm-sale {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 1.05rem;
        padding: 15px;
        border-radius: 14px;
        width: 100%;
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.35);
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-confirm-sale:hover {
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.45);
    }

    /* Empty State del Carrito */
    .empty-cart-box {
        padding: 50px 20px;
        text-align: center;
    }

    .empty-cart-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #f8fafc;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 14px;
        border: 1px solid #e2e8f0;
    }

    .empty-cart-text {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Input Cantidad en Carrito */
    .input-cant-custom {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 4px 8px;
        font-weight: 600;
        text-align: center;
        max-width: 75px;
        outline: none;
    }

    .input-cant-custom:focus {
        border-color: #ff6a00;
    }
</style>

<div class="pos-container">
    <!-- Header Superior -->
    <div class="pos-header">
        <div class="pos-title-box">
            <h1>Punto de Venta (POS)</h1>
            <p>Facturación rápida de repuestos, servicios y emisión de tickets</p>
        </div>
        
        <div>
            <a href="/ventas" class="btn-action-outline">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Historial de Ventas</span>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Lado Izquierdo: Buscador y Carrito de Compras -->
        <div class="col-lg-8">
            <!-- Tarjeta Buscador -->
            <div class="pos-card-white">
                <div class="pos-card-body">
                    <label class="form-label-pos">
                        <i class="fa-solid fa-barcode text-primary"></i>
                        <span>Buscar Producto (Escáner o Nombre)</span>
                    </label>
                    <div class="d-flex gap-2">
                        <select id="selectProducto" class="form-select select2">
                            <option value="">Escriba código o nombre del producto...</option>
                            <?php foreach($productos as $p): ?>
                                <?php if($p->stock > 0 && $p->estado == 1): ?>
                                    <option value="<?php echo $p->id; ?>" 
                                            data-nombre="<?php echo htmlspecialchars($p->nombre); ?>" 
                                            data-precio="<?php echo $p->precio_venta; ?>"
                                            data-stock="<?php echo $p->stock; ?>">
                                        <?php echo htmlspecialchars($p->codigo . ' - ' . $p->nombre); ?> (<?php echo $sistema->simbolo_moneda . ' ' . $p->precio_venta; ?>) | Stock: <?php echo $p->stock; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn-add-product" onclick="agregarProducto()" title="Agregar al Carrito">
                            <i class="fa-solid fa-plus fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Tabla Carrito de Compras -->
            <div class="pos-card-white">
                <div class="pos-card-header-clean">
                    <h2>
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Carrito de Compras</span>
                    </h2>
                    <span class="badge bg-light text-secondary border px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                        Items en orden
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-cart align-middle">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center" width="130">Precio Unit.</th>
                                <th class="text-center" width="110">Cant.</th>
                                <th class="text-end" width="130">Subtotal</th>
                                <th width="60" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="tablaProductos">
                            <tr id="filaVacia">
                                <td colspan="5">
                                    <div class="empty-cart-box">
                                        <div class="empty-cart-icon">
                                            <i class="fa-solid fa-basket-shopping"></i>
                                        </div>
                                        <div class="empty-cart-text">El carrito de compras está vacío. Agrega productos arriba.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Lado Derecho: Total a Pagar y Confirmación -->
        <div class="col-lg-4">
            <!-- Display de Total a Pagar -->
            <div class="card-total-box">
                <div class="total-title-tag">Total a Pagar</div>
                <div class="total-number-display" id="displayTotal"><?php echo $sistema->simbolo_moneda; ?> 0.00</div>
            </div>

            <!-- Tarjeta Cliente y Acción -->
            <div class="pos-card-white">
                <div class="pos-card-body">
                    <form action="/ventas/guardar" method="POST" id="formVenta">
                        <input type="hidden" name="productos_json" id="inputProductos">
                        <input type="hidden" name="total_venta" id="inputTotal">

                        <div class="mb-4">
                            <label class="form-label-pos">
                                <i class="fa-solid fa-user text-primary"></i>
                                <span>Cliente</span>
                            </label>
                            <select class="form-select select2" name="cliente_id" required>
                                <option value="">Seleccionar Cliente...</option>
                                <?php foreach($clientes as $c): ?>
                                    <?php if($c->estado == 1): ?>
                                        <option value="<?php echo $c->id; ?>"><?php echo htmlspecialchars($c->nombre); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="mt-2 text-end">
                                <a href="/clientes" target="_blank" class="text-decoration-none small text-primary fw-semibold">
                                    <i class="fa-solid fa-user-plus me-1"></i> Registrar nuevo cliente
                                </a>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="button" class="btn-confirm-sale" onclick="procesarVenta()">
                                <i class="fa-solid fa-circle-check fs-5"></i>
                                <span>Confirmar Venta</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script>
    let carrito = [];
    const simboloMoneda = '<?php echo $sistema->simbolo_moneda; ?>';

    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    });

    function agregarProducto() {
        const select = $('#selectProducto');
        const id = select.val();
        
        if(!id) return;

        const option = select.find(':selected');
        const nombre = option.data('nombre');
        const precio = parseFloat(option.data('precio'));
        const stockMax = parseInt(option.data('stock'));

        const existe = carrito.find(item => item.id == id);

        if(existe) {
            if(existe.cantidad < stockMax) {
                existe.cantidad++;
            } else {
                alert('Stock máximo disponible alcanzado (' + stockMax + ')');
            }
        } else {
            carrito.push({
                id: id,
                nombre: nombre,
                precio: precio,
                cantidad: 1,
                stockMax: stockMax
            });
        }

        renderTabla();
        select.val('').trigger('change');
    }

    function renderTabla() {
        const tbody = $('#tablaProductos');
        tbody.empty();

        if(carrito.length === 0) {
            tbody.html(`
                <tr id="filaVacia">
                    <td colspan="5">
                        <div class="empty-cart-box">
                            <div class="empty-cart-icon">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </div>
                            <div class="empty-cart-text">El carrito de compras está vacío. Agrega productos arriba.</div>
                        </div>
                    </td>
                </tr>
            `);
            actualizarTotal(0);
            return;
        }

        let totalGeneral = 0;

        carrito.forEach((item, index) => {
            const subtotal = item.precio * item.cantidad;
            totalGeneral += subtotal;

            tbody.append(`
                <tr>
                    <td>
                        <strong class="text-dark">${item.nombre}</strong>
                        <div class="small text-muted">Stock disp: ${item.stockMax}</div>
                    </td>
                    <td class="text-center font-monospace">${simboloMoneda} ${item.precio.toFixed(2)}</td>
                    <td class="text-center">
                        <input type="number" class="input-cant-custom" 
                               value="${item.cantidad}" min="1" max="${item.stockMax}" 
                               onchange="cambiarCantidad(${index}, this.value)">
                    </td>
                    <td class="text-end fw-bold font-monospace text-dark">${simboloMoneda} ${subtotal.toFixed(2)}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-light border text-danger rounded-pill px-2" onclick="eliminarItem(${index})" title="Quitar">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });

        actualizarTotal(totalGeneral);
    }

    function cambiarCantidad(index, nuevaCant) {
        nuevaCant = parseInt(nuevaCant);
        if(isNaN(nuevaCant) || nuevaCant < 1) nuevaCant = 1;

        if(nuevaCant > carrito[index].stockMax) {
            alert('Solo hay ' + carrito[index].stockMax + ' unidades en stock.');
            nuevaCant = carrito[index].stockMax;
        }

        carrito[index].cantidad = nuevaCant;
        renderTabla();
    }

    function eliminarItem(index) {
        carrito.splice(index, 1);
        renderTabla();
    }

    function actualizarTotal(total) {
        $('#displayTotal').text(simboloMoneda + ' ' + total.toFixed(2));
        $('#inputTotal').val(total.toFixed(2));
    }

    function procesarVenta() {
        if(carrito.length === 0) {
            alert('El carrito está vacío. Agrega al menos un producto.');
            return;
        }

        const clienteId = $('select[name="cliente_id"]').val();
        if(!clienteId) {
            alert('Por favor selecciona un cliente antes de procesar.');
            return;
        }

        $('#inputProductos').val(JSON.stringify(carrito));
        $('#formVenta').submit();
    }
</script>
