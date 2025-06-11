<h2 class="header-sections titulo-HeaderSections">Historial de Compras</h2>    
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead class="table-success text-center">
                <tr>
                    <th>Fecha</th>
                    <th>Total Venta</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody class="table-dark text-center">
                <?php 
                $ventasAgrupadas = [];
                foreach ($compras as $compra) {
                    $ventasAgrupadas[$compra['id_ventas_cabecera']]['fecha'] = $compra['fecha'];
                    $ventasAgrupadas[$compra['id_ventas_cabecera']]['total_venta'] = $compra['total_venta'];
                    $ventasAgrupadas[$compra['id_ventas_cabecera']]['productos'][] = $compra;
                }
                ?>
                <?php foreach ($ventasAgrupadas as $venta): ?>
                    <tr>
                        <td rowspan="<?= count($venta['productos']) ?>"><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                        <td rowspan="<?= count($venta['productos']) ?>">$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                        <?php foreach ($venta['productos'] as $index => $producto): ?>
                            <?php if ($index > 0): ?><tr><?php endif; ?>
                            <td>
                                <img src="<?= base_url('assets/uploads/'.$producto['imagen']) ?>" alt="<?= $producto['nombre_prod'] ?>" class="w-50">
                            </td>
                            <td><strong><?= $producto['nombre_prod'] ?></strong> (<?= $producto['marca'] ?>)</td>
                            <td><?= $producto['cantidad'] ?> unidades</td>
                            <td>$<?= number_format($producto['precio'], 2, ',', '.') ?></td>
                            <?php if ($index > 0): ?></tr><?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
