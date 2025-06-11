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
    public function getHistorialCompras($usuario_id) {
        // Conexión directa a la base de datos
        $db = \Config\Database::connect();

        // Se inicia el constructor de consultas sobre la tabla 'ventas_cabecera'
        $builder = $db->table('ventas_cabecera');

        // Selecciona los campos de 'ventas_cabecera' (ID de venta, fecha y total de venta)
        $builder->select('ventas_cabecera.id_ventas_cabecera, ventas_cabecera.fecha, ventas_cabecera.total_venta');

        // Selecciona los campos de 'productos' (ID, nombre, marca e imagen del producto)
        $builder->select('productos.id, productos.nombre_prod, productos.marca, productos.imagen');

        // Selecciona los campos de 'ventas_detalle' (cantidad comprada y precio unitario)
        $builder->select('ventas_detalle.cantidad, ventas_detalle.precio');

        // Une la tabla 'ventas_detalle' con 'ventas_cabecera' usando la clave foránea 'venta_id'
        $builder->join('ventas_detalle', 'ventas_detalle.venta_id = ventas_cabecera.id_ventas_cabecera');

        // Une la tabla 'productos' con 'ventas_detalle' para obtener detalles de cada producto vendido
        $builder->join('productos', 'productos.id = ventas_detalle.producto_id');

        // Filtra la consulta para obtener solo las compras realizadas por el usuario con el ID proporcionado
        $builder->where('ventas_cabecera.usuario_id', $usuario_id);

        // Ordena los resultados por fecha de compra en orden descendente (de más reciente a más antiguo)
        $builder->orderBy('ventas_cabecera.fecha', 'DESC');

        // Ejecuta la consulta y obtiene los resultados en formato de array asociativo
        return $builder->get()->getResultArray();
    }


    public function getTodasLasVentas($usuario_id = null, $fecha_inicio = null, $fecha_fin = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_cabecera');

        // Selección de datos
        $builder->select('ventas_cabecera.id_ventas_cabecera, ventas_cabecera.fecha, ventas_cabecera.total_venta, 
                        usuarios.nombre AS usuario, productos.nombre_prod, productos.marca, productos.imagen, 
                        ventas_detalle.cantidad, ventas_detalle.precio');

        // Uniones con otras tablas
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');
        $builder->join('ventas_detalle', 'ventas_detalle.venta_id = ventas_cabecera.id_ventas_cabecera');
        $builder->join('productos', 'productos.id = ventas_detalle.producto_id');

        // Ordenamiento por fecha
        $builder->orderBy('ventas_cabecera.fecha', 'DESC');

        // Filtrar por usuario si se especifica
        if ($usuario_id) {
            $builder->where('ventas_cabecera.usuario_id', $usuario_id);
        }

        // Filtrar por rango de fechas si se especifica
        if ($fecha_inicio && $fecha_fin) {
            $builder->where('ventas_cabecera.fecha >=', $fecha_inicio);
            $builder->where('ventas_cabecera.fecha <=', $fecha_fin);
        }

        // Ejecución de la consulta y retorno de resultados
        return $builder->get()->getResultArray();
    }


}