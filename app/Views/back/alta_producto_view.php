    <div class="container mt-5">
        <h2 class="header-sections titulo-HeaderSections text-center">Alta de Producto</h2>

        <div class="card crud-card shadow p-4">
            <form action="<?= base_url('guardar-producto') ?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="nombre_prod" class="form-label crud-label">Nombre del Producto</label>
                    <input type="text" class="form-control crud-form-control" id="nombre_prod" name="nombre_prod" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label crud-label">Imagen del Producto</label>
                    <input type="file" class="form-control crud-form-control" id="imagen" name="imagen" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label crud-label">Categoría</label>
                    <select class="form-select crud-form-select" id="categoria_id" name="categoria_id" required>
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['descripcion'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label crud-label">Precio</label>
                    <input type="number" step="0.01" class="form-control crud-form-control" id="precio" name="precio" required>
                </div>

                <div class="mb-3">
                    <label for="precio_vta" class="form-label crud-label">Precio de Venta</label>
                    <input type="number" step="0.01" class="form-control crud-form-control" id="precio_vta" name="precio_vta" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label crud-label">Stock</label>
                    <input type="number" class="form-control crud-form-control" id="stock" name="stock" required>
                </div>

                <div class="mb-3">
                    <label for="stock_min" class="form-label crud-label">Stock Mínimo</label>
                    <input type="number" class="form-control crud-form-control" id="stock_min" name="stock_min" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-crud btn-success">Guardar Producto</button>
                    <a href="<?= base_url('listar_productos') ?>" class="btn btn-crud btn-danger">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

