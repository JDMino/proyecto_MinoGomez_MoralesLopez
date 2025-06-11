<?php
namespace App\Models;
use CodeIgniter\Model;

class Ventas_cabecera_model extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id_ventas_cabecera';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta'];


    public function getVentasCabecera($usuario_id) {
        return $this->db->table($this->table)->where('usuario_id', $usuario_id)->get()->getResultArray();
    }


    public function getHistorialCompras($usuario_id) {
    return $this->db->table('ventas_cabecera')
                    ->select('ventas_cabecera.id_ventas_cabecera, ventas_cabecera.fecha, ventas_cabecera.total_venta, productos.id, productos.nombre_prod, productos.marca, productos.imagen, ventas_detalle.cantidad, ventas_detalle.precio')
                    ->join('ventas_detalle', 'ventas_detalle.venta_id = ventas_cabecera.id_ventas_cabecera')
                    ->join('productos', 'productos.id = ventas_detalle.producto_id')
                    ->where('ventas_cabecera.usuario_id', $usuario_id)
                    ->orderBy('ventas_cabecera.fecha', 'DESC')
                    ->get()
                    ->getResultArray();
}

}