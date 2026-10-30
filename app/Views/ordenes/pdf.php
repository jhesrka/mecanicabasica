<?php
// --- LÓGICA LOGO BASE64 ---
$logoBase64 = null;
if (!empty($sistema->logo)) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . $sistema->logo;
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden #<?php echo str_pad($orden->id, 4, '0', STR_PAD_LEFT); ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { width: 100%; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .logo-section { float: left; width: 60%; }
        .logo-text { font-size: 24px; font-weight: bold; color: #2c3e50; }
        .meta-section { float: right; width: 40%; text-align: right; }
        .section-title { background-color: #eee; padding: 5px; font-weight: bold; margin-top: 20px; border-bottom: 1px solid #ccc; clear: both; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f8f9fa; border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
        td { border-bottom: 1px solid #eee; padding: 8px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-box { float: right; width: 30%; margin-top: 20px; }
        .total-row { padding: 10px; background-color: #eee; font-size: 14px; font-weight: bold; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 10px; color: #777; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-section">
            <?php if($logoBase64): ?>
                <img src="<?php echo $logoBase64; ?>" style="max-height: 60px;">
            <?php else: ?>
                <div class="logo-text"><?php echo $sistema->nombre_sistema; ?></div>
            <?php endif; ?>
            
            <div style="font-size: 11px; margin-top: 5px;">
                <strong><?php echo $sistema->nombre_sistema; ?></strong><br>
                <?php echo $sistema->direccion; ?><br>
                Tel: <?php echo $sistema->telefono; ?> | Email: <?php echo $sistema->email; ?>
            </div>
        </div>
        
        <div class="meta-section">
            <div style="font-size: 18px; font-weight: bold;">ORDEN DE SERVICIO</div>
            <div style="font-size: 14px; margin-top: 5px;">N°: <?php echo str_pad($orden->id, 4, '0', STR_PAD_LEFT); ?></div>
            <div>Fecha: <?php echo date('d/m/Y H:i', strtotime($orden->fecha_recepcion)); ?></div>
            
            <div style="margin-top: 10px;">
                <?php 
                    $urlRastreo = "http://" . $_SERVER['HTTP_HOST'] . "/rastreo?ticket=ORD-" . str_pad($orden->id, 4, '0', STR_PAD_LEFT);
                ?>
                <img src="http://bwipjs-api.metafloor.com/?bcid=qrcode&text=<?php echo urlencode($urlRastreo); ?>&scale=3" style="width: 60px; height: 60px;">
                <div style="font-size: 9px; color: #555;">Escanear para ver estado</div>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <table style="margin-bottom: 20px;">
        <tr>
            <td width="50%" valign="top" style="border: none;">
                <div class="section-title" style="margin-top:0;">DATOS DEL CLIENTE</div>
                <p>
                    <strong>Cliente:</strong> <?php echo $orden->cliente_nombre; ?><br>
                    <strong>Teléfono:</strong> <?php echo $orden->cliente_telefono; ?><br>
                    <strong>Email:</strong> <?php echo $orden->cliente_email; ?><br>
                    <strong>Dirección:</strong> <?php echo $orden->cliente_direccion; ?>
                </p>
            </td>
            <td width="50%" valign="top" style="border: none;">
                <div class="section-title" style="margin-top:0;">DATOS DEL VEHÍCULO</div>
                <p>
                    <?php $placaImprimir = !empty($orden->placa) ? $orden->placa : (!empty($orden->equipo_serie) ? $orden->equipo_serie : 'S/P'); ?>
                    <strong>Placa:</strong> <span style="font-size: 13px; font-weight: bold; background: #eee; padding: 2px 6px; border: 1px solid #ccc;"><?php echo htmlspecialchars($placaImprimir); ?></span><br>
                    <strong>Vehículo:</strong> <?php echo htmlspecialchars(($orden->equipo_tipo ?? 'Auto') . ' ' . $orden->equipo_marca . ' ' . ($orden->equipo_modelo ?? '')); ?><br>
                    <?php if (!empty($orden->anio)): ?><strong>Año:</strong> <?php echo htmlspecialchars($orden->anio); ?> &nbsp;<?php endif; ?>
                    <?php if (!empty($orden->color)): ?><strong>Color:</strong> <?php echo htmlspecialchars($orden->color); ?><br><?php endif; ?>
                    <?php if (!empty($orden->kilometraje)): ?><strong>Kilometraje:</strong> <?php echo number_format($orden->kilometraje, 0, '', ','); ?> Km<br><?php endif; ?>
                    <?php if (!empty($orden->nivel_combustible)): ?><strong>Combustible:</strong> <?php echo htmlspecialchars($orden->nivel_combustible); ?><br><?php endif; ?>
                    <strong>Motivo/Falla:</strong> <?php echo htmlspecialchars($orden->falla_reportada); ?>
                </p>
            </td>
        </tr>
    </table>

    <div class="section-title">DETALLE DE SERVICIOS Y REPUESTOS</div>
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th class="text-center" width="10%">Cant.</th>
                <th class="text-right" width="20%">P. Unit</th>
                <th class="text-right" width="20%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($repuestos as $rep): ?>
            <tr>
                <td><?php echo $rep->producto_nombre; ?></td>
                <td class="text-center"><?php echo $rep->cantidad; ?></td>
                <td class="text-right"><?php echo $sistema->simbolo_moneda . ' ' . number_format($rep->precio_unitario, 2); ?></td>
                <td class="text-right"><?php echo $sistema->simbolo_moneda . ' ' . number_format($rep->subtotal, 2); ?></td>
            </tr>
            <?php endforeach; ?>

            <?php if($orden->costo_mano_obra > 0): ?>
            <tr>
                <td>Servicio Técnico / Mano de Obra</td>
                <td class="text-center">1</td>
                <td class="text-right"><?php echo $sistema->simbolo_moneda . ' ' . number_format($orden->costo_mano_obra, 2); ?></td>
                <td class="text-right"><?php echo $sistema->simbolo_moneda . ' ' . number_format($orden->costo_mano_obra, 2); ?></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="total-box">
        <table width="100%">
            <tr class="total-row">
                <td class="text-right">TOTAL A PAGAR:</td>
                <td class="text-right"><?php echo $sistema->simbolo_moneda . ' ' . number_format($orden->total, 2); ?></td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div style="margin-top: 50px; font-size: 10px; color: #555;">
        <p><strong>Términos y condiciones:</strong></p>
        <?php if(!empty($sistema->terminos_orden)): ?>
            <div><?php echo nl2br($sistema->terminos_orden); ?></div>
        <?php else: ?>
            <ul>
                <li>La empresa no se responsabiliza por vehículos abandonados por más de 30 días en las instalaciones del taller.</li>
                <li>Toda reparación mecánica tiene una garantía de 30 días o 1,000 Km sobre la mano de obra y repuestos provistos.</li>
                <li>No nos responsabilizamos por objetos de valor no declarados en el inventario de recepción.</li>
                <li>Para consultar el estado en tiempo real de su vehículo escanee el código QR.</li>
            </ul>
        <?php endif; ?>
    </div>

    <div class="footer">
        Generado por <?php echo $sistema->nombre_sistema; ?> - <?php echo date('d/m/Y H:i:s'); ?>
    </div>

</body>
</html>