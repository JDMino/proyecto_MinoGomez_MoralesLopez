 
<?php if(!empty(session()->getFlashdata('error'))): ?>
    <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
<div class="container mt-5">
    <h2 class="header-sections titulo-HeaderSections text-center"><?= $titulo ?></h2>

    <div class="card crud-card shadow p-4">
        <form action="<?= base_url('actualizar-producto/'.$producto['id']) ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nombre_prod" class="form-label crud-label">Nombre del Producto</label>
                <input type="text" class="form-control crud-form-control" id="nombre_prod" name="nombre_prod" value="<?= $producto['nombre_prod'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label crud-label">Marca del Producto</label>
                <input type="text" class="form-control crud-form-control" id="marca" name="marca" value="<?= $producto['marca'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label crud-label">Imagen del Producto</label>
                <input type="file" class="form-control file-upload" id="imagen" name="imagen" accept="image/*">
                <img src="<?= base_url('assets/uploads/'.$producto['imagen']) ?>" width="100" class="mt-2">
            </div>

            <div class="mb-3">
                <label for="categoria_id" class="form-label crud-label">Categoría</label>
                <select class="form-select crud-form-select" id="categoria_id" name="categoria_id">
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $producto['categoria_id']) ? 'selected' : '' ?>>
                            <?= $categoria['descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label crud-label">Precio</label>
                <input type="number" step="0.01" class="form-control crud-form-control" id="precio" name="precio" value="<?= $producto['precio'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="precio_vta" class="form-label crud-label">Precio de Venta</label>
                <input type="number" step="0.01" class="form-control crud-form-control" id="precio_vta" name="precio_vta" value="<?= $producto['precio_vta'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label crud-label">Stock</label>
                <input type="number" class="form-control crud-form-control" id="stock" name="stock" value="<?= $producto['stock'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock_min" class="form-label crud-label">Stock Mínimo</label>
                <input type="number" class="form-control crud-form-control" id="stock_min" name="stock_min" value="<?= $producto['stock_min'] ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-crud btn-success">Actualizar Producto</button>
                <a href="<?= base_url('listar_productos') ?>" class="btn btn-crud btn-danger">Cancelar</a>
            </div>

        </form>
    </div>
</div>
