<body class="container">
    <header>
      <!--Barra de navegación-->
      <nav class="navbar navbar-expand-lg fixed-top fw-bold">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="<?= base_url('') ?>">
            <img src="assets/img/logo/logo.png" alt="logo" class="logo">
          </a>

          <!-- Ícono del carrito SIEMPRE visible -->
          <a href="#" class="d-lg-none me-2">
            <img src="assets/img/carrito/carro.png" alt="carro" class="carro">
          </a>

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
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url('comercializacion');?>">Comercialización</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('quienes_somos');?>">Quienes somos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('productos');?>">Productos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('contacto');?>">Contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('registro');?>">Registrarse</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('login');?>">Iniciar Sesión</a>
              </li>
            </ul>
            <form class="d-flex">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Buscar"
                aria-label="Search"
              />
            </form>

            <!-- Ícono del carrito oculto en móviles -->
            <a href="#" class="d-none d-lg-inline">
              <img src="assets/img/carrito/carro.png" alt="carro" class="carro">
            </a>
          </div>
        </div>
      </nav>
      <!--FIN DEL NAVBAR-->
  </header>