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


    //CONSULTAS
    public function formValidationConsultas() {

        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email',
            'telefono' => 'required|min_length[1]',
            'mensaje' => 'required|min_length[2]|max_length[1000]',
        ]);
        
        //var_dump($input);
        //die;

        $formModel = new Consultas_model();

        if (!$input) {
            $data = ['titulo' => 'Información de Contacto'];
                    return view('front\head_view', $data).
                            view('front\nav_view').
                            view('front\contacto_view').
                            view('back\consultas\consulta_view').
                            view('front\footer_view');
        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'email' => $this->request->getVar('email'),
                'telefono' => $this->request->getVar('telefono'),
                'mensaje' => $this->request->getVar('mensaje'),
            ]);

            session()->setFlashdata('success', 'Consulta enviada con éxito');
            return redirect()->to('/contacto');
        }
    }


     //mostrar la lista de usuarios
    public function listar_consultas() {

        $consultasModel = new Consultas_model();
        
        //realizo la consulta para mostrar todos los usuarios
        $data['consultas'] = $consultasModel->getConsultasAll();

        $dato = ['titulo' => 'Lista de Consultas'];
        return view('front\head_view', $dato).
                view('front\nav_view').
                view('back\consultas\listar_consultas_view', $data).
                view('front\footer_view');
    }

    public function responder_consulta($id_consulta) {
        $consultasModel = new Consultas_model();
        $consulta = $consultasModel->find($id_consulta);

        if (!$consulta) {
            session()->setFlashdata('error', 'Consulta no encontrada.');
            return redirect()->to('/listar_consultas_admin');
        }

        $dato = ['titulo' => 'Responder consulta'];
        return view('front/head_view', $dato)
               .view('front/nav_view')
               .view('back/consultas/responder_consulta_view', ['consulta' => $consulta])
               .view('front/footer_view');
    }

    public function guardar_respuesta() {
        $consultasModel = new Consultas_model();
        $id_consulta = $this->request->getVar('id_consulta');
        $respuesta = $this->request->getVar('respuesta');

        if (!$id_consulta || !$respuesta) {
            session()->setFlashdata('error', 'Debe ingresar una respuesta.');
            return redirect()->to('/responder_consulta' . $id_consulta);
        }

        $consultasModel->responderConsulta($id_consulta, $respuesta);
        session()->setFlashdata('success', 'Respuesta guardada con éxito.');
        return redirect()->to('/listar_consultas');
    }

    public function eliminar_consulta($id_consulta) {
        $consultasModel = new Consultas_model();
        $consulta = $consultasModel->find($id_consulta);

        if (!$consulta) {
            session()->setFlashdata('error', 'Consulta no encontrada.');
            return redirect()->to('/listar_consultas_admin');
        }

        if (!empty($consulta['respuesta'])) {
            $consultasModel->actualizarEstado($id_consulta, 'CONSULTA ELIMINADA');
            session()->setFlashdata('success', 'Consulta Eliminada.');
        } else {
            session()->setFlashdata('error', 'No puedes marcar como respondida una consulta sin respuesta.');
        }

        return redirect()->to('/listar_consultas');
    }


    public function listar_consultas_eliminadas() {
    $consultasModel = new Consultas_model();

    // Filtrar solo consultas con estado "CONSULTA ELIMINADA"
    $data['consultas'] = $consultasModel->getConsultasEliminadas();
    $data['titulo'] = 'Consultas Eliminadas';

    return view('front/head_view', $data)
           .view('front/nav_view')
           .view('back/consultas/consultas_eliminadas_view', $data)
           .view('front/footer_view');
}


}

