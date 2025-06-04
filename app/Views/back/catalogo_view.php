<div class="container colorF">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col">
            <div class="row">
                <?php if (!$producto): ?>
                    <div class="container-fluid">
                        <div class="well">
                            <h2 class="header-sections titulo-HeaderSections text-center">No hay Productos</h2>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="container-fluid mt-2 mb-3">
                        <h2 class="header-sections titulo-HeaderSections text-center">Todos los Productos</h2>
                    </div>
                    <?php foreach($producto as $row): ?>
                        <div class="col-md-4 mt-3">
                            <div class="card catalogo-section">
                                <!-- Muestra la imagen del producto -->
                                <img src="<?= base_url('assets/uploads/' . $row['imagen']) ?>" class="card-img-top img-catalogo" alt="<?= $row['nombre_prod'] ?>">
                                <div class="card-body catalogo-producto text-center">
                                    <h5 class="card-title fw-bold"><?= $row['nombre_prod'] ?></h5>
                                    <p class="card-text">$<?= number_format($row['precio_vta'], 2) ?></p>
                                    <p class="card-text"><?= ($row['stock'] > 0) ? 'Hay stock' : 'No hay stock' ?></p>
                                    <p class="card-text">Stock disponible: <?= number_format($row['stock']) ?></p>
                                    
                                    <!-- Formulario para agregar el producto al carrito -->
                                    <?= form_open('agregar_carrito') ?>
                                        <?= form_hidden('id', $row['id']) ?>
                                        <?= form_hidden('precio_vta', $row['precio_vta']) ?>
                                        <?= form_hidden('nombre_prod', $row['nombre_prod']) ?>
                                        <button type="submit" class="btn btn-secondary">Agregar al Carrito</button>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
