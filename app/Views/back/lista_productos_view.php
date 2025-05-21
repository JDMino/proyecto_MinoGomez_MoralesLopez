<h2 class="header-sections">Lista de Productos</h2>
 <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success" role="alert"><?=session()->getFlashdata('success');?></div>
            <?php elseif(!empty (session()->getFlashdata('msj-eliminado'))):?>
            <div class="alert alert-danger" role="alert"><?=session()->getFlashdata('msj-eliminado');?></div>
            <?php endif?>
<div class="container lista-productos">
    <div class="d-flex justify-content-end mb-3">
        <a href="<?= base_url('agregar_producto') ?>" class="btn btn-success">Agregar</a>
        <a href="<?= base_url('productos_eliminados') ?>" class="btn btn-secondary ms-2">Eliminados</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped w-100">
            <thead class="header-tabla">
                <tr class="test1">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="body-tabla">
                <?php foreach ($producto as $prod): ?>
                    <?php if ($prod['eliminado'] !== 'SI'): ?> <!-- Aplica el filtro en la vista -->
                        <tr class="test1">
                            <td><?= $prod['id'] ?></td>
                            <td><?= $prod['nombre_prod'] ?></td>
                            <td class="text-center align-middle">
                                <img src="<?= base_url('assets/uploads/' . $prod['imagen']) ?>" alt="Imagen Producto" class="img-fluid" style="width: 100px; height: auto;">
                            </td>
                            <td><?= $prod['categoria_id'] ?></td>
                            <td>$<?= number_format($prod['precio'], 2) ?></td>
                            <td><?= $prod['stock'] ?></td>
                            <td>
                                <a href="<?= base_url('productos/editar/' . $prod['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?= base_url('eliminar_producto/' . $prod['id']) ?>" class="btn btn-danger btn-sm">Borrar</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
