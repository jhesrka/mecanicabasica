<?php
// Logo Base64
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
    <title>Garantía #<?php echo str_pad($orden->id, 4, '0', STR_PAD_LEFT); ?></title>
    <style>
        /* CONFIGURACIÓN DE PÁGINA */
        @page { 
            margin: 0px; 
            size: A4 landscape;
        }
        
        body { 
            font-family: 'Times New Roman', serif; 
            margin: 0; 
            padding: 0; 
        }

        /* CONTENEDOR PRINCIPAL (MARCO) */
        .border-container { 
            position: fixed; 
            top: 10mm;
            left: 10mm;
            width: 277mm;  
            height: 180mm; 
            
            border: 4px double #2c3e50; 
            box-sizing: border-box;
            padding: 15px;
        }

        /* ENCABEZADO */
        .header { text-align: center; margin-bottom: 5px; }
        .title { 
            font-size: 28px; 
            font-weight: bold; 
            text-transform: uppercase; 
            color: #2c3e50; 
            letter-spacing: 2px; 
            border-bottom: 2px solid #ddd;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 0px;
        }
        .subtitle { font-size: 10px; color: #7f8c8d; letter-spacing: 1px; }

        /* CONTENIDO */
        .content { 
            margin-top: 10px; 
            font-size: 12px; 
            line-height: 1.3; 
            text-align: center; 
            padding: 0 40px;
        }
        .highlight { 
            font-weight: bold; 
            font-size: 15px;
            color: #000;
            text-decoration: underline;
        }

        /* CAJA DE DETALLES */
        .details-box { 
            margin: 10px auto; 
            width: 96%; 
            border: 1px solid #bdc3c7; 
            padding: 5px; 
            text-align: left; 
            font-family: sans-serif; 
            font-size: 10px; 
            background-color: #f8f9fa; 
            border-radius: 4px;
        }
        
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td { vertical-align: top; padding: 2px 5px; }

        /* FIRMAS - CORREGIDO (Subido hacia arriba) */
        .signatures { 
            position: absolute;
            bottom: 80px; /* Antes 35px -> Subido a 80px para despegar del borde */
            left: 0;
            width: 100%;
        }
        .sig-block { 
            width: 30%; 
            float: left; 
            text-align: center; 
            margin: 0 10%; 
        }
        .line { border-top: 1px solid #333; margin-bottom: 5px; }

        /* PIE DE PÁGINA - CORREGIDO (Subido hacia arriba) */
        .footer { 
            position: absolute; 
            bottom: 25px; /* Antes 5px -> Subido a 25px */
            left: 0; 
            right: 0; 
            text-align: center; 
            font-size: 8px; 
            color: #95a5a6; 
            font-family: sans-serif; 
        }

        .disclaimer {
            font-size: 8px; 
            color: #777; 
            font-style: italic; 
            text-align: center; 
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="border-container">
        <div class="header">
            <?php if($logoBase64): ?>
                <img src="<?php echo $logoBase64; ?>" style="height: 40px; margin-bottom: 2px;">
                <br>
            <?php endif; ?>
            <div class="title">Certificado de Garantía Automotriz</div>
            <br>
            <span class="subtitle">TALLER MECÁNICO Y SERVICIOS - <?php echo strtoupper($sistema->nombre_sistema ?? 'TALLER PRO'); ?></span>
        </div>

        <div class="content">
            <p style="margin: 5px 0;">
                Certificamos que el vehículo propiedad del cliente:
                <br>
                <span class="highlight"><?php echo htmlspecialchars($orden->cliente_nombre); ?></span>
            </p>
            <p style="margin: 5px 0;">
                Ha sido reparado y verificado en nuestras instalaciones, contando con una garantía mecánica de 
                <strong>30 DÍAS o 1,000 KM</strong> a partir de: <strong><?php echo date('d/m/Y'); ?></strong>.
            </p>
        </div>

        <div class="details-box">
            <table class="details-table">
                <tr>
                    <td width="50%" style="border-right: 1px dashed #ccc;">
                        <strong style="color:#e65100;">DATOS DEL VEHÍCULO</strong><br>
                        <?php $placaG = !empty($orden->placa) ? $orden->placa : (!empty($orden->equipo_serie) ? $orden->equipo_serie : 'S/P'); ?>
                        <strong>Placa:</strong> <span style="font-weight:bold; background:#eee; padding: 1px 4px; border:1px solid #ccc;"><?php echo htmlspecialchars($placaG); ?></span><br>
                        <strong>Tipo / Marca:</strong> <?php echo htmlspecialchars(($orden->equipo_tipo ?? 'Auto') . ' ' . $orden->equipo_marca); ?><br>
                        <strong>Modelo:</strong> <?php echo htmlspecialchars($orden->equipo_modelo ?? ''); ?><br>
                        <?php if (!empty($orden->kilometraje)): ?>
                            <strong>Km Salida:</strong> <?php echo number_format($orden->kilometraje, 0, '', ','); ?> Km<br>
                        <?php endif; ?>
                        <strong>Orden Ref:</strong> #<?php echo str_pad($orden->id, 4, '0', STR_PAD_LEFT); ?>
                    </td>
                    <td width="50%" style="padding-left: 10px;">
                        <strong style="color:#e65100;">SERVICIOS Y REPUESTOS EN GARANTÍA</strong><br>
                        <ul style="margin: 2px 0; padding-left: 15px;">
                            <?php if($orden->costo_mano_obra > 0): ?>
                                <li>Mano de Obra Mecánica Calificada</li>
                            <?php endif; ?>
                            <?php foreach($repuestos as $rep): ?>
                                <li><?php echo htmlspecialchars($rep->producto_nombre); ?> (x<?php echo $rep->cantidad; ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <div class="disclaimer">
            * La garantía cubre defectos de instalación y piezas provistas por el taller. 
            No cubre: Choques, negligencia de conducción, falta de lubricantes/aceite posterior o intervención de terceros ajenos al taller.
        </div>

        <div class="signatures">
            <div class="sig-block">
                <div class="line"></div>
                <strong><?php echo $sistema->nombre_sistema; ?></strong><br>
                <small>Técnico Responsable</small>
            </div>
            <div class="sig-block">
                <div class="line"></div>
                <strong>Conformidad del Cliente</strong><br>
                <small>DNI / Firma</small>
            </div>
        </div>

        <div class="footer">
            Documento generado el <?php echo date('d/m/Y H:i:s'); ?> | Válido como original.
        </div>
    </div>
</body>
</html>