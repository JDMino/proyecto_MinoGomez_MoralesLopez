<h2 class="header-sections titulo-HeaderSections">Historial de Consultas Eliminadas</h2>

<?php if (!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php elseif (!empty(session()->getFlashdata('error'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
<?php endif ?>

<div class="container lista-consultas">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarConsulta" class="form-control w-25" placeholder="Buscar consulta...">
        <div>
        <a href="<?= base_url('listar_consultas') ?>" class="btn btn-crud btn-success">Volver</a>
    </div>
    </div>

    <div class="table-responsive">
        <table class="table table-success table-bordered border-light table-striped table-hover text-center w-100">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Mensaje</th>
                    <th>Estado</th>
                    <th>Respuesta</th>
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaConsultas">
                <?php foreach ($consultas as $consulta): ?>
                        <tr>
                            <td><?= $consulta['id_consulta'] ?></td>
                            <td><?= $consulta['nombre'] ?></td>
                            <td><?= $consulta['apellido'] ?></td>
                            <td><?= $consulta['email'] ?></td>
                            <td><?= $consulta['telefono'] ?></td>
                            <td><?= $consulta['mensaje'] ?></td>
                            <td><span class="badge bg-danger"><?= $consulta['estado'] ?></span></td>
                            <td><?= $consulta['respuesta'] ?></td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="assets\js\buscadorConsultas.js"></script>
