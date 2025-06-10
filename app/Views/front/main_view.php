<!--Fin del header-->
    <!--Inicio main-->
    <main>
    <!--Error-->
   <?php if(!empty (session()->getFlashdata('msg'))):?>
            <div class="alert alert-success" role="alert"><?=session()->getFlashdata('msg');?></div>
            <?php endif?>
            
      <div class="presentacion">
        <div class="texto-presentacion">
          <h2>RandomTech: Potencia e Innovación en Hardware</h2>
          <p>En RandomTech ofrecemos hardware de alto rendimiento para gamers y profesionales. Nuestra misión es proporcionar tecnología innovadora al mejor precio.</p>
        </div>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner carrusel-presentacion">
            <div class="carousel-item active">
              <img src="<?= base_url('assets/img/carrusel-presentacion/presentacion1.jpg'); ?>" class="d-block w-100 img-presentacion" alt="Presentación 1">
            </div>
            <div class="carousel-item">
              <img src="<?= base_url('assets/img/carrusel-presentacion/presentacion2.jpg'); ?>" class="d-block w-100  img-presentacion" alt="Presentación 2">
            </div>
            <div class="carousel-item">
              <img src="<?= base_url('assets/img/carrusel-presentacion/presentacion3.jpg'); ?>" class="d-block w-100 img-presentacion" alt="Presentación 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <!--Inicio Carrusel categorías-->
      <div class="carousel-container">
          <button class="button prev" onclick="moverDiapositiva(-1)">&#10094;</button>
          <div class="carousel" id="carousel">
              <?php foreach ($categorias as $categoria): ?>
                  <div class="slide">
                      <a href="<?= base_url('catalogo') ?>?categoria=<?= $categoria['id'] ?>" class="link-categoria">
                          <img src="<?= base_url('assets/img/categorias/' . strtolower(str_replace(' ', '', $categoria['descripcion'])) . '.png') ?>" alt="<?= $categoria['descripcion'] ?>">
                          <p class="category"><?= $categoria['descripcion'] ?></p>
                      </a>
                  </div>
              <?php endforeach; ?>
          </div>
          <button class="button next" onclick="moverDiapositiva(1)">&#10095;</button>
      </div>
      <!--Fin Carrusel categorías-->
    </main>
    <!--Fin main-->
    <section class="section-destacados">
        <h4 class="header-destacados">¡Productos Destacados!</h4>
        <div class="cards-destacados d-flex justify-content-around">
            <?php foreach ($productos_destacados as $producto): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url('assets/uploads/'.$producto['imagen']) ?>" class="card-img-top" alt="<?= $producto['nombre_prod'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $producto['nombre_prod'] ?></h5>
                    <h6 class="card-precio">$<?= number_format($producto['precio_vta'], 2, ',', '.') ?></h6>
                    

                  <!-- Formulario para agregar el producto al carrito -->
                  <form action="<?= base_url('agregar_carrito') ?>" method="post">
                      <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                      <input type="hidden" name="precio_vta" value="<?= $producto['precio_vta'] ?>">
                      <input type="hidden" name="nombre_prod" value="<?= $producto['nombre_prod'] ?>">
                      <input type="hidden" name="imagen" value="<?= $producto['imagen'] ?>">
                      <button type="submit" class="btn btn-catalogo">Agregar al Carrito</button>
                  </form>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section-marcas d-flex justify-content-center">
        <a href="<?= base_url('catalogo') ?>?marca=AMD">
            <img src="<?= base_url('assets/img/marcas/amd_marca.jpg') ?>" alt="AMD" class="img-marcas">
        </a>
        <a href="<?= base_url('catalogo') ?>?marca=Asus">
            <img src="<?= base_url('assets/img/marcas/asus.jpg') ?>" alt="Asus" class="img-marcas">
        </a>
        <a href="<?= base_url('catalogo') ?>?marca=Intel">
            <img src="<?= base_url('assets/img/marcas/intel.jpg') ?>" alt="Intel" class="img-marcas">
        </a>
        <a href="<?= base_url('catalogo') ?>?marca=HP">
            <img src="<?= base_url('assets/img/marcas/hp.jpg') ?>" alt="HP" class="img-marcas">
        </a>
        <a href="<?= base_url('catalogo') ?>?marca=Corsair">
            <img src="<?= base_url('assets/img/marcas/corsair.jpg') ?>" alt="Corsair" class="img-marcas">
        </a>
        <a href="<?= base_url('catalogo') ?>?marca=Adata">
            <img src="<?= base_url('assets/img/marcas/adata.jpg') ?>" alt="Adata" class="img-marcas">
        </a>
        <a href="<?= base_url('catalogo') ?>?marca=Gigabyte">
            <img src="<?= base_url('assets/img/marcas/gigabyte.jpg') ?>" alt="Gigabyte" class="img-marcas">
        </a>
    </section>
    <section class="info-extra">
      <div class="div-info-extra">
        <img 
          src="<?= base_url('assets/img/infoextra/envios.png')?>"
          class="mx-auto d-block"
          alt="envios" />
        <h6 class="text-center my-3 fs-4 fw-bold">Envios a todo el país</h6>
        <p>Realizamos envíos a todo el País por medio de OCA. Recibí tu producto donde sea que estés.</p>
      </div>
      <div class="div-info-extra">
        <img
          src="<?= base_url('assets/img/infoextra/Retiros.png')?>"
          class="mx-auto d-block"
          alt="retiros"
        />
        <h6 class="text-center my-3 fs-4 fw-bold">Retiro gratis</h6>
        <p>En nuestra sucursal en Av. 9 de Julio 1234 - Corrientes Capital, Argentina de Lun a Vie de 10 a 18hs.</p>
        </div>
      </div>
      <div class="div-info-extra">
        <img
          src="<?= base_url('assets/img/infoextra/garantia.png')?>"
          class="mx-auto d-block"
          alt="garantía"
        />
        <h6 class="text-center my-3 fs-4 fw-bold">Garantía y respaldo</h6>
        <p>Todos nuestros productos cuentan con garantía oficial</p>
      </div>
      <div class="div-info-extra">
        <img
          src="<?= base_url('assets/img/infoextra/tarjeta.png')?>"
          class="mx-auto d-block"
          alt="financiación"
        />
        <h6 class="text-center my-3 fs-4 fw-bold">Financiación</h6>
        <p>Tarjetas de crédito VISA y MASTER con 3, 6 y 12 cuotas sin interés</p>
      </div>
    </section>