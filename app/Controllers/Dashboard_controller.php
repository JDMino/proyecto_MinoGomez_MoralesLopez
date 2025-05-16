<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Dashboard_controller extends BaseController {
public function index() {
        $session = session();

        if ($session->get('perfil_id') != 1) {
            return redirect()->to('/');
        }
        $data = ['titulo' => 'Panel de Administración'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('back\dashboard_view').
                view('front\footer_view');
    }
}