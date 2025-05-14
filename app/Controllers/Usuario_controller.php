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
            'usuario' => 'required|min_length[3]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'password' => 'required|min_length[3]|max_length[10]',
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
                'pass' => password_hash($this->request->getVar('nombre'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('success', 'Usuario registrado con exito');
            return redirect()->to('/registro');
        }
    }
}