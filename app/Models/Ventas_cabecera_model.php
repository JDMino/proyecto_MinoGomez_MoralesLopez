<?php
namespace App\Models;
use CodeIgniter\Model;

class Ventas_cabecera_model extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id_ventas_cabecera';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta'];

    public function getVentasCabecera() {
        return $this->findAll();
    }
}