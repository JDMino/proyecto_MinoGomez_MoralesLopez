<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Usuarios_model;

class Login_controller extends BaseController {
    public function index() {
        helper(['form', 'url']);
    }

    public function auth() {
        $session = session(); //iniciamos el objeto session()
        $model = new Usuarios_model(); //instanciamos el modelo

        //traemos los datos del formulario
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');

        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['pass']; //revisar si es 'pass' o 'password'
            $ba = $data['baja'];
            if ($ba == 'SI') {
                $session->setFlashdata('msg', 'usuario dado de baja');
                return redirect()->to('/');
            }
            
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id' => $data['perfil_id'],
                    'logged_in' => TRUE
                ];
                //Se cumple la verificacion e inicia la sesion
                $session->set($ses_data);

                session()->setFlashdata('msg', 'Bienvenido!');

                //Si el usuario es admin, redirigir a Dashboard
                /*if ($data['perfil_id'] == 1) {
                    return redirect()->to('/dashboard');
                } else {
                    return redirect()->to('/');
                }*/
                return redirect()->to('/dashboard');
            } else {
                //no paso la validacion de la password
                $session->setFlashdata('msg', 'Password Incorrecta');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'No ingreso un email o es incorrecto');
            return redirect()->to('/login');
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}