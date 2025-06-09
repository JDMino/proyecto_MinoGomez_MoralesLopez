
<h2 class="header-sections">Lista de Compras</h2>    
    <div class="container">
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Total Venta</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta):?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($venta['fecha'])) ?></td>
                        <td><?= number_format($venta['total_venta'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>