<h2 class="header-sections titulo-HeaderSections">Historial de Compras</h2>

<!-- Panel de filtros -->
<div class="card p-3 mb-3 filtro">
    <h4 class="text-center titulo-filtro">Filtrar Compras</h4>
    <form method="GET" action="<?= base_url('listar_compras/' . $_SESSION['id_usuario']) ?>">
        <div class="row">
            <div class="col-md-6">
                <label for="fecha_inicio" class="form-label label-filtro">Fecha inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-filtro" value="<?= $_GET['fecha_inicio'] ?? '' ?>">
            </div>
            <div class="col-md-6">
                <label for="fecha_fin" class="form-label label-filtro">Fecha fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-filtro" value="<?= $_GET['fecha_fin'] ?? '' ?>">
            </div>
             <div class="col-12 d-flex justify-content-center mt-3">
                <div class="me-2 text-center">
                    <label for="total_inicio" class="form-label label-filtro">Total Compra mínimo:</label>
                    <input type="number" name="total_inicio" id="total_inicio" class="form-control form-filtro campo-pequeno" value="<?= $_GET['total_inicio'] ?? '' ?>">
                </div>

                <div class="ms-2 text-center">
                    <label for="total_fin" class="form-label label-filtro">Total Compra máximo:</label>
                    <input type="number" name="total_fin" id="total_fin" class="form-control form-filtro campo-pequeno" value="<?= $_GET['total_fin'] ?? '' ?>">
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-filtro">Aplicar Filtros</button>
                <a href="<?= base_url('listar_compras/' . $_SESSION['id_usuario']) ?>" class="btn btn-danger btn-crud ms-2">Limpiar Filtros</a>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de compras -->
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark text-center">
                <tr>
                    <th>Fecha</th>
                    <th>Total Compra</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php  
                    $ventasAgrupadas = [];
                    $contador = 0;
                    foreach ($compras as $compra) {
                        $ventasAgrupadas[$compra['id_ventas_cabecera']]['fecha'] = $compra['fecha'];
                        $ventasAgrupadas[$compra['id_ventas_cabecera']]['total_venta'] = $compra['total_venta'];
                        $ventasAgrupadas[$compra['id_ventas_cabecera']]['productos'][] = $compra;
                    }

                    $colores = ['table-info', 'table-secondary'];
                ?>

                <?php foreach ($ventasAgrupadas as $venta): ?>
                    <?php $rowClass = $colores[$contador % 2]; $contador++; ?>
                    <tr class="<?= $rowClass ?>">
                        <td rowspan="<?= count($venta['productos']) ?>"><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                        <td rowspan="<?= count($venta['productos']) ?>">$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                        <?php foreach ($venta['productos'] as $index => $producto): ?>
                            <?php if ($index > 0): ?><tr class="<?= $rowClass ?>"><?php endif; ?>
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