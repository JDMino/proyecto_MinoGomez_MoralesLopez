<h2 class="header-sections titulo-HeaderSections">Historial de Consultas Eliminadas</h2>

<?php if (!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php elseif (!empty(session()->getFlashdata('error'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
<?php endif ?>

<div class="container lista-consultas">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarConsultaEliminada" class="form-control w-25" placeholder="Buscar consulta...">
    </div>
    <div>
        <a href="<?= base_url('listar_consultas') ?>" class="btn btn-crud btn-success">Volver</a>
    </div>

    <div class="table-responsive">
        <table class="table table-danger table-bordered border-light table-striped table-hover w-100">
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
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaConsultasEliminadas">
                <?php foreach ($consultas as $consulta): ?>
                    <?php if ($consulta['estado'] === 'CONSULTA ELIMINADA'): ?>
                        <tr>
                            <td><?= $consulta['id_consulta'] ?></td>
                            <td><?= $consulta['nombre'] ?></td>
                            <td><?= $consulta['apellido'] ?></td>
                            <td><?= $consulta['email'] ?></td>
                            <td><?= $consulta['telefono'] ?></td>
                            <td><?= $consulta['mensaje'] ?></td>
                            <td><span class="text-danger"><?= $consulta['estado'] ?></span></td>
                            <td><?= !empty($consulta['respuesta']) ? htmlspecialchars($consulta['respuesta']) : 'Sin respuesta' ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let inputBuscar = document.getElementById("buscarConsultaEliminada");
        let tablaConsultas = document.getElementById("tablaConsultasEliminadas");

        inputBuscar.addEventListener("keyup", function () {
            let filtro = inputBuscar.value.toLowerCase();
            let filas = tablaConsultas.getElementsByTagName("tr");

            for (let fila of filas) {
                let nombre = fila.querySelector("td:nth-child(2)").textContent.toLowerCase();
                let apellido = fila.querySelector("td:nth-child(3)").textContent.toLowerCase();
                let email = fila.querySelector("td:nth-child(4)").textContent.toLowerCase();
                let telefono = fila.querySelector("td:nth-child(5)").textContent.toLowerCase();

                if (nombre.includes(filtro) || apellido.includes(filtro) || email.includes(filtro) || telefono.includes(filtro)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            }
        });
    });
</script>
