<h2 class="header-sections">Lista de Productos</h2>
<?php if(!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php elseif(!empty(session()->getFlashdata('msj-eliminado'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('msj-eliminado'); ?></div>
<?php endif ?>

<div class="container lista-productos">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarProducto" class="form-control w-25" placeholder="Buscar producto...">
        <div>
            <a href="<?= base_url('agregar_producto') ?>" class="btn btn-success">Agregar</a>
            <a href="<?= base_url('productos_eliminados') ?>" class="btn btn-secondary ms-2">Eliminados</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped w-100">
            <thead class="header-tabla">
                <tr class="test1">
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Precio de Venta</th>
                    <th>Stock</th>
                    <th>Stock Mínimo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaProductos">
                <?php foreach ($producto as $prod): ?>
                    <?php if ($prod['eliminado'] !== 'SI'): ?>
                        <tr class="test1">
                            <td><?= $prod['id'] ?></td>
                            <td class="nombre-producto"><?= $prod['nombre_prod'] ?></td>
                            <td class="text-center align-middle">
                                <img src="<?= base_url('assets/uploads/' . $prod['imagen']) ?>" alt="Imagen Producto" class="img-fluid" style="width: 100px; height: auto;">
                            </td>
                            <td>$<?= number_format($prod['precio'], 2) ?></td>
                            <td>$<?= number_format($prod['precio_vta'], 2) ?></td>
                            <td><?= $prod['stock'] ?></td>
                            <td><?= $prod['stock_min'] ?></td>
                            <td>
                                <a href="<?= base_url('editar_producto/' . $prod['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?= base_url('eliminar_producto/' . $prod['id']) ?>" class="btn btn-danger btn-sm">Borrar</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
