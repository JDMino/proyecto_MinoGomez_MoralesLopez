<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/terminos', 'Home::terminos_condiciones');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/quienes_somos','Home::quienes_somos');
$routes->get('/productos','Home::productos');
$routes->get('/contacto', 'Home::contacto');

//registrarse
$routes->get('/registro', 'Home::registro');
$routes->post('/enviar-form', 'Usuario_controller::formValidation');