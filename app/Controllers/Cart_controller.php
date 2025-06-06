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
        helper(['form', 'url', 'cart']);
        
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
        $cart->insert([
            'id' => $request->getPost('id'),
            'qty' => 1,
            'price' => $request->getPost('precio_vta'),
            'name' => $request->getPost('nombre_prod'),
            'imagen' => $request->getPost('imagen'),
            
        ]);

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
        
        $cart = \Config\Services::cart();
        $data['cart'] = $cart->contents(); // Aquí pasamos el carrito correctamente a la vista

        $dato = array('titulo' => 'Confirmar compra');

        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\carrito\carrito_view', $data). // Pasamos los datos del carrito
                view('front\footer_view');
    }

    // Sumar cantidad a un producto en el carrito
    public function suma($rowid) {
        $cart = \Config\Services::Cart();

        $item = $cart->getItem($rowid);

        if ($item) {
            $cart->update([
                'rowid' => $rowid,
                'qty' => $item['qty'] + 1
            ]);
        }

        return redirect()->back()->withInput();
    }

    // Restar cantidad o eliminar si es la última unidad
    public function resta($rowid) {
        $cart = \Config\Services::Cart();

        $item = $cart->getItem($rowid);

        if ($item) {
            if ($item['qty'] > 1) {
                $cart->update([
                    'rowid' => $rowid,
                    'qty' => $item['qty'] - 1
                ]);
            } else {
                $cart->remove($rowid);
            }
        }

        return redirect()->back()->withInput();
    }

    public function devolver_carrito() {
        $cart = \Config\Services::Cart();
        return $cart->contents();
    }
}