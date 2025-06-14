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
        $cartController->remove('all');

        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\compras\compras_view', $data).
                view('front\footer_view');
    }

    public function listar_compras($usuario_id) {
        //si un cliente intenta ingresar a la lista de compras de otro usuario, probando IDs en la barra de direcciones:
        $session = session();
        $id_usuario = $session->get('id_usuario');
        if ($id_usuario != $usuario_id) {
            return redirect()->to(base_url('/')); //vuelve a la página de inicio
        }

        //si id_usuario y usuario_id coinciden, entonces se muestra la lista de compras:
        $ventasModel = new Ventas_cabecera_model();

        // Capturar filtros GET
        $fecha_inicio = $this->request->getGet('fecha_inicio');
        $fecha_fin = $this->request->getGet('fecha_fin');
        $total_inicio = $this->request->getGet('total_inicio');
        $total_fin = $this->request->getGet('total_fin');

        // Validar valores para evitar errores en la consulta
        $total_inicio = is_numeric($total_inicio) ? $total_inicio : null;
        $total_fin = is_numeric($total_fin) ? $total_fin : null;

        $data['compras'] = $ventasModel->getHistorialCompras($usuario_id, $fecha_inicio, $fecha_fin, $total_inicio, $total_fin);

        $dato = ['titulo' => 'Historial de Compras'];
        return view('front\head_view', $dato).
            view('front\nav_view').
            view('back\compras\facturas_view', $data).
            view('front\footer_view');
    }

    public function listar_ventas() {
        $ventasModel = new Ventas_cabecera_model();
        $usuariosModel = new Usuarios_model(); // Para obtener lista de usuarios

        $usuario_id = $this->request->getGet('usuario_id');
        $fecha_inicio = $this->request->getGet('fecha_inicio');
        $fecha_fin = $this->request->getGet('fecha_fin');
        $total_inicio = $this->request->getGet('total_inicio');
        $total_fin = $this->request->getGet('total_fin');

        $total_inicio = is_numeric($total_inicio) ? $total_inicio : null;
        $total_fin = is_numeric($total_fin) ? $total_fin : null;

        $data['ventas'] = $ventasModel->getTodasLasVentas($usuario_id, $fecha_inicio, $fecha_fin, $total_inicio, $total_fin);

        $data['usuarios'] = $usuariosModel->findAll(); // Obtener lista de usuarios para el filtro

        // Calcular el total de ventas
        $data['total_ventas'] = array_sum(array_column($data['ventas'], 'total_venta'));

        $dato = ['titulo' => 'Administrar Ventas'];
        return view('front\head_view', $dato).
            view('front\nav_view').
            view('back\listar_ventas_view', $data).
            view('front\footer_view');
    }

}