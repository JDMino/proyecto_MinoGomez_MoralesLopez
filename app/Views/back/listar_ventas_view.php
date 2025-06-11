<h2 class="header-sections">Historial de Ventas</h2>    

<!-- Panel de filtros -->
<div class="card p-3 mb-3 filtro">
    <h4 class="text-center titulo-filtro">Filtrar Ventas</h4>
    <form method="GET" action="<?= base_url('listar_ventas') ?>">
        <div class="row">
            <div class="col-md-4">
                <label for="usuario_id" class="form-label label-filtro">Usuario:</label>
                <select name="usuario_id" id="usuario_id" class="form-control form-filtro">
                    <option value="">Todos</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id_usuario'] ?>" <?= (isset($_GET['usuario_id']) && $_GET['usuario_id'] == $usuario['id_usuario']) ? 'selected' : '' ?>>
                            <?= $usuario['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="fecha_inicio" class="form-label label-filtro">Fecha inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-filtro" value="<?= $_GET['fecha_inicio'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label for="fecha_fin" class="form-label label-filtro">Fecha fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-filtro" value="<?= $_GET['fecha_fin'] ?? '' ?>">
            </div>
            
            <div class="col-md-3 text-center mt-3">
                <button type="submit" class="btn btn-filtro">Aplicar Filtros</button>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de ventas -->
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark text-center">
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Total Venta</th>
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
                foreach ($ventas as $venta) {
                    $ventasAgrupadas[$venta['id_ventas_cabecera']]['fecha'] = $venta['fecha'];
                    $ventasAgrupadas[$venta['id_ventas_cabecera']]['usuario'] = $venta['usuario'];
                    $ventasAgrupadas[$venta['id_ventas_cabecera']]['total_venta'] = $venta['total_venta'];
                    $ventasAgrupadas[$venta['id_ventas_cabecera']]['productos'][] = $venta;
                }

                // Definir colores alternos
                    $colores = ['table-info', 'table-secondary'];
                    ?>


                <?php foreach ($ventasAgrupadas as $venta): ?>
                    <?php $rowClass = $colores[$contador % 2]; $contador++; ?>
                    <tr class="<?= $rowClass ?>">
                        <td rowspan="<?= count($venta['productos']) ?>"><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                        <td rowspan="<?= count($venta['productos']) ?>"><?= $venta['usuario'] ?></td>
                        <td rowspan="<?= count($venta['productos']) ?>">$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                        <?php foreach ($venta['productos'] as $index => $producto): ?>
                            <?php if ($index > 0): ?><tr class="<?= $rowClass ?>"><?php endif; ?>
                            <td>
                                <img src="<?= base_url('assets/uploads/'.$producto['imagen']) ?>" alt="<?= $producto['nombre_prod'] ?>" class="w-25">
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

    <!-- Total de ventas -->
    <div class="total-ventas text-end">
        <h4>Total de Ventas: <strong>$<?= number_format($total_ventas, 2, ',', '.') ?></strong></h4>
    </div>
</div>
