<?php
namespace App\Controllers;
use App\Models\Usuarios_model;
use App\Models\Perfiles_model;
use App\Models\Consultas_model;
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

    //mostrar la lista de usuarios
    public function index() {

        $usuarioModel = new Usuarios_model();
        
        //realizo la consulta para mostrar todos los usuarios
        $data['usuarios'] = $usuarioModel->getUsuariosAll();

        $dato = ['titulo' => 'Usuarios'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\lista_usuarios_view', $data).
                view('front\footer_view');
    }

    public function usuariosEliminados() {


        $usuarioModel = new Usuarios_model();
        
        //realizo la consulta para mostrar todos los usuarios
        $data['usuarios'] = $usuarioModel->getUsuariosAll();

        $dato = ['titulo' => 'Usuarios Eliminados'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\usuarios_eliminados_view', $data).
                view('front\footer_view');
    }

    //dar de baja un usuario
    public function borrarUsuario($id) {

        
        $usuarioModel = new Usuarios_model();

        // Verificar si el usuario existe
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            session()->setFlashdata('error', 'El usuario no existe.');
            return redirect()->to('listar_usuarios');
        }

        // Realizar eliminación lógica (marcar como dado de baja en la BD)
        $usuarioModel->update($id, ['baja' => 'SI']);
        
        session()->setFlashdata('msj-usuario-eliminado', 'Usuario dado de baja correctamente.');
        return redirect()->to('listar_usuarios');
    }

    public function activarUsuario($id) {

        $usuarioModel = new Usuarios_model();

        // Verificar si el usuario existe y está eliminado
        $usuario = $usuarioModel->find($id);
        if (!$usuario || $usuario['baja'] == 'NO') {
            session()->setFlashdata('error', 'El usuario no existe o ya está activo.');
            return redirect()->to('usuarios_eliminados');
        }

        // Reactivar el producto
        $usuarioModel->update($id, ['baja' => 'NO']);

        session()->setFlashdata('success', 'Usuario activado correctamente.');
        return redirect()->to('usuarios_eliminados');
    }

    public function editarUsuario($id) {


        $usuarioModel = new Usuarios_model();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            session()->setFlashdata('error', 'El usuario no existe.');
            return redirect()->to('listar_usuarios');
        }

        $perfilesModel = new Perfiles_model();
        $data['perfiles'] = $perfilesModel->getPerfiles();
        $data['usuario'] = $usuario;

        $dato = ['titulo' => 'Editar Usuario'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\editar_usuario_view', $data).
                view('front\footer_view');
    }

    public function actualizarUsuario($id) {


        $usuarioModel = new Usuarios_model();

        if (!$usuarioModel->find($id)) {
            session()->setFlashdata('error', 'El usuario no existe.');
            return redirect()->to('listar_usuarios');
        }

        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'usuario' => $this->request->getVar('usuario'),
            'email' => $this->request->getVar('email'),
            'perfil_id' => $this->request->getVar('perfil_id'),
        ];

        $usuarioModel->update($id, $data);
        session()->setFlashdata('success', 'Usuario actualizado correctamente.');
        return redirect()->to('listar_usuarios');
    }
}