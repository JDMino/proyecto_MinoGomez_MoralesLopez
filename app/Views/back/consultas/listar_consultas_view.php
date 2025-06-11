<h2 class="header-sections titulo-HeaderSections"><?= $titulo ?></h2>

<?php if(!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php elseif(!empty(session()->getFlashdata('error'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
<?php endif ?>

<div class="container lista-consultas">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarConsulta" class="form-control w-25" placeholder="Buscar consulta...">
    </div>

    <div class="table-responsive">
        <table class="table table-success table-bordered border-light table-striped table-hover w-100">
            <thead class="header-tabla">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Mensaje</th>
                    <th>Respuesta</th> <!-- Columna para estado -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaConsultas">
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <td><?= $consulta['id_consulta'] ?></td>
                        <td class="nombre-consulta"><?= $consulta['nombre'] ?></td>
                        <td class="apellido-consulta"><?= $consulta['apellido'] ?></td>
                        <td class="email-consulta"><?= $consulta['email'] ?></td>
                        <td class="telefono-consulta"><?= $consulta['telefono'] ?></td>
                        <td class="mensaje-consulta"><?= $consulta['mensaje'] ?></td>
                        <td class="respuesta-consulta">
                            <?= empty($consulta['respuesta']) ? '<span class="text-danger">❌ No respondida</span>' : '<span class="text-success">✔️ Respondida</span>' ?>
                        </td>
                        <td>
                            <?php if(empty($consulta['respuesta'])): ?>
                                <a href="<?= base_url('responder_consulta/' . $consulta['id_consulta']) ?>" class="btn btn-crud btn-primary btn-sm">Responder</a>
                            <?php else: ?>
                                <a href="<?= base_url('eliminar_consulta/' . $consulta['id_consulta']) ?>" class="btn btn-crud btn-danger btn-sm">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
