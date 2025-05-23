<h2 class="header-sections">Clientes Eliminados</h2>
<?php if(!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php endif ?>

<div class="container lista-productos">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscarCliente" class="form-control w-25" placeholder="Buscar cliente...">
        <div>
            <a href="<?= base_url('listar_clientes') ?>" class="btn btn-success">Volver</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped w-100">
            <thead class="header-tabla">
                <tr class="test1">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Baja</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="body-tabla" id="tablaClientes">
                <?php foreach ($clientes as $cliente): ?>
                    <?php if ($cliente['baja'] === 'SI' && $cliente['perfil_id'] != 1): ?>
                        <tr class="">
                            <td><?= $cliente['id_usuario'] ?></td>
                            <td class="nombre-cliente"><?= $cliente['nombre'] ?></td>
                            <td class="apellido-cliente"><?= $cliente['apellido'] ?></td>
                            <td class="usuario-cliente"><?= $cliente['usuario'] ?></td>
                            <td class="email-cliente"><?= $cliente['email'] ?></td>
                            <td class="baja-cliente"><?= $cliente['baja'] ?></td>
                            <td>
                                <a href="<?= base_url('editar_cliente/' . $cliente['id_usuario']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?= base_url('activar_cliente/' . $cliente['id_usuario']) ?>" class="btn btn-success btn-sm">Dar de alta</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
