<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAdmin implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        //si el usuario no esta logueado
        if (!session()->get('logged_in')) {
            //entonces redirecciona a la pagina de login
            return redirect()->to('/login');
        } else {
            //si no es admin redirreciona al inicio
            if (session()->get('perfil_id') != 1) {
                return redirect()->to('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $responseS, $arguments = null) {
        //
    }
}