<!-- carrito_parte_view.php -->
<h2 class="header-sections titulo-HeaderSections">Carrito de Compras</h2>
<div class="container-fluid" id="carrito">
    <div class="cart">
        <div class="heading">
            <h2 id="h3" align="center">Productos en tu Carrito</h2>
        </div>
        <div class="text" align="center">
            <?php 
                $session = session();
                $cart = \Config\Services::cart();
                $cart = $cart->contents();
                // Si el carrito está vacío, mostrar el siguiente mensaje
                if (empty($cart)) {
                    echo 'Para agregar productos al carrito, click en '; ?>
                    <a href="<?= base_url('catalogo') ?>">Catalogo</a>
                <?php }
            ?>
        </div>
    </div>
    <table class="table table-hover table-dark table-responsive-md" border="0" cellpadding="5px" cellspacing="1px">
        <!-- (Opcional: también se podría usar una clase "table-striped") -->
        <?php 
            // Verifica si existen items en el carrito
            if ($cart == TRUE) : 
        ?>
        <div class="container">
            <div class="table-responsive-sm">
                <table class="table table-bordered table-hover table-dark table-striped ml-3">
                    <tr>
                        <td>ID</td>
                        <td>nombre_prod</td>
                        <td>Precio</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                        <td>Cancelar Producto</td>
                    </tr>
                    <?php 
                        // Se abre el formulario que enviará los datos a carrito_controller/actualiza
                        echo form_open('carrito_actualiza');
                        $gran_total = 0;
                        $i = 1;
                        foreach ($cart as $item) :
                            // Se crean campos ocultos para enviar la información de cada producto
                            // Se castea los valores numéricos a string para evitar TypeError.
                            echo form_hidden('cart[' . $item['id'] . '][id]', (string)$item['id']);
                            echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                            echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                            echo form_hidden('cart[' . $item['id'] . '][price]', (string)$item['price']);
                            echo form_hidden('cart[' . $item['id'] . '][qty]', (string)$item['qty']);
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td>$ <?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['qty']; ?></td>
                        <?php $gran_total += $item['price'] * $item['qty']; ?>
                        <td>$ <?php echo number_format($item['subtotal'], 2); ?></td>
                        <td>
                            <?php 
                                // Se define el ícono para borrar el producto
                                $path = '<img src="' . base_url('assets/img/carrito/carro.png') . '" width="25px" height="20px">';
                                echo anchor('eliminar_item/' . $item['rowid'], $path);
                            ?>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    ?>
                    <tr class="table-light">
                        <td colspan="5">
                            <b>Total: $ <?php echo number_format($gran_total, 2); ?></b>
                        </td>
                        <td colspan="5" align="center">
                            <!-- Botón para borrar el carrito (con confirmación javascript implementada en head_view) -->
                            <input type="button" class="btn btn-primary btn-1g" value="Borrar Carrito" onclick="window.location = '<?= base_url('eliminar_item/'. 'all');?>'">
                            <!-- Botón para confirmar la compra, redirigiendo a carrito-comprar -->
                            <input type="button" class="btn btn-primary btn-1g" value="Comprar" onclick="window.location = '#'">
                        </td>
                    </tr>
                    <?php echo form_close(); ?>
                </table>
            </div>
        </div>
        <?php endif; ?>
        <br>
    </table>
</div>
