<h2 class="header-sections titulo-HeaderSections"><?= $titulo ?></h2>

<?php if (!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php elseif (!empty(session()->getFlashdata('error'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
<?php endif ?>

<div class="container lista-consultas">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarConsulta" class="form-control w-25" placeholder="Buscar consulta...">
        <div>
            <a href="<?= base_url('consultas_eliminadas') ?>" class="btn btn-crud btn-secondary ms-2">Eliminados</a>
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
                    <th>Acciones</th> <!-- Aparece solo si la consulta no tiene respuesta -->
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaConsultas">
                <?php foreach ($consultas as $consulta): ?>
                    <?php if ($consulta['estado'] !== 'CONSULTA ELIMINADA'): ?> <!-- Filtra las consultas no eliminadas -->
                    <tr>
                        <td><?= $consulta['id_consulta'] ?></td>
                        <td><?= $consulta['nombre'] ?></td>
                        <td><?= $consulta['apellido'] ?></td>
                        <td><?= $consulta['email'] ?></td>
                        <td><?= $consulta['telefono'] ?></td>
                        <td><?= $consulta['mensaje'] ?></td>
                        <td> <span class="badge bg-primary"> <?= $consulta['estado'] ?></span></td>
                        <td>
                            <?= !empty($consulta['respuesta']) ? htmlspecialchars($consulta['respuesta']) : 'Pendiente' ?>
                        </td>
                        <td>
                            <?php if (empty($consulta['respuesta'])): ?>
                                <a href="<?= base_url('responder_consulta/' . $consulta['id_consulta']) ?>" class="btn btn-warning btn-crud btn-sm">Responder</a>
                            <?php elseif (!empty($consulta['respuesta'])): ?>
                                <a href="<?= base_url('eliminar_consulta/' . $consulta['id_consulta']) ?>" class="btn btn-danger btn-crud btn-sm">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets\js\buscadorConsultas.js"></script>

