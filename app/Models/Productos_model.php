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

    // Obtener productos filtrados
    public function getProductosFiltrados($categoria = null, $precio_min = null, $precio_max = null, $marca = null) {
        $query = $this->db->table($this->table)->where('eliminado', 'NO');

        if ($categoria) {
            $query->where('categoria_id', $categoria);
        }
        if ($precio_min) {
            $query->where('precio_vta >=', $precio_min);
        }
        if ($precio_max) {
            $query->where('precio_vta <=', $precio_max);
        }
        if ($marca) {
            $query->where('marca', $marca); // Filtra por marca en el nuevo campo
        }

        return $query->get()->getResultArray();
    }

    // Obtener todas las marcas únicas
    public function getMarcas() {
    return $this->db->table($this->table)
                    ->select('marca')
                    ->distinct()
                    ->where('eliminado', 'NO')
                    ->get()
                    ->getResultArray();
    }
}