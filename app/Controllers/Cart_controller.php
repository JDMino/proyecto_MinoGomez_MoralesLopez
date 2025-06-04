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
        
        $session = session();
        $cart = \Config\Services::cart();
        $cart->contents();
    }

    public function mostrarCatalogo() {
        $productModel = new Productos_model();
        
        //realizo la consulta para mostrar todos los productos
        $data['producto'] = $productModel->getProductosActivos();

        $dato = ['titulo' => 'Catálogo'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\catalogo_view', $data).
                view('front\footer_view');
    }

    public function agregarAlCarrito() {
        $cart = \Config\Services::Cart();

        $request = \Config\Services::request();
        $cart->insert(array(
            'id' => $request->getPost('id'),
            'qty' => 1,
            'price' => $request->getPost('precio_vta'),
            'name' => $request->getPost('nombre_prod'),
        ));     

        return redirect()->back()->withInput();
    }

    public function actualizarCarrito() {
        $cart = \Config\Services::Cart();

        $request = \Config\Services::request();
        $cart->update(array(
            'id' => $request->getPost('id'),
            'qty' => 1,
            'price' => $request->getPost('precio_vta'),
            'name' => $request->getPost('nombre_prod'),
        ));

        return redirect()->back()->withInput();  
    }

    public function remove($rowid) {
        $cart = \Config\Services::Cart();

        $request = \Config\Services::request();
        //Si $rowid es "all" destruye el carrito
        if ($rowid==="all") {
            $cart->destroy();
        } else { //sino se destruye solo la fila seleccionada
            $cart->remove($rowid);
        }
        //Redirige a la misma página que se encuentra
        return redirect()->back()->withInput();
    }

    public function mostrarCarrito() {
        helper(['form', 'url']);
        
        $cart = \Config\Services::cart();
        $cart->contents();

        $dato = array('titulo' => 'Confirmar compra');

        $session = session();
        $nombre = $session->get('nombre');
        $perfil_id = $session->get('perfil_id');
        $email = $session->get('email');

        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\carrito\carrito_view').
                view('front\footer_view');
    }

    public function comprar_carrito() {
        $cart = \Config\Services::cart();

        $productos = $cart->contents();
        $request = \Config\Services::request();
        $montoTotal = 0;

        foreach($productos as $producto) {
            $montoTotal += $producto["price"] * $producto["qty"];
        }
        
        $ventaCabecera = new Ventas_cabecera_model();
        $idcabecera = $ventaCabecera->insert(["total_venta" => $montoTotal, "usuario_id" => session()->id]);

        $ventaDetalle = new Ventas_detalle_model();
        $productoModel = new Productos_model();

        foreach($productos as $producto) {
            $ventaDetalle->insert(["venta_id" => $idcabecera, "producto_id" => $producto["id"],
            "stock" => $producto["qty"], "precio" => $producto["price"]]);
            $productoModel->update($producto["id"], ["stock" => $producto["stock"] - $producto["qty"]]);
        }
    }
}