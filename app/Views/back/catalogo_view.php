<div class="container colorF">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid mt-2 mb-3">
                <h2 class="header-sections titulo-HeaderSections text-center">Productos</h2>
            </div>

            <!-- Panel de filtros en una fila por encima del catálogo -->
            <div class="card p-3 mb-3 filtro">
                <h4 class="text-center titulo-filtro">Filtrar Productos</h4>
                <form method="GET" action="<?= base_url('catalogo') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="categoria" class="form-label label-filtro">Categoría:</label>
                            <select name="categoria" id="categoria" class="form-control form-filtro">
                                <option value="">Todas</option>
                                <?php foreach($categorias as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'selected' : '' ?>>
                                        <?= $cat['descripcion'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="marca" class="form-label label-filtro">Marca:</label>
                            <select name="marca" id="marca" class="form-control form-filtro">
                                <option value="">Todas</option>
                                <?php foreach($marcas as $marca): ?>
                                    <option value="<?= $marca['marca'] ?>" <?= (isset($_GET['marca']) && $_GET['marca'] == $marca['marca']) ? 'selected' : '' ?>>
                                        <?= $marca['marca'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="precio_min" class="form-label label-filtro">Precio mínimo:</label>
                            <input type="number" name="precio_min" id="precio_min" class="form-control form-filtro" value="<?= $_GET['precio_min'] ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="precio_max" class="form-label label-filtro">Precio máximo:</label>
                            <input type="number" name="precio_max" id="precio_max" class="form-control form-filtro" value="<?= $_GET['precio_max'] ?? '' ?>">
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-filtro">Aplicar Filtros</button>
                        </div>
                    </div>
                </form>
            </div>
             <div class="mb-3 mt-5 d-flex justify-content-end">
             <div class="col-12 col-md-4">
             <input type="text" id="buscarProductoCatalogo" class="form-control" placeholder="Buscar producto...">
              </div>
            </div>
            <!-- Catálogo de productos -->
            <div class="row">
                <?php if (!$producto): ?>
                    <div class="container-fluid">
                        <div class="well">
                            <h2 class="header-sections titulo-HeaderSections text-center">No hay Productos</h2>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($producto as $row): ?>
                        <div class="col-md-4 mt-3">
                            <div class="card catalogo-section">
                                <!-- Muestra la imagen del producto -->
                                <img src="<?= base_url('assets/uploads/' . $row['imagen']) ?>" class="card-img-top img-catalogo" alt="<?= $row['nombre_prod'] ?>">
                                <div class="card-body catalogo-producto text-center">
                                    <h5 class="card-title fw-bold"><?= $row['nombre_prod'] ?></h5>
                                    <p class="card-text card-precio fw-bold">$<?= number_format($row['precio_vta'], 2) ?></p>
                                    <p class="card-text">Stock disponible: <?= number_format($row['stock']) ?></p>

                                    <?php if ($row['stock'] <= 0): ?>
                                        <p class="text-danger fw-bold">No hay stock disponible</p>
                                    <?php else: ?>
                                        <?php if ($row['stock_min'] >= $row['stock']): ?>
                                            <p class="text-warning fw-bold">Últimas unidades</p>
                                        <?php endif; ?>

                                        <!-- Formulario para agregar el producto al carrito -->
                                        <?= form_open('agregar_carrito') ?>
                                            <?= form_hidden('id', $row['id']) ?>
                                            <?= form_hidden('precio_vta', $row['precio_vta']) ?>
                                            <?= form_hidden('nombre_prod', $row['nombre_prod']) ?>
                                            <?= form_hidden('imagen', $row['imagen']) ?>
                                            
                                            <button type="submit" class="btn btn-filtro">Agregar al Carrito</button>
                                        <?= form_close() ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>