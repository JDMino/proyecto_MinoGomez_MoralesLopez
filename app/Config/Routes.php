<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/terminos', 'Home::terminos_condiciones');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/quienes_somos','Home::quienes_somos');

//registrarse
$routes->get('/registro', 'Home::registro');
$routes->post('/enviar-form', 'Usuario_controller::formValidation');

//login
$routes->get('/login', "Home::login");
$routes->post('/enviar-login', 'Login_controller::auth');
$routes->get('/logout', 'Login_controller::logout');
$routes->get('/dashboard', 'Dashboard_controller::index', ['filter' => 'auth']);

//productos
$routes->get('/listar_productos', "Producto_controller::index", ['filter' => 'authAdmin']);
$routes->get('/productos_eliminados', "Producto_controller::productosEliminados", ['filter' => 'authAdmin']);
$routes->get('/agregar_producto', "Producto_controller::creaProducto", ['filter' => 'authAdmin']);
$routes->post('/guardar-producto', 'Producto_controller::store', ['filter' => 'authAdmin']);
$routes->get('/eliminar_producto/(:num)', "Producto_controller::borrarProducto/$1", ['filter' => 'authAdmin']);
$routes->get('/activar_producto/(:num)', "Producto_controller::activarProducto/$1", ['filter' => 'authAdmin']);
$routes->get('/editar_producto/(:num)', "Producto_controller::editarProducto/$1", ['filter' => 'authAdmin']);
$routes->post('/actualizar-producto/(:num)', "Producto_controller::actualizarProducto/$1", ['filter' => 'authAdmin']);

//usuarios
$routes->get('/listar_usuarios', "Usuario_controller::index", ['filter' => 'authAdmin']);
$routes->get('/eliminar_usuario/(:num)', "Usuario_controller::borrarUsuario/$1", ['filter' => 'authAdmin']);
$routes->get('/usuarios_eliminados', "Usuario_controller::usuariosEliminados", ['filter' => 'authAdmin']);
$routes->get('/activar_usuario/(:num)', "Usuario_controller::activarUsuario/$1", ['filter' => 'authAdmin']);
$routes->get('/editar_usuario/(:num)', "Usuario_controller::editarUsuario/$1", ['filter' => 'authAdmin']);
$routes->post('/actualizar-usuario/(:num)', "Usuario_controller::actualizarUsuario/$1", ['filter' => 'authAdmin']);

//catalogo y carrito
$routes->get('/catalogo','Cart_controller::mostrarCatalogo');
$routes->get('/mostrar_carrito','Cart_controller::mostrarCarrito', ['filter' => 'auth']);
$routes->get('/actualizar_carrito','Cart_controller::actualizarCarrito', ['filter' => 'auth']);
$routes->post('/agregar_carrito','Cart_controller::agregarAlCarrito', ['filter' => 'auth']);
$routes->get('/eliminar_item/(:any)','Cart_controller::remove/$1', ['filter' => 'auth']);
$routes->get('/carrito_suma/(:any)','Cart_controller::suma/$1', ['filter' => 'auth']);
$routes->get('/carrito_resta/(:any)','Cart_controller::resta/$1', ['filter' => 'auth']);

//ventas
$routes->get('/confirmar_compra','Ventas_controller::registrar_venta', ['filter' => 'auth']);
$routes->get('/vista_compras/(:any)','Ventas_controller::ver_factura/$1', ['filter' => 'auth']);
$routes->get('/listar_compras/(:any)','Ventas_controller::listar_compras/$1', ['filter' => 'auth']);
$routes->get('/listar_ventas','Ventas_controller::listar_ventas', ['filter' => 'auth']);

//consultas
$routes->get('/contacto', 'Home::contacto');
$routes->post('/enviar-consulta', 'Consultas_controller::formValidationConsultas');
$routes->get('/listar_consultas', "Consultas_controller::listar_consultas", ['filter' => 'authAdmin']);
$routes->get('/responder_consulta/(:num)', "Consultas_controller::responder_consulta/$1", ['filter' => 'authAdmin']);
$routes->post('/guardar_respuesta/(:num)', "Consultas_controller::guardar_respuesta/$1", ['filter' => 'authAdmin']);
$routes->get('/eliminar_consulta/(:num)', "Consultas_controller::eliminar_consulta/$1", ['filter' => 'authAdmin']);
$routes->get('/consultas_eliminadas', "Consultas_controller::listar_consultas_eliminadas", ['filter' => 'authAdmin']);