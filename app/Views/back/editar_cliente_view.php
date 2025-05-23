
<h2 class="header-sections">Editar Cliente</h2>
    
<?php if(session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form action="<?= base_url('actualizar-cliente/'.$usuario['id_usuario']) ?>" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br>

    <label>Apellido:</label>
    <input type="text" name="apellido" value="<?= $usuario['apellido'] ?>" required><br>

    <label>Usuario:</label>
    <input type="text" name="usuario" value="<?= $usuario['usuario'] ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br>

    <button type="submit">Actualizar usuario</button>
    <a href="<?= base_url('listar_clientes') ?>" class="btn btn-danger">Cancelar</a>
</form>

