<div class="container-fluid" id="venta">
    <div class="sale">
        <div class="heading">
            <h2 class="text-center header-sections">Resumen de Venta</h2>
        </div>

        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th>IMAGEN</th>
                    <th>PRODUCTO</th>
                    <th>PRECIO UNITARIO</th>
                    <th>CANTIDAD</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $gran_total = 0; ?>
                
                <?php foreach ($cart as $item): ?>
                    <?php $subtotal = $item['price'] * $item['qty']; ?>
                    <?php $gran_total += $subtotal; ?>

                    <tr class="table-success">
                        <td><img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" width="80" height="80"></td>
                        <td><?= esc($item['name']) ?></td>
                        <td>$ <?= number_format($item['price'], 2) ?></td>
                        <td><?= number_format($item['qty']) ?></td>
                        <td>$ <?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>

                <tr class="table-light">
                    <td colspan="4"><strong>Total de Venta:</strong></td>
                    <td><strong>$ <?= number_format($gran_total, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-end mt-3">
            
            <a class="btn btn-secondary btn-lg" href="<?= base_url('/') ?>">Volver al Inicio</a>
        </div>
    </div>
</div>
