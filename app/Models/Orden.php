<?php
namespace App\Models;

use PDO;

class Orden extends BaseModel {
    
    public function getAll() {
        try {
            $sql = "SELECT o.*, c.nombre as cliente_nombre, c.telefono as cliente_telefono 
                    FROM ordenes_servicio o
                    INNER JOIN clientes c ON o.cliente_id = c.id
                    ORDER BY o.fecha_recepcion DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $e) { return []; }
    }

    public function getById($id) {
        try {
            $sql = "SELECT o.*, c.nombre as cliente_nombre, c.email as cliente_email, c.telefono as cliente_telefono, c.direccion as cliente_direccion
                    FROM ordenes_servicio o
                    INNER JOIN clientes c ON o.cliente_id = c.id
                    WHERE o.id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (\Exception $e) { return null; }
    }

    public function getRepuestos($ordenId) {
        try {
            $sql = "SELECT orp.*, p.nombre as producto_nombre, p.codigo 
                    FROM orden_repuestos orp
                    INNER JOIN productos p ON orp.producto_id = p.id
                    WHERE orp.orden_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $ordenId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $e) { return []; }
    }

    public function getHistorial($ordenId) {
        try {
            $sql = "SELECT h.*, u.nombre as usuario_nombre, u.rol 
                    FROM historial_ordenes h
                    JOIN usuarios u ON h.usuario_id = u.id
                    WHERE h.orden_id = :id 
                    ORDER BY h.fecha DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $ordenId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $e) { 
            return []; 
        }
    }

    // --- LOG EVENTO ---
    public function logEvento($ordenId, $accion, $detalle = '') {
        try {
            $usuarioId = $_SESSION['user_id'] ?? 1;

            $sql = "INSERT INTO historial_ordenes (orden_id, usuario_id, accion, detalle) 
                    VALUES (:oid, :uid, :accion, :detalle)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':oid' => $ordenId, 
                ':uid' => $usuarioId, 
                ':accion' => $accion, 
                ':detalle' => $detalle
            ]);
        } catch (\Throwable $e) { 
            die("ERROR AL GUARDAR HISTORIAL: " . $e->getMessage());
        }
    }

    // --- UPDATE STATUS ---
    public function updateStatus($id, $nuevoEstado) {
        try {
            $stmt = $this->db->prepare("UPDATE ordenes_servicio SET estado = :estado WHERE id = :id");
            $res = $stmt->execute([':estado' => $nuevoEstado, ':id' => $id]);
            
            if($res) {
                $this->logEvento($id, 'Cambio de Estado', 'Estado cambiado a ' . strtoupper($nuevoEstado));
                return true;
            } else {
                die("Error: La consulta SQL de actualización falló sin lanzar excepción.");
            }
        } catch (\Exception $e) { 
            die("ERROR SQL CRÍTICO: " . $e->getMessage());
        }
    }

    public function updateDiagnostico($id, $texto) {
        try {
            $stmt = $this->db->prepare("UPDATE ordenes_servicio SET observaciones_tecnicas = :texto WHERE id = :id");
            return $stmt->execute([':texto' => $texto, ':id' => $id]);
        } catch (\Exception $e) { return false; }
    }

    public function create($data) {
        try {
            $this->db->beginTransaction();
            
            $sql = "INSERT INTO ordenes_servicio (
                        cliente_id, usuario_id, equipo_tipo, placa, equipo_marca, 
                        equipo_modelo, equipo_serie, anio, color, kilometraje, 
                        nivel_combustible, vin_chasis, falla_reportada, fecha_promesa, estado
                    ) VALUES (
                        :cliente_id, :uid, :tipo, :placa, :marca, 
                        :modelo, :serie, :anio, :color, :kilometraje, 
                        :combustible, :vin, :falla, :fecha, 'pendiente'
                    )";
            $stmt = $this->db->prepare($sql);
            $placa = strtoupper(trim($data['placa'] ?? ($data['equipo_serie'] ?? '')));
            $stmt->execute([
                ':cliente_id' => $data['cliente_id'],
                ':uid' => $_SESSION['user_id'] ?? 1,
                ':tipo' => $data['equipo_tipo'] ?? 'Auto',
                ':placa' => $placa,
                ':marca' => $data['equipo_marca'] ?? '',
                ':modelo' => $data['equipo_modelo'] ?? '',
                ':serie' => $placa,
                ':anio' => !empty($data['anio']) ? intval($data['anio']) : null,
                ':color' => $data['color'] ?? '',
                ':kilometraje' => !empty($data['kilometraje']) ? intval($data['kilometraje']) : null,
                ':combustible' => $data['nivel_combustible'] ?? '1/2',
                ':vin' => $data['vin_chasis'] ?? '',
                ':falla' => $data['falla_reportada'] ?? '',
                ':fecha' => !empty($data['fecha_promesa']) ? $data['fecha_promesa'] : null
            ]);
            
            $id = $this->db->lastInsertId();
            $this->logEvento($id, 'Creación', 'Vehículo ingresado al taller (Placa: ' . ($placa ?: 'S/P') . ')');
            $this->db->commit();
            return true;
        } catch (\Exception $e) { 
            $this->db->rollBack();
            die("Error al crear orden: " . $e->getMessage());
        }
    }

    public function addRepuesto($ordenId, $productoId, $cantidad, $precio) {
        try {
            $subtotal = $cantidad * $precio;
            $sql = "INSERT INTO orden_repuestos (orden_id, producto_id, cantidad, precio_unitario, subtotal) 
                    VALUES (:orden_id, :prod_id, :cant, :precio, :subtotal)";
            $this->db->prepare($sql)->execute([
                ':orden_id' => $ordenId, ':prod_id' => $productoId, ':cant' => $cantidad, ':precio' => $precio, ':subtotal' => $subtotal
            ]);

            $this->db->prepare("UPDATE productos SET stock = stock - :cant WHERE id = :id")->execute([':cant' => $cantidad, ':id' => $productoId]);
            $this->recalcularTotal($ordenId);
            $this->logEvento($ordenId, 'Repuesto Agregado', "Se agregó repuesto/insumo ID: $productoId");
            return true;
        } catch (\Exception $e) { return false; }
    }

    public function removeRepuesto($detalleId) {
        try {
            $stmt = $this->db->prepare("SELECT orden_id, producto_id, cantidad FROM orden_repuestos WHERE id = :id");
            $stmt->execute([':id' => $detalleId]);
            $item = $stmt->fetch(PDO::FETCH_OBJ);

            if ($item) {
                $this->db->prepare("DELETE FROM orden_repuestos WHERE id = :id")->execute([':id' => $detalleId]);
                $this->db->prepare("UPDATE productos SET stock = stock + :cant WHERE id = :id")->execute([':cant' => $item->cantidad, ':id' => $item->producto_id]);
                $this->recalcularTotal($item->orden_id);
                $this->logEvento($item->orden_id, 'Repuesto Eliminado', "Se removió repuesto/insumo de la orden");
                return true;
            }
            return false;
        } catch (\Exception $e) { return false; }
    }

    public function updateManoObra($ordenId, $costo) {
        try {
            $this->db->prepare("UPDATE ordenes_servicio SET costo_mano_obra = :costo WHERE id = :id")->execute([':costo' => $costo, ':id' => $ordenId]);
            $this->recalcularTotal($ordenId);
            $this->logEvento($ordenId, 'Mano de Obra', "Costo de servicio mecánico actualizado a: " . $costo);
            return true;
        } catch (\Exception $e) { return false; }
    }

    private function recalcularTotal($ordenId) {
        $stmt = $this->db->prepare("SELECT SUM(subtotal) as total_repuestos FROM orden_repuestos WHERE orden_id = :id");
        $stmt->execute([':id' => $ordenId]);
        $repuestos = $stmt->fetch(PDO::FETCH_OBJ)->total_repuestos ?? 0;

        $stmt = $this->db->prepare("SELECT costo_mano_obra FROM ordenes_servicio WHERE id = :id");
        $stmt->execute([':id' => $ordenId]);
        $manoObra = $stmt->fetch(PDO::FETCH_OBJ)->costo_mano_obra ?? 0;

        $totalGeneral = $repuestos + $manoObra;
        $this->db->prepare("UPDATE ordenes_servicio SET total = :total WHERE id = :id")->execute([':total' => $totalGeneral, ':id' => $ordenId]);
    }

    // Buscar por ID o por Placa
    public function buscarParaRastreo($criterio) {
        try {
            $criterio = trim($criterio);
            $sql = "SELECT o.*, c.nombre as cliente_nombre 
                    FROM ordenes_servicio o 
                    INNER JOIN clientes c ON o.cliente_id = c.id 
                    WHERE o.id = :id OR o.placa = :placa OR o.equipo_serie = :serie 
                    ORDER BY o.fecha_recepcion DESC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => is_numeric($criterio) ? intval($criterio) : 0,
                ':placa' => strtoupper($criterio),
                ':serie' => strtoupper($criterio)
            ]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (\Exception $e) { return null; }
    }
}
