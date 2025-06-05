<div class="container-fluid" id="carrito">
    <div class="cart">
        <div class="heading">
            <h2 class="text-center header-sections">Productos en tu Carrito</h2>
        </div>

        <!-- Mostrar mensaje Flash si existe -->
        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-warning alert-dismissible fade show mt-3 mx-3" role="alert">
                <?= session()->getFlashdata('mensaje') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <?php if (empty($cart)): ?>
            <p>Para agregar productos al carrito, hace clic en:</p>
            <a class="btn btn-warning text-dark mt-2" href="<?= base_url('catalogo') ?>">
                <i class="fa-solid fa-circle-chevron-left"></i> Volver al catálogo
            </a>
        <?php endif; ?>

        <?php if (!empty($cart)): ?>
            <form action="<?= base_url('actualizar_carrito') ?>" method="post">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>IMAGEN</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>TOTAL</th>
                            <th>Cancelar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $gran_total = 0; ?>
                        <?php foreach ($cart as $item): ?>
                            <?php $gran_total += $item['price'] * $item['qty']; ?>
                            
                            <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][id]" value="<?= esc($item['id']) ?>">
                            <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][rowid]" value="<?= esc($item['rowid']) ?>">
                            <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][name]" value="<?= esc($item['name']) ?>">
                            <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][price]" value="<?= esc($item['price']) ?>">
                            <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][qty]" value="<?= esc($item['qty']) ?>">
                            <input type="hidden" name="cart[<?= esc($item['rowid']) ?>][imagen]" value="<?= esc($item['imagen']) ?>">
                            
                            
                            <tr class="table-danger">
                                <td><img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" width="80" height="80"></td>
                                <td><?= esc($item['name']) ?></td>
                                <td>$ <?= number_format($item['price'], 2) ?></td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="<?= base_url('carrito_suma/' . $item['rowid']) ?>">+</a>
                                    <?= number_format($item['qty']) ?>
                                    <a class="btn btn-sm btn-danger" href="<?= base_url('carrito_resta/' . $item['rowid']) ?>">-</a>
                                </td>
                                <td>$ <?= number_format($item['price'] * $item['qty'], 2) ?></td>
                                <td><a href="<?= base_url('eliminar_item/' . $item['rowid']) ?>">Eliminar</a></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr class="table-light">
                            <td colspan="4"><strong>Total: $ <?= number_format($gran_total, 2) ?></strong></td>
                            <td colspan="2" class="text-end">
                                <input type="button" class="btn btn-primary btn-lg" value="Borrar Carrito" onclick="window.location='<?= base_url('eliminar_item/' . 'all') ?>'">
                                <input type="button" class="btn btn-secondary btn-lg" value="Comprar" onclick="window.location='<?= base_url('confirmar_compra') ?>'">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        <?php endif; ?>
    </div>
</div>