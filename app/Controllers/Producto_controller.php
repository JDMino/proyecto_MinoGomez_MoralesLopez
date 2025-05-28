<?php
namespace App\Controllers;
Use App\Models\Usuarios_model;
Use App\Models\Ventas_cabecera_Model;
Use App\Models\Ventas_detalle_Model;
Use App\Models\Categorias_model;
use App\Models\Productos_model;
use CodeIgniter\Controller;

class Producto_controller extends Controller {
    public function __construct() {
        helper(['form', 'url']);
    }

    //mostrar los productos en lista
    public function index() {
        $productModel = new Productos_model();
        
        //realizo la consulta para mostrar todos los productos
        $data['producto'] = $productModel->getProductoAll();

        $dato = ['titulo' => 'Crud_Productos'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\lista_productos_view', $data).
                view('front\footer_view');
    }

    public function productosEliminados() {


        $productModel = new Productos_model();
        
        //realizo la consulta para mostrar todos los productos
        $data['producto'] = $productModel->getProductoAll();

        $dato = ['titulo' => 'Productos Eliminados'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\productos_eliminados_view', $data).
                view('front\footer_view');
    }

    public function creaProducto() {


        $categoriasModel = new Categorias_model();
        $data['categorias'] = $categoriasModel->getCategorias();

        $productoModel = new Productos_model();
        $data['producto'] = $productoModel->getProductoAll();

        $dato = ['titulo' => 'Alta Producto'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\alta_producto_view', $data).
                view('front\footer_view');
    }

    public function store() {

        //construimos las reglas de validación
        $input = $this->validate([
            //'nombre_prod', 'imagen', 'categoria_id', 'precio', 'precio_vta', 'stock', 'stock_min'
            'nombre_prod' => 'required|min_length[3]',
            'imagen' => 'uploaded[imagen]',
            'categoria_id' => 'is_not_unique[categorias.id]',
            'precio' => 'required|numeric',
            'precio_vta' => 'required|numeric',
            'stock' => 'required',
            'stock_min' => 'required',
        ]);

        // Imprime los datos en pantalla
        //var_dump($input);
        //exit;
        $productModel = new Productos_model();

        if (!$input) {
            $categoriasModel = new Categorias_model();
            $data['categorias'] = $categoriasModel->getCategorias();
            $data['validation'] = $this->validator;

            $dato = ['titulo' => 'Alta Producto'];
            return view('front\head_view', $dato).
                    view('front\nav_view').
                    view('back\alta_producto_view', $data).
                    view('front\footer_view');            
        } else {
            $img = $this->request->getFile('imagen');

            $nombre_aleatorio = $img->getRandomName();

            $img->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre_prod'),
                'imagen' => $img->getName(),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio_vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min'),
            ];
            $producto = new Productos_model();
            $producto->insert($data);
            session()->setFlashdata('success', 'Alta Exitosa...');
            return redirect()->to('listar_productos');
        }
    }

    public function borrarProducto($id) {

        $productoModel = new Productos_model();

        // Verificar si el producto existe
        $producto = $productoModel->find($id);
        if (!$producto) {
            session()->setFlashdata('error', 'El producto no existe.');
            return redirect()->to('listar_productos');
        }

        // Realizar eliminación lógica (marcar como eliminado en la BD)
        $productoModel->update($id, ['eliminado' => 'SI']);
        
        session()->setFlashdata('msj-eliminado', 'Producto eliminado correctamente.');
        return redirect()->to('listar_productos');
    }

    public function activarProducto($id) {

        $productoModel = new Productos_model();

        // Verificar si el producto existe y está eliminado
        $producto = $productoModel->find($id);
        if (!$producto || $producto['eliminado'] == 'NO') {
            session()->setFlashdata('error', 'El producto no existe o ya está activo.');
            return redirect()->to('productos_eliminados');
        }

        // Reactivar el producto
        $productoModel->update($id, ['eliminado' => 'NO']);

        session()->setFlashdata('success', 'Producto activado correctamente.');
        return redirect()->to('productos_eliminados');
    }

    public function editarProducto($id) {


        $productoModel = new Productos_model();
        $producto = $productoModel->find($id);

        if (!$producto) {
            session()->setFlashdata('error', 'El producto no existe.');
            return redirect()->to('listar_productos');
        }

        $categoriasModel = new Categorias_model();
        $data['categorias'] = $categoriasModel->getCategorias();
        $data['producto'] = $producto;

        $dato = ['titulo' => 'Editar producto'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\editar_producto_view', $data).
                view('front\footer_view');
    }

    public function actualizarProducto($id) {


        $productoModel = new Productos_model();

        if (!$productoModel->find($id)) {
            session()->setFlashdata('error', 'El producto no existe.');
            return redirect()->to('listar_productos');
        }

        $data = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'categoria_id' => $this->request->getVar('categoria_id'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
        ];

        if ($this->request->getFile('imagen')->isValid()) {
            $img = $this->request->getFile('imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);
            $data['imagen'] = $img->getName();
        }

        $productoModel->update($id, $data);
        session()->setFlashdata('success', 'Producto actualizado correctamente.');
        return redirect()->to('listar_productos');
    }
}