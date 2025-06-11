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
        <table class="table table-success table-bordered border-light table-striped table-hover w-100">
            <thead class="header-tabla">
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
                    <?php if ($consulta['estado'] !== 'CONSULTA ELIMINADA'): ?> <!-- Filtra las consultas eliminadas -->
                    <tr>
                        <td><?= $consulta['id_consulta'] ?></td>
                        <td><?= $consulta['nombre'] ?></td>
                        <td><?= $consulta['apellido'] ?></td>
                        <td><?= $consulta['email'] ?></td>
                        <td><?= $consulta['telefono'] ?></td>
                        <td><?= $consulta['mensaje'] ?></td>
                        <td><?= $consulta['estado'] ?></td>
                        <td>
                            <?= !empty($consulta['respuesta']) ? htmlspecialchars($consulta['respuesta']) : 'Pendiente' ?>
                        </td>
                        <td>
                            <?php if (empty($consulta['respuesta'])): ?>
                                <a href="<?= base_url('responder_consulta/' . $consulta['id_consulta']) ?>" class="btn btn-primary btn-sm">Responder</a>
                            <?php elseif (!empty($consulta['respuesta'])): ?>
                                <a href="<?= base_url('eliminar_consulta/' . $consulta['id_consulta']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let inputBuscar = document.getElementById("buscarConsulta");
        let tablaConsultas = document.getElementById("tablaConsultas").getElementsByTagName("tr");

        inputBuscar.addEventListener("keyup", function () {
            let filtro = inputBuscar.value.toLowerCase();

            for (let fila of tablaConsultas) {
                let id = fila.cells[0].textContent.toLowerCase();
                let nombre = fila.cells[1].textContent.toLowerCase();
                let apellido = fila.cells[2].textContent.toLowerCase();
                let email = fila.cells[3].textContent.toLowerCase();
                let telefono = fila.cells[4].textContent.toLowerCase();
                let mensaje = fila.cells[5].textContent.toLowerCase();

                if (id.includes(filtro) || nombre.includes(filtro) || apellido.includes(filtro) || email.includes(filtro) || telefono.includes(filtro) || mensaje.includes(filtro)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            }
        });
    });
</script>

