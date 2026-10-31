<?php
namespace App\Controllers;

use App\Models\Cliente;

class ClienteController extends BaseController {

    public function index() {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->getAll();

        $this->view('clientes/index', [
            'titulo' => 'Gestión de Clientes',
            'clientes' => $clientes
        ]);
    }

    // --- NUEVO: Ver Perfil 360 del Cliente (Paginación 10 en 10) ---
    public function perfil() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: /clientes'); exit; }

        $clienteModel = new Cliente();
        $cliente = $clienteModel->getById($id);

        if (!$cliente) { header('Location: /clientes'); exit; }

        $limite = 10;
        
        // Paginación Órdenes (Servicios)
        $pageOrdenes = max(1, (int)($_GET['page_ordenes'] ?? 1));
        $totalOrdenes = $clienteModel->countOrdenesTotal($id);
        $totalPaginasOrdenes = max(1, (int)ceil($totalOrdenes / $limite));
        if ($pageOrdenes > $totalPaginasOrdenes) $pageOrdenes = $totalPaginasOrdenes;
        $ordenes = $clienteModel->getOrdenesPaginadas($id, $pageOrdenes, $limite);

        // Paginación Ventas (Compras)
        $pageVentas = max(1, (int)($_GET['page_ventas'] ?? 1));
        $totalVentas = $clienteModel->countVentasTotal($id);
        $totalPaginasVentas = max(1, (int)ceil($totalVentas / $limite));
        if ($pageVentas > $totalPaginasVentas) $pageVentas = $totalPaginasVentas;
        $ventas = $clienteModel->getVentasPaginadas($id, $pageVentas, $limite);

        $stats = $clienteModel->getEstadisticas($id);
        $tabActiva = $_GET['tab'] ?? 'ordenes';

        $this->view('clientes/perfil', [
            'titulo' => 'Perfil: ' . $cliente->nombre,
            'cliente' => $cliente,
            'ordenes' => $ordenes,
            'ventas' => $ventas,
            'stats' => $stats,
            'tabActiva' => $tabActiva,
            'paginationOrdenes' => [
                'pagina' => $pageOrdenes,
                'totalPaginas' => $totalPaginasOrdenes,
                'totalRegistros' => $totalOrdenes,
                'limite' => $limite
            ],
            'paginationVentas' => [
                'pagina' => $pageVentas,
                'totalPaginas' => $totalPaginasVentas,
                'totalRegistros' => $totalVentas,
                'limite' => $limite
            ]
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'direccion' => $_POST['direccion']
            ];

            $clienteModel = new Cliente();
            if ($clienteModel->create($data)) {
                header('Location: /clientes?msg=guardado');
            } else {
                header('Location: /clientes?msg=error');
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'direccion' => $_POST['direccion']
            ];

            $clienteModel = new Cliente();
            if ($clienteModel->update($data)) {
                header('Location: /clientes?msg=actualizado');
            } else {
                header('Location: /clientes?msg=error');
            }
        }
    }

    public function cambiarEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nuevoEstado = $_POST['nuevo_estado'];
            
            $clienteModel = new Cliente();
            $clienteModel->updateStatus($id, $nuevoEstado);
            
            // Volver a la página anterior (útil si estamos en el perfil)
            if(isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                header('Location: /clientes');
            }
        }
    }
}
