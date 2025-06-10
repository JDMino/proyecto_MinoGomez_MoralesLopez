<?php

namespace App\Controllers;
Use App\Models\Categorias_model;
Use App\Models\Productos_model;

class Home extends BaseController
{
    public function index() {
        $categoriasModel = new Categorias_model();
        $productoModel = new Productos_model();
        $data['productos_destacados'] = $productoModel->getProductosDestacados();

        // Obtener categorías activas desde la base de datos
        $data['categorias'] = $categoriasModel->getCategorias();

        // Cargar la vista con las categorías dinámicas
        return view('front/head_view', ['titulo' => 'Inicio'])
            . view('front/nav_view')
            . view('front/main_view', $data)
            . view('front/footer_view');
    }

    
    public function terminos_condiciones():string
    {   
        $data['titulo'] = 'Terminos y condiciones';
        return view('front/head_view', $data)
                .view('front/nav_view')
                .view('front/terminos_view')
                .view('front/footer_view');
    }

    public function comercializacion() : string
    {
        $data['titulo'] = 'Comercializacion';
        return view('front/head_view', $data)
        .view('front/nav_view')
        .view('front/comercializacion_view')
        .view('front/footer_view');
    }

    public function quienes_somos(): string
    {
        $data = ['titulo' => 'Quiénes Somos'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('front\quienes_somos_view').
                view('front\footer_view');
    }

    /*
    public function productos(): string
    {
        $data = ['titulo' => 'Productos'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('front\productos_view').
                view('front\footer_view');
    }
    */

    public function contacto(): string
    {
        $data = ['titulo' => 'Información de Contacto'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('front\contacto_view').
                view('front\footer_view');
    }

    public function registro()
    {
        $session = session();
        //si ya esta logeado vuelve al inicio
        if ($session->get('logged_in') && $session->get(('perfil_id') != 1)) {
            return redirect()->to('/');
        }

        $data = ['titulo' => 'Registro'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('back\registro_view').
                view('front\footer_view');
    }

    public function login()
    {
        $session = session();
        //si ya esta logeado vuelve al inicio
        if ($session->get('logged_in')) {
            return redirect()->to('/');
        }

        $data = ['titulo' => 'Inicio de Sesión'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('back\login_view').
                view('front\footer_view');
    }
}
