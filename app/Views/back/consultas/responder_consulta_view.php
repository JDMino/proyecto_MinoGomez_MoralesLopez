<div class="container mt-5">
    <h2 class="header-sections titulo-HeaderSections text-center">Responder Consulta</h2>
    <div class="card crud-card shadow p-5">
        <div class="card-body">
            <h5 class="fw-bold">Consulta de <?= $consulta['nombre'] ?> <?= $consulta['apellido'] ?></h5>
            
            <p><strong>Email:</strong> <?= $consulta['email'] ?></p>
            <p><strong>Teléfono:</strong> <?= $consulta['telefono'] ?></p>
            <p><strong>Mensaje:</strong> <?= $consulta['mensaje'] ?></p>

            <form action="<?= base_url('guardar_respuesta/' .$consulta['id_consulta']) ?>" method="POST">
                <input type="hidden" name="id_consulta" value="<?= $consulta['id_consulta'] ?>">

                <div class="mb-3">
                    <label for="respuesta" class="form-label crud-label">Respuesta</label>
                    <textarea class="form-control crud-form-control" name="respuesta" id="respuesta" rows="4" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-crud btn-success">Guardar Respuesta</button>
                    <a href="<?= base_url('listar_consultas') ?>" class="btn btn-crud btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
