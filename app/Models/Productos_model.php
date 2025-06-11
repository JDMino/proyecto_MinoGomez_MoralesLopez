<?php
namespace App\Models;
use CodeIgniter\Model;

class Productos_model extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_prod', 'marca', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min', 'eliminado'];

    // Obtener todos los productos
    public function getProductoAll() {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        return $builder->get()->getResultArray(); // Ejecuta la consulta y devuelve resultados
    }

    // Obtener un producto específico por ID
    public function getProducto($id) {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        $builder->where('id', $id); // Filtra por ID de producto

        return $builder->get()->getRowArray(); // Ejecuta la consulta y devuelve un único resultado
    }

    // Obtener productos activos
    public function getProductosActivos() {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        $builder->where('eliminado', 'NO'); // Filtra productos activos (no eliminados)

        return $builder->get()->getResultArray(); // Ejecuta la consulta y devuelve resultados
    }

    // Actualizar el stock de un producto
    public function updateStock($producto_id, $nuevo_stock) {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        $builder->set('stock', $nuevo_stock); // Define el nuevo valor de stock
        $builder->where('id', $producto_id); // Filtra por ID del producto

        return $builder->update(); // Ejecuta la actualización
    }

    // Obtener productos filtrados
    public function getProductosFiltrados($categoria = null, $precio_min = null, $precio_max = null, $marca = null) {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        $builder->where('eliminado', 'NO'); // Solo productos activos

        if ($categoria) {
            $builder->where('categoria_id', $categoria); // Filtra por categoría
        }
        if ($precio_min) {
            $builder->where('precio_vta >=', $precio_min); // Filtra por precio mínimo
        }
        if ($precio_max) {
            $builder->where('precio_vta <=', $precio_max); // Filtra por precio máximo
        }
        if ($marca) {
            $builder->where('marca', $marca); // Filtra por marca
        }

        return $builder->get()->getResultArray(); // Ejecuta la consulta y devuelve resultados
    }

    // Obtener todas las marcas únicas
    public function getMarcas() {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Selección de la tabla

        $builder->select('marca'); // Selecciona solo la columna de marca
        $builder->distinct(); // Evita marcas duplicadas
        $builder->where('eliminado', 'NO'); // Solo productos activos

        return $builder->get()->getResultArray(); // Ejecuta la consulta y devuelve resultados
    }

    // Obtener los productos más vendidos (destacados)
    public function getProductosDestacados() {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_detalle'); // Selección de la tabla base

        $builder->select('productos.id, productos.nombre_prod, productos.marca, productos.imagen, productos.precio_vta');
        $builder->select('SUM(ventas_detalle.cantidad) AS total_vendido'); // Calcula el total vendido por producto

        $builder->join('productos', 'productos.id = ventas_detalle.producto_id'); // Une con productos
        $builder->where('productos.stock >', 0); // Filtra productos con stock disponible

        $builder->groupBy('productos.id'); // Agrupa por producto
        $builder->orderBy('total_vendido', 'DESC'); // Ordena por cantidad vendida en orden descendente
        $builder->limit(4); // Limita a los 4 productos más vendidos

        return $builder->get()->getResultArray(); // Ejecuta la consulta y devuelve resultados
    }
}