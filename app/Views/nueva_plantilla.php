<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/miestilo.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Mi web</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-secondary fixed-top ">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Boostrap</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="https://google.com">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contactos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="#">
          <i class="bi bi-cart2">  </i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container  mt-3 bg-secondary">
    <div class="row">
      <div class="col-md-6 p-0">
      <img src="assets/img/banner-img-1.jpg" class="w-100 h-auto">
      </div>
      <div class="col-md-6 d-flex align-items-center justify-content-center flex-column">
      <h2>New collection</h2>
      <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic quos odit possimus vero deserunt voluptas assumenda! Facilis eos eius molestias! </P>
      </div>
    </div>
  </div>

  <div class="carrusel container p-5">
  <h4>More new arrivals.</h4>
  <div id="carouselExampleInterval" class="container carousel slide bg-secondary>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row  justify-content-center">
          <img src="assets/img/c_pant_girl.png" class="col-md-4 col-sm-4 mb-3" alt="...">
          <img src="assets/img/c_shirt-girl.png" class="col-md-4 col-sm-4 mb-3" alt="...">
          <img src="assets/img/c_t-shirt_men.png" class="col-md-4 col-sm-4 mb-3" alt="...">
        </div>
      </div>
      <div class="carousel-item">
        <div class="row  justify-content-center">
          <img src="assets/img/c_pant_girl.png" class="col-md-4 col-sm-4 mb-3" alt="...">
          <img src="assets/img/c_shirt-girl.png" class="col-md-4 col-sm-4 mb-3" alt="...">
          <img src="assets/img/c_t-shirt_men.png" class="col-md-4 col-sm-4 mb-3x" alt="...">
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>