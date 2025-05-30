<h2 class="header-sections titulo-HeaderSections">Productos</h2>
<div class="container mt-5">
    <div class="row">
        <!-- Productos -->
         <?php foreach ($producto as $prod): ?>
                    <?php if ($prod['eliminado'] != 'SI'): ?>
                                <div class="col-md-4">
                                     <div class="card">
                                        <img src="<?= base_url('assets/uploads/' . $prod['imagen'])?>" class="card-img-top" alt="Producto 1">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $prod['nombre_prod'] ?></h5>
                                            <p class="card-text">$<?= number_format($prod['precio_vta'], 2) ?></p>
                                            <p class="card-text">Stock disponible:<?=number_format($prod['stock'])?></p>
                                            <a href="#" class="btn btn-primary">Comprar</a>
                                        </div>
                                    </div>
                                 </div>     
                    <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

