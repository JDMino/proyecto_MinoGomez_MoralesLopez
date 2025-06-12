<?php
namespace App\Models;
use CodeIgniter\Model;

class Ventas_cabecera_model extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id_ventas_cabecera';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta'];

    // Obtener todas las ventas de un usuario
    public function getVentasCabecera($usuario_id) {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        $builder->where('usuario_id', $usuario_id); // Filtra por usuario

        return $builder->get()->getResultArray(); // Ejecuta y devuelve resultados
    }

    // Obtener historial de compras de un usuario con detalles de productos
    public function getHistorialCompras($usuario_id, $fecha_inicio = null, $fecha_fin = null, $total_inicio = null, $total_fin = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_cabecera');

        // Aplicamos los filtros antes de los JOINs
        $builder->where('ventas_cabecera.usuario_id', $usuario_id);

        if (!empty($fecha_inicio)) {
            $builder->where('ventas_cabecera.fecha >=', $fecha_inicio);
        }
        if (!empty($fecha_fin)) {
            $builder->where('ventas_cabecera.fecha <=', $fecha_fin);
        }
        if (!empty($total_inicio)) {
            $builder->where('ventas_cabecera.total_venta >=', $total_inicio);
        }
        if (!empty($total_fin)) {
            $builder->where('ventas_cabecera.total_venta <=', $total_fin);
        }

        // Unimos las tablas necesarias
        $builder->join('ventas_detalle', 'ventas_detalle.venta_id = ventas_cabecera.id_ventas_cabecera');
        $builder->join('productos', 'productos.id = ventas_detalle.producto_id');

        $builder->select('ventas_cabecera.id_ventas_cabecera, ventas_cabecera.fecha, ventas_cabecera.total_venta, 
                        productos.nombre_prod, productos.marca, productos.imagen, 
                        ventas_detalle.cantidad, ventas_detalle.precio');

        $builder->groupBy('ventas_cabecera.id_ventas_cabecera, productos.id');

        $builder->orderBy('ventas_cabecera.fecha', 'DESC');

        return $builder->get()->getResultArray();
    }


    public function getTodasLasVentas($usuario_id = null, $fecha_inicio = null, $fecha_fin = null, $total_inicio = null, $total_fin = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_cabecera');

        // Aplicamos los filtros ANTES de los JOINs para evitar resultados incorrectos
        if (!empty($usuario_id) && is_numeric($usuario_id)) {
            $builder->where('ventas_cabecera.usuario_id', $usuario_id);
        }
        if (!empty($fecha_inicio)) {
            $builder->where('ventas_cabecera.fecha >=', $fecha_inicio);
        }
        if (!empty($fecha_fin)) {
            $builder->where('ventas_cabecera.fecha <=', $fecha_fin);
        }
        if (!empty($total_inicio)) {
            $builder->where('ventas_cabecera.total_venta >=', $total_inicio);
        }
        if (!empty($total_fin)) {
            $builder->where('ventas_cabecera.total_venta <=', $total_fin);
        }

        // Unimos solo las ventas que cumplen los filtros anteriores
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');
        $builder->join('ventas_detalle', 'ventas_detalle.venta_id = ventas_cabecera.id_ventas_cabecera');
        $builder->join('productos', 'productos.id = ventas_detalle.producto_id');

        // Seleccionamos los datos relevantes, incluyendo imagen del producto
        $builder->select('ventas_cabecera.id_ventas_cabecera, ventas_cabecera.fecha, ventas_cabecera.total_venta, 
                        usuarios.nombre AS usuario, productos.nombre_prod, productos.marca, productos.imagen, 
                        ventas_detalle.cantidad, ventas_detalle.precio');

        // Agrupamos por venta y producto para evitar duplicaciones en la unión
        $builder->groupBy('ventas_cabecera.id_ventas_cabecera, productos.id');

        $builder->orderBy('ventas_cabecera.fecha', 'DESC');

        return $builder->get()->getResultArray();
    }

}