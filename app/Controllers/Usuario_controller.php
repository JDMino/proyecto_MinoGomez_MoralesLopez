<?php
namespace App\Controllers;
use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller {

    public function __construct() {
        helper(['form', 'url']);
    }

    public function formValidation() {

        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario' => 'required|min_length[3]|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[10]',
        ]);
        

        $formModel = new Usuarios_model();

        if (!$input) {
            $data = ['titulo' => 'Registro'];
            return view('front\head_view', $data).
                    view('front\nav_view').
                    view('back\registro_view', ['validation' => $this->validator]).
                    view('front\footer_view');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('success', 'Usuario registrado con exito');
            return redirect()->to('/registro');
        }
    }

    //mostrar la lista de clientes
    public function index() {
        $session = session();
        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }

        $usuarioModel = new Usuarios_model();
        
        //realizo la consulta para mostrar todos los clientes
        $data['clientes'] = $usuarioModel->getClientesAll();

        $dato = ['titulo' => 'Clientes'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\lista_clientes_view', $data).
                view('front\footer_view');
    }

    public function clientesEliminados() {
        $session = session();
        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }

        $usuarioModel = new Usuarios_model();
        
        //realizo la consulta para mostrar todos los clientes
        $data['clientes'] = $usuarioModel->getClientesAll();

        $dato = ['titulo' => 'Clientes'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\clientes_eliminados_view', $data).
                view('front\footer_view');
    }

    //dar de baja un cliente
    public function borrarCliente($id) {
        $session = session();
        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }
        
        $usuarioModel = new Usuarios_model();

        // Verificar si el cliente existe
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            session()->setFlashdata('error', 'El cliente no existe.');
            return redirect()->to('listar_clientes');
        }

        // Realizar eliminación lógica (marcar como dado de baja en la BD)
        $usuarioModel->update($id, ['baja' => 'SI']);
        
        session()->setFlashdata('msj-cliente-eliminado', 'Cliente dado de baja correctamente.');
        return redirect()->to('listar_clientes');
    }

    public function activarCliente($id) {
        $session = session();
        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }
        $usuarioModel = new Usuarios_model();

        // Verificar si el usuario existe y está eliminado
        $usuario = $usuarioModel->find($id);
        if (!$usuario || $usuario['baja'] == 'NO') {
            session()->setFlashdata('error', 'El cliente no existe o ya está activo.');
            return redirect()->to('clientes_eliminados');
        }

        // Reactivar el producto
        $usuarioModel->update($id, ['baja' => 'NO']);

        session()->setFlashdata('success', 'Cliente activado correctamente.');
        return redirect()->to('clientes_eliminados');
    }

    public function editarCliente($id) {
        $session = session();
        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }

        $usuarioModel = new Usuarios_model();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            session()->setFlashdata('error', 'El usuario no existe.');
            return redirect()->to('listar_clientes');
        }

        $data['usuario'] = $usuario;

        $dato = ['titulo' => 'Editar Cliente'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\editar_cliente_view', $data).
                view('front\footer_view');
    }

    public function actualizarCliente($id) {
        $session = session();
        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }

        $usuarioModel = new Usuarios_model();

        if (!$usuarioModel->find($id)) {
            session()->setFlashdata('error', 'El cliente no existe.');
            return redirect()->to('listar_clientes');
        }

        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'usuario' => $this->request->getVar('usuario'),
            'email' => $this->request->getVar('email'),
        ];

        $usuarioModel->update($id, $data);
        session()->setFlashdata('success', 'Cliente actualizado correctamente.');
        return redirect()->to('listar_clientes');
    }
}