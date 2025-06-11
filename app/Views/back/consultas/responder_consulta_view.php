<h2 class="header-sections titulo-HeaderSections">Responder Consulta</h2>

<div class="container responder-consulta">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Consulta de <?= $consulta['nombre'] ?> <?= $consulta['apellido'] ?></h5>
            <p class="card-text"><strong>Email:</strong> <?= $consulta['email'] ?></p>
            <p class="card-text"><strong>Teléfono:</strong> <?= $consulta['telefono'] ?></p>
            <p class="card-text"><strong>Mensaje:</strong> <?= $consulta['mensaje'] ?></p>

            <form action="<?= base_url('guardar_respuesta') ?>" method="POST">
                <input type="hidden" name="id_consulta" value="<?= $consulta['id_consulta'] ?>">
                
                <label for="respuesta" class="form-label">Respuesta:</label>
                <textarea class="form-control" name="respuesta" id="respuesta" rows="4" required></textarea>
                
                <button type="submit" class="btn btn-primary mt-2">Guardar Respuesta</button>
            </form>
        </div>
    </div>
</div>
