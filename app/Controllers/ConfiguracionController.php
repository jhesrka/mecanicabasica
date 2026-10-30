<?php
namespace App\Controllers;

use App\Models\Configuracion;
use PDO;

class ConfiguracionController extends BaseController {

    public function index() {
        $configModel = new Configuracion();
        $datos = $configModel->obtenerConfiguracion();

        $this->view('configuracion/index', [
            'titulo' => 'Configuración del Sistema',
            'datos' => $datos
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $configModel = new Configuracion();
            $configActual = $configModel->obtenerConfiguracion();

            // Procesar Logo con Redimensionamiento, Compresión WebP y Borrado Anterior
            $logo = null;
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
                $carpetaDestino = __DIR__ . '/../../public/uploads/logo/';
                if (!file_exists($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }

                $archivoTmp = $_FILES['logo']['tmp_name'];
                $extension = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));

                // Si GD está disponible en PHP, procesamos y optimizamos
                if (function_exists('imagecreatefromstring')) {
                    $contenido = @file_get_contents($archivoTmp);
                    $recursoOrigen = $contenido ? @\imagecreatefromstring($contenido) : null;

                    if ($recursoOrigen) {
                        // Borrar logo anterior si existe en el disco
                        if (!empty($configActual->logo) && file_exists($carpetaDestino . $configActual->logo)) {
                            @unlink($carpetaDestino . $configActual->logo);
                        }

                        $anchoOriginal = \imagesx($recursoOrigen);
                        $altoOriginal = \imagesy($recursoOrigen);

                        // Calcular dimensiones manteniendo la proporción (máx 500x500)
                        $maxDim = 500;
                        $nuevoAncho = $anchoOriginal;
                        $nuevoAlto = $altoOriginal;

                        if ($anchoOriginal > $maxDim || $altoOriginal > $maxDim) {
                            if ($anchoOriginal >= $altoOriginal) {
                                $nuevoAncho = $maxDim;
                                $nuevoAlto = (int)round(($altoOriginal / $anchoOriginal) * $maxDim);
                            } else {
                                $nuevoAlto = $maxDim;
                                $nuevoAncho = (int)round(($anchoOriginal / $altoOriginal) * $maxDim);
                            }
                        }

                        // Crear lienzo con soporte de canal alfa (transparencia)
                        $lienzoNuevo = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        \imagealphablending($lienzoNuevo, false);
                        \imagesavealpha($lienzoNuevo, true);
                        $transparente = \imagecolorallocatealpha($lienzoNuevo, 255, 255, 255, 127);
                        \imagefilledrectangle($lienzoNuevo, 0, 0, $nuevoAncho, $nuevoAlto, $transparente);

                        // Redimensionar con interpolación de alta calidad
                        \imagecopyresampled($lienzoNuevo, $recursoOrigen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $anchoOriginal, $altoOriginal);

                        // Guardar comprimido como WebP (alta compresión y transparencia) o fallback PNG
                        if (function_exists('imagewebp')) {
                            $nombreArchivo = 'logo_' . time() . '.webp';
                            \imagewebp($lienzoNuevo, $carpetaDestino . $nombreArchivo, 85);
                        } else {
                            $nombreArchivo = 'logo_' . time() . '.png';
                            \imagepng($lienzoNuevo, $carpetaDestino . $nombreArchivo, 8);
                        }

                        \imagedestroy($recursoOrigen);
                        \imagedestroy($lienzoNuevo);

                        $logo = $nombreArchivo;
                    } else {
                        // Fallback: Si no se pudo procesar con GD, guardar archivo original
                        if (!empty($configActual->logo) && file_exists($carpetaDestino . $configActual->logo)) {
                            @unlink($carpetaDestino . $configActual->logo);
                        }
                        $nombreArchivo = 'logo_' . time() . '.' . $extension;
                        if (move_uploaded_file($archivoTmp, $carpetaDestino . $nombreArchivo)) {
                            $logo = $nombreArchivo;
                        }
                    }
                } else {
                    // Fallback sin GD: mover archivo directo y borrar el anterior
                    if (!empty($configActual->logo) && file_exists($carpetaDestino . $configActual->logo)) {
                        @unlink($carpetaDestino . $configActual->logo);
                    }
                    $nombreArchivo = 'logo_' . time() . '.' . $extension;
                    if (move_uploaded_file($archivoTmp, $carpetaDestino . $nombreArchivo)) {
                        $logo = $nombreArchivo;
                    }
                }
            }

            // Preparar datos
            $data = [
                'nombre_sistema' => $_POST['nombre_sistema'],
                'moneda' => $_POST['moneda'],
                'simbolo_moneda' => $_POST['simbolo_moneda'],
                'impuesto' => $_POST['impuesto'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'direccion' => $_POST['direccion'],
                'terminos_orden' => $_POST['terminos_orden'],
                'mensaje_ticket' => $_POST['mensaje_ticket'],
                'logo' => $logo
            ];

            if ($configModel->update($data)) {
                header('Location: /configuracion?msg=actualizado');
            } else {
                header('Location: /configuracion?msg=error');
            }
        }
    }

    // --- Generar Backup de la Base de Datos ---
    public function backup() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /?msg=no_autorizado');
            exit;
        }

        try {
            $db = $this->db;
            $tables = [];
            
            $stmt = $db->query("SHOW TABLES");
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }

            $sqlScript = "-- RESPALDO SISTEMA TALLER PRO \n";
            $sqlScript .= "-- Fecha: " . date('Y-m-d H:i:s') . "\n\n";
            $sqlScript .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $row = $db->query("SHOW CREATE TABLE $table")->fetch(PDO::FETCH_NUM);
                $sqlScript .= "\n\n" . $row[1] . ";\n\n";

                $rows = $db->query("SELECT * FROM $table");
                $columnCount = $rows->columnCount();

                while ($row = $rows->fetch(PDO::FETCH_NUM)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\nSET FOREIGN_KEY_CHECKS=1;\n";

            $backupFileName = 'backup_taller_' . date('Y-m-d_H-i-s') . '.sql';
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"" . $backupFileName . "\"");
            echo $sqlScript;
            exit;

        } catch (\Exception $e) {
            header('Location: /configuracion?msg=error_backup');
            exit;
        }
    }
}
