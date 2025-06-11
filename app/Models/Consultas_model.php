<?php
namespace App\Models;
use CodeIgniter\Model;

class Consultas_model extends Model
{
    protected $table = 'consultas';
    protected $primaryKey = 'id_consulta';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'telefono', 'respuesta', 'mensaje', 'estado'];

    public function getConsultasAll() {
        return $this->findAll();
    }

    public function responderConsulta($id, $respuesta) {
        return $this->update($id, ['respuesta' => $respuesta, 'estado' => 'RESPONDIDA']);
    }

    public function actualizarEstado($id, $nuevoEstado) {
        return $this->update($id, ['estado' => $nuevoEstado]);
    }
}
