<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = ['titulo' => 'RandomTech'];
        return view('front\head_view', $data).
                view('front\nav_view').
                view('front\main_view').
                view('front\footer_view');
    }
}
