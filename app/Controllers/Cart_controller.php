<?php
namespace App\Controllers;
Use App\Models\Usuarios_model;
Use App\Models\Ventas_cabecera_Model;
Use App\Models\Ventas_detalle_Model;
Use App\Models\Categorias_model;
use App\Models\Productos_model;
use CodeIgniter\Controller;

class Cart_controller extends Controller {
    public function __construct() {
        helper(['form', 'url']);
        //faltan cosas acá
    }

    public function mostrarCatalogo() {
        $productModel = new Productos_model();
        
        //realizo la consulta para mostrar todos los productos
        $data['producto'] = $productModel->getProductoAll();

        $dato = ['titulo' => 'Catálogo'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\catalogo_view', $data).
                view('front\footer_view');
    }
}