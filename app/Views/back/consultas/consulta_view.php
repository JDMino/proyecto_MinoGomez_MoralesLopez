<div class="formulario-contacto">
       <?php $validation = \Config\Services::validation(); ?>
            <!--Exitoso-->
            <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success" role="alert"><?=session()->getFlashdata('success');?></div>
            <?php endif?>
    <h2>Envíanos un mensaje</h2>
    <form action="<?= base_url('enviar-consulta') ?>" method="POST" class="form-container">
        <label for="nombre" class="label-contacto">Nombre:</label>
        <input class="input-contacto" type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>

        <label for="apellido" class="label-contacto">Apellido:</label>
        <input class="input-contacto" type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>

        <label for="email" class="label-contacto">Correo electrónico:</label>
        <input class="input-contacto" type="email" id="email" name="email" placeholder="Tu correo electrónico" required>

        <label for="telefono" class="label-contacto">Telefono:</label>
        <input class="input-contacto" type="number" id="telefono" name="telefono" placeholder="Tu telefono" required>

        <label for="mensaje" class="label-contacto">Mensaje:</label>
         <textarea class="text-contacto" id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí" rows="5" required></textarea>

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="button-contacto">Enviar</button>
            <button type="button" class="button-contacto limpiar-btn">Limpiar</button>
        </div>
    </form>
</div>

<script src="assets\js\botonReiniciarCampos.js"></script>