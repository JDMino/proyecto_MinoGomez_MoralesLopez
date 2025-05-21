<h2 class="header-sections">Productos Eliminados</h2>
 <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success" role="alert"><?=session()->getFlashdata('success');?></div>
            <?php endif?>
<div class="container lista-productos">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarProducto" class="form-control w-25" placeholder="Buscar producto...">
        <div>
            <a href="<?= base_url('listar_productos') ?>" class="btn btn-success">Volver</a>
        </div>
    </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped w-100">
            <thead class="header-tabla">
                <tr class="test1">
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaProductos">
                <?php foreach ($producto as $prod): ?>
                    <?php if ($prod['eliminado'] !== 'NO'): ?> <!-- Aplica el filtro en la vista -->
                        <tr class="test1">
                            <td><?= $prod['id'] ?></td>
                            <td class="nombre-producto"><?= $prod['nombre_prod'] ?></td>
                            <td class="text-center align-middle">
                                <img src="<?= base_url('assets/uploads/' . $prod['imagen']) ?>" alt="Imagen Producto" class="img-fluid" style="width: 100px; height: auto;">
                            </td>
                            <td><?= $prod['categoria_id'] ?></td>
                            <td>$<?= number_format($prod['precio'], 2) ?></td>
                            <td><?= $prod['stock'] ?></td>
                            <td>
                                <a href="<?= base_url('activar_producto/' . $prod['id']) ?>" class="btn btn-warning btn-sm">Activar</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
