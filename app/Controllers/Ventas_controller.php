<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Productos_model;
use App\Models\Usuarios_model;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;
use App\Controllers\Cart_controller;

class Ventas_controller extends Controller
{
    public function registrar_venta()
    {
        $session = session();
        //require(APPPATH . 'Controllers/Cart_controller.php');
        $cartController = new Cart_controller();
        $cart_contents = $cartController->devolver_carrito();

        $productoModel = new Productos_model();
        $ventasModel = new Ventas_cabecera_model();
        $detalleModel = new Ventas_detalle_model();

        $productos_validos = [];
        $productos_sin_stock = [];
        $total = 0;

        foreach ($cart_contents as $item) {
            $producto = $productoModel->getProducto($item['id']);
            //var_dump(($producto['stock']));
            //print_r(array_keys($producto));
            //exit;

            //exit;
            //if ($producto && isset($producto['stock']) && $producto['stock'] >= $item['qty']) {

            if ($producto &&  $producto['stock'] >= $item['qty']) {
                $productos_validos[] = $item;
                $total += $item['subtotal'];
            } else {
                $productos_sin_stock[] = $item['name'];
                $cartController->remove($item['rowid']);
            }
        }

        if (!empty($productos_sin_stock)) {
            $mensaje = 'Los siguientes productos no tienen stock suficiente y fueron eliminados: <br>' . implode(', ', $productos_sin_stock);
            $session->setFlashdata('mensaje', $mensaje);
            return redirect()->to(base_url('mostrar_carrito'));
        }

        if (empty($productos_validos)) {
            $session->setFlashdata('mensaje', 'No hay productos válidos para registrar la venta.');
            return redirect()->to(base_url('mostrar_carrito'));
        }

        $nueva_venta = [
            'usuario_id' => $session->get('id_usuario'),
            'total_venta' => $total
        ];
        $venta_id = $ventasModel->insert($nueva_venta);

        foreach ($productos_validos as $item) {
            $detalle = [
                'venta_id' => $venta_id,
                'producto_id' => $item['id'],
                'cantidad' => $item['qty'],
                'precio' => $item['subtotal']
            ];
            $detalleModel->insert($detalle);

            $productoModel->updateStock($item['id'], $producto['stock'] - $item['qty']);
        }

        //$cartController->remove('all');
        $session->setFlashdata('mensaje', 'Venta registrada exitosamente.');
        return redirect()->to(base_url('vista_compras/' . $venta_id));
    }



    public function ver_factura($venta_id) {
        $detalle_ventas = new Ventas_detalle_model();
        $data['venta'] = $detalle_ventas->getVentasDetalle($venta_id);
        $cartController = new Cart_controller();
        $data['cart'] = $cartController->devolver_carrito();

        $dato['titulo'] = "Mi compra";
        //var_dump($cartController->devolver_carrito());
        //exit;
        $cartController->remove('all');

        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\compras\compras_view', $data).
                view('front\footer_view');
    }

    public function ver_factura_usuario($usuario_id) {
        $detalle_ventas = new Ventas_cabecera_model();
        $data['ventas'] = $detalle_ventas->getVentasCabecera($usuario_id);

        //var_dump($data['ventas']);
        //die;

        $dato['titulo'] = "Lista de compras";

        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\compras\facturas_view', $data).
                view('front\footer_view');
    }

}