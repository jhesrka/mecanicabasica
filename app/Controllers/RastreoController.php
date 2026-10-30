<?php
namespace App\Controllers;

use App\Models\Orden;
use App\Models\Configuracion;

class RastreoController {

    protected $db;
    protected $config;

    public function __construct() {
        $database = new \Config\Database();
        $this->db = $database->getConnection();
        
        $configModel = new Configuracion();
        $this->config = $configModel->obtenerConfiguracion();
    }

    public function index() {
        $ticket = $_GET['ticket'] ?? null;
        $resultado = null;
        $error = null;

        if ($ticket) {
            $ordenModel = new Orden();
            // Buscar por N° de orden o por Placa vehicular
            $resultado = $ordenModel->buscarParaRastreo($ticket);

            if (!$resultado) {
                // Si ingresó con prefijo 'ORD-0001'
                $idLimpio = intval(str_ireplace('ORD-', '', $ticket));
                if ($idLimpio > 0) {
                    $resultado = $ordenModel->getById($idLimpio);
                }
            }

            if (!$resultado) {
                $error = "No se encontró ningún vehículo u orden registrada con el criterio: '$ticket'";
            }
        }

        $sistema = $this->config;
        
        require_once __DIR__ . '/../Views/rastreo/buscar.php';
    }
}
