
<h2 class="header-sections">Editar Usuario</h2>
    
<?php if(session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form action="<?= base_url('actualizar-usuario/'.$usuario['id_usuario']) ?>" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br>

    <label>Apellido:</label>
    <input type="text" name="apellido" value="<?= $usuario['apellido'] ?>" required><br>

    <label>Usuario:</label>
    <input type="text" name="usuario" value="<?= $usuario['usuario'] ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br>

    <label for="perfil_id" class="form-label crud-label">Tipo Perfil</label>
        <select class="form-select crud-form-select" id="perfil_id" name="perfil_id">
                <?php foreach ($perfiles as $perfil): ?>
                    <option value="<?= $perfil['id_perfil'] ?>" <?= ($perfil['id_perfil'] == $usuario['perfil_id']) ? 'selected' : '' ?>>
                        <?= $perfil['descripcion'] ?>
                    </option>
                <?php endforeach; ?>
        </select>

    <button type="submit">Actualizar usuario</button>
    <a href="<?= base_url('listar_usuarios') ?>" class="btn btn-danger">Cancelar</a>
</form>

