
<?php if(!empty(session()->getFlashdata('error'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>
<div class="container mt-5">
    <h2 class="header-sections titulo-HeaderSections text-center"><?= $titulo ?></h2>

    <div class="card crud-card shadow p-4">
        <form action="<?= base_url('actualizar-usuario/'.$usuario['id_usuario']) ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nombre" class="form-label crud-label">Nombre</label>
                <input type="text" class="form-control crud-form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label crud-label">Apellido</label>
                <input type="text" class="form-control crud-form-control" id="apellido" name="apellido" value="<?= $usuario['apellido'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label crud-label">Usuario</label>
                <input type="text" class="form-control crud-form-control" id="usuario" name="usuario" value="<?= $usuario['usuario'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label crud-label">Email</label>
                <input type="email" class="form-control crud-form-control" id="email" name="email" value="<?= $usuario['email'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="perfil_id" class="form-label crud-label">Tipo de Perfil</label>
                <select class="form-select crud-form-select" id="perfil_id" name="perfil_id">
                    <?php foreach ($perfiles as $perfil): ?>
                        <option value="<?= $perfil['id_perfil'] ?>" <?= ($perfil['id_perfil'] == $usuario['perfil_id']) ? 'selected' : '' ?>>
                            <?= $perfil['descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-crud btn-success">Actualizar Usuario</button>
                <a href="<?= base_url('listar_usuarios') ?>" class="btn btn-crud btn-danger">Cancelar</a>
            </div>

        </form>
    </div>
</div>


