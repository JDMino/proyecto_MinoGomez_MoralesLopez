<?php
namespace App\Models;
use CodeIgniter\Model;

class Productos_model extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_prod', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min', 'eliminado'];

    // Obtener todos los productos
    public function getProductoAll() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

    // Obtener un producto específico por ID
    public function getProducto($id) {
        return $this->db->table($this->table)->where('id', $id)->get()->getRowArray();
    }

    // Obtener productos activos
    public function getProductosActivos() {
        return $this->db->table($this->table)->where('eliminado', 'NO')->get()->getResultArray();
    }

    // Actualizar el stock de un producto
    public function updateStock($producto_id, $nuevo_stock) {
        return $this->db->table($this->table)
                        ->set('stock', $nuevo_stock)
                        ->where('id', $producto_id)
                        ->update();
    }
}
