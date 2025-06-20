<?php 
$session = session();
$id = $session->get('id_usuario');
$nombre = $session->get('nombre');
?>
<body class="container">
    <header>
      <!--Barra de navegación-->
      <nav class="navbar navbar-expand-lg fixed-top fw-bold">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="<?= base_url('') ?>">
            <img src="<?= base_url('assets/img/logo/logo.png'); ?>" alt="logo" class="logo">
          </a>

          <!-- Ícono del carrito móviles//// -->
          <?php if ($session->get('logged_in')): ?>
            <a href="<?= base_url('mostrar_carrito')?>" class="d-lg-none me-2">
              <img src="<?= base_url('assets/img/carrito/carro.png'); ?>" alt="carro" class="carro">
            </a>
            <?php endif; ?>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <?php if ($session->get('perfil_id') == 1): ?>
                <li>
                <a class="nav-link" href="<?= base_url('dashboard')?>">PANEL ADMIN: <?php echo $nombre ?></a>
              </li>
              <?php elseif($session->get('perfil_id') == 2): ?>
                <li>
                <a class="nav-link" href="<?= base_url('/')?>">CLIENTE: <?php echo $nombre ?></a>
              </li>
              <?php endif;?>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url('comercializacion');?>">Comercialización</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('quienes_somos');?>">Quienes somos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('catalogo');?>">Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('contacto');?>">Contacto</a>
              </li>
              <?php if (!$session->get('logged_in')): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('registro');?>">Registrarse</a>
              </li>
              <?php endif;?>
              <?php if ($session->get('logged_in')): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('listar_compras/' . $id);?>">Historial de Compras</a>
              </li>
              <?php endif;?>
            </ul>
            <?php if (!$session->get('logged_in')): ?>
              <li class="list-unstyled">
                <a class="nav-link" href="<?= base_url('login')?>">
                  <img src="<?= base_url('assets/img/login-logout/login.png'); ?>" alt="iniciar-sesion" class="iniciar-sesion">
                  Iniciar Sesión
                </a>
              </li>
              <?php else: ?>
                <li class="list-unstyled">
                <a class="nav-link text-danger" href="<?= base_url('logout')?>">
                    <img src="<?= base_url('assets/img/login-logout/logout.png'); ?>" alt="cerrar-sesion" class="cerrar-sesion">
                    Cerrar Sesión
                </a>
                </li>
              <?php endif;?>
            <!-- Ícono del carrito PC///-->
            <?php if ($session->get('logged_in')): ?>
              <a href="<?= base_url('mostrar_carrito')?>" class="d-none d-lg-inline">
                <img src="<?= base_url('assets/img/carrito/carro.png'); ?>" alt="carro" class="carro">
              </a>
            <?php endif; ?>
          </div>
        </div>
      </nav>
      <!--FIN DEL NAVBAR-->
  </header>