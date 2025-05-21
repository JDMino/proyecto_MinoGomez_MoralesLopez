    <div class="container mt-5">
        <h2 class="header-sections text-center">Alta de Producto</h2>

        <div class="card shadow p-4">
            <form action="<?= base_url('guardar-producto') ?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="nombre_prod" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombre_prod" name="nombre_prod" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen del Producto</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select class="form-select" id="categoria_id" name="categoria_id" required>
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['descripcion'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                </div>

                <div class="mb-3">
                    <label for="precio_vta" class="form-label">Precio de Venta</label>
                    <input type="number" step="0.01" class="form-control" id="precio_vta" name="precio_vta" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>

                <div class="mb-3">
                    <label for="stock_min" class="form-label">Stock Mínimo</label>
                    <input type="number" class="form-control" id="stock_min" name="stock_min" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Guardar Producto</button>
                    <a href="<?= base_url('listar_productos') ?>" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

