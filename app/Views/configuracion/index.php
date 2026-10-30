<?php require_once __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Estilos Premium para Configuración de Empresa en Blanco */
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

    /* Tarjetas Blancas Flotantes */
    .config-card-white {
        background: #ffffff;
        border-radius: 20px;
        border: 1.5px solid #f1f5f9;
        box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.02);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .config-card-header {
        padding: 18px 26px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .config-card-header h2 {
        font-size: 1.02rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .config-card-header h2 i {
        color: #ff5500;
        font-size: 1.1rem;
    }

    .config-card-body {
        padding: 26px;
    }

    .form-label-config {
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        display: block;
    }

    .form-control-config, .form-select-config {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.92rem;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.2s ease;
        outline: none;
        width: 100%;
    }

    .form-control-config:focus, .form-select-config:focus {
        border-color: #ff6a00;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.12);
    }

    /* Caja de Previsualización del Logo */
    .logo-preview-box {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        background: #f8fafc;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        margin-bottom: 18px;
    }

    .logo-preview-box img {
        max-height: 160px;
        max-width: 100%;
        object-fit: contain;
    }

    /* Botón Guardar Naranja */
    .btn-action-orange {
        background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 13px 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(255, 85, 0, 0.35);
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
        width: 100%;
    }

    .btn-action-orange:hover {
        background: linear-gradient(135deg, #ff4500 0%, #ff6600 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 85, 0, 0.45);
    }

    /* Tarjeta Zona de Seguridad */
    .security-zone-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1.5px solid #fee2e2;
        box-shadow: 0 10px 30px -4px rgba(239, 68, 68, 0.06);
        overflow: hidden;
    }

    .security-zone-header {
        background: #fef2f2;
        padding: 16px 24px;
        border-bottom: 1px solid #fee2e2;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .security-zone-header h2 {
        font-size: 0.98rem;
        font-weight: 700;
        color: #b91c1c;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-backup-download {
        background: #ffffff;
        border: 1.5px solid #fca5a5;
        color: #b91c1c;
        font-weight: 700;
        font-size: 0.88rem;
        padding: 11px 18px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
    }

    .btn-backup-download:hover {
        background: #fee2e2;
        color: #991b1b;
        border-color: #f87171;
        transform: translateY(-1px);
    }
</style>

<div class="module-container">
    <!-- Header Superior -->
    <div class="module-header">
        <div class="module-title-box">
            <h1>Configuración de Empresa</h1>
            <p>Ajustes de marca, moneda fiscal, datos de contacto para comprobantes y respaldos</p>
        </div>
    </div>

    <!-- Mensajes de Alerta -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-4 border-0 rounded-3 shadow-sm" style="background: #ecfdf5; color: #047857; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check me-2 fs-6"></i>
            <div>
                <?php 
                    if($_GET['msg'] == 'actualizado') echo "Datos y ajustes de empresa actualizados correctamente.";
                    elseif($_GET['msg'] == 'error_backup') echo "Error al intentar generar la copia de seguridad.";
                    else echo "Operación realizada correctamente.";
                ?>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="/configuracion/guardar" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <!-- Columna Izquierda: Identidad, Contacto y Textos -->
            <div class="col-lg-8">
                <!-- 1. Identidad del Negocio -->
                <div class="config-card-white">
                    <div class="config-card-header">
                        <h2>
                            <i class="fa-solid fa-building"></i>
                            <span>Identidad del Negocio</span>
                        </h2>
                    </div>
                    <div class="config-card-body">
                        <div class="mb-3">
                            <label class="form-label-config">Nombre del Sistema / Empresa *</label>
                            <input type="text" class="form-control-config" name="nombre_sistema" value="<?php echo htmlspecialchars($datos->nombre_sistema); ?>" placeholder="Ej: Taller Pro" required>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label-config">Moneda (Código ISO)</label>
                                <input type="text" class="form-control-config" name="moneda" value="<?php echo htmlspecialchars(!empty($datos->moneda) ? $datos->moneda : 'USD'); ?>" placeholder="Ej: USD">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-config">Símbolo de Moneda</label>
                                <input type="text" class="form-control-config" name="simbolo_moneda" value="<?php echo htmlspecialchars(!empty($datos->simbolo_moneda) ? $datos->simbolo_moneda : '$'); ?>" placeholder="Ej: $">
                            </div>
                        </div>

                        <div>
                            <label class="form-label-config">Impuesto General (%)</label>
                            <input type="number" step="0.01" class="form-control-config" name="impuesto" value="<?php echo htmlspecialchars($datos->impuesto); ?>" placeholder="Ej: 18.00">
                        </div>
                    </div>
                </div>

                <!-- 2. Datos de Contacto (Para Documentos) -->
                <div class="config-card-white">
                    <div class="config-card-header">
                        <h2>
                            <i class="fa-solid fa-address-book"></i>
                            <span>Datos de Contacto (Para Imprimir en PDF)</span>
                        </h2>
                    </div>
                    <div class="config-card-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label-config">Teléfono / WhatsApp</label>
                                <input type="text" class="form-control-config" name="telefono" value="<?php echo htmlspecialchars($datos->telefono); ?>" placeholder="Ej: +593 99 123 4567">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-config">Correo Electrónico</label>
                                <input type="email" class="form-control-config" name="email" value="<?php echo htmlspecialchars($datos->email); ?>" placeholder="contacto@tallerpro.com">
                            </div>
                        </div>
                        <div>
                            <label class="form-label-config">Dirección Fiscal / Ubicación</label>
                            <textarea class="form-control-config" name="direccion" rows="2" placeholder="Ej: Av. Amazonas y República, Quito"><?php echo htmlspecialchars($datos->direccion); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- 3. Textos en Documentos -->
                <div class="config-card-white">
                    <div class="config-card-header">
                        <h2>
                            <i class="fa-solid fa-file-contract"></i>
                            <span>Textos en Documentos y Comprobantes</span>
                        </h2>
                    </div>
                    <div class="config-card-body">
                        <div class="mb-3">
                            <label class="form-label-config">Términos y Condiciones (Orden de Servicio)</label>
                            <textarea class="form-control-config" name="terminos_orden" rows="3" placeholder="Políticas de garantía, retiro de vehículos, inventario de taller, etc."><?php echo htmlspecialchars($datos->terminos_orden); ?></textarea>
                        </div>
                        <div>
                            <label class="form-label-config">Mensaje de Despedida (Ticket de Venta)</label>
                            <input type="text" class="form-control-config" name="mensaje_ticket" value="<?php echo htmlspecialchars($datos->mensaje_ticket); ?>" placeholder="Ej: ¡Gracias por confiar en nuestro servicio!">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Logo y Zona de Seguridad -->
            <div class="col-lg-4">
                <!-- Tarjeta Logo -->
                <div class="config-card-white">
                    <div class="config-card-header">
                        <h2>
                            <i class="fa-regular fa-image"></i>
                            <span>Logotipo del Negocio</span>
                        </h2>
                    </div>
                    <div class="config-card-body text-center">
                        <div class="logo-preview-box">
                            <?php if(!empty($datos->logo)): ?>
                                <img id="previewLogo" src="/uploads/logo/<?php echo $datos->logo; ?>">
                            <?php else: ?>
                                <img id="previewLogo" src="https://via.placeholder.com/200x100?text=Sin+Logo">
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-4 text-start">
                            <label class="form-label-config">Actualizar Archivo de Logo</label>
                            <input type="file" class="form-control-config" name="logo" accept="image/*" onchange="previewImage(event)">
                            <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Formatos recomendados: PNG o WEBP con fondo transparente.</small>
                        </div>

                        <button type="submit" class="btn-action-orange">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </div>

                <!-- Tarjeta Zona de Seguridad -->
                <div class="security-zone-card">
                    <div class="security-zone-header">
                        <h2>
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Zona de Seguridad</span>
                        </h2>
                    </div>
                    <div class="config-card-body">
                        <p class="small text-muted mb-3">Descarga una copia completa de tu base de datos (Ventas, Clientes, Productos, Órdenes, etc.) para respaldar la información de tu taller.</p>
                        <a href="/configuracion/backup" class="btn-backup-download">
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            <span>Descargar Respaldo (.sql)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('previewLogo');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
