
<h2 class="header-sections">Editar Producto</h2>
    
<?php if(session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form action="<?= base_url('actualizar-producto/'.$producto['id']) ?>" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre_prod" value="<?= $producto['nombre_prod'] ?>" required><br>

    <label>Imagen:</label>
    <input type="file" name="imagen"><br>
    <img src="<?= base_url('assets/uploads/'.$producto['imagen']) ?>" width="100"><br>

    <label>Categoría:</label>
    <select name="categoria_id">
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $producto['categoria_id']) ? 'selected' : '' ?>>
                <?= $categoria['descripcion'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Precio:</label>
    <input type="number" name="precio" value="<?= $producto['precio'] ?>" required><br>

    <label>Precio de Venta:</label>
    <input type="number" name="precio_vta" value="<?= $producto['precio_vta'] ?>" required><br>

    <label>Stock:</label>
    <input type="number" name="stock" value="<?= $producto['stock'] ?>" required><br>

    <label>Stock Mínimo:</label>
    <input type="number" name="stock_min" value="<?= $producto['stock_min'] ?>" required><br>

    <button type="submit">Actualizar Producto</button>
    <a href="<?= base_url('listar_productos') ?>" class="btn btn-danger">Cancelar</a>
</form>

