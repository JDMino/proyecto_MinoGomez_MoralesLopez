
    <div>
        <h2 class="header-sections titulo-HeaderSections"><?= $titulo ?></h2>
        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?= base_url('enviar-form') ?>" method="post" class="form-registro">
            <?=csrf_field();?>
            <!--Error-->
            <?php if(!empty (session()->getFlashdata('fail'))):?>
            <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
            <?php endif?>
            <!--Exitoso-->
            <?php if(!empty (session()->getFlashdata('success'))):?>
            <div class="alert alert-success" role="alert"><?=session()->getFlashdata('success');?></div>
            <?php endif?>
            
            <label for="nombre">Nombre:</label>
            <input class="input-registro" type="text" id="nombre" name="nombre" placeholder="Tu nombre"><br><br>
            <?php if($validation->getError('nombre')) {?>
                <div class="alert alert-danger mt-2">
                    <?= $error = $validation->getError('nombre');?>
            </div>
            <?php }?>
            <label for="apellido">Apellido:</label>
            <input class="input-registro" type="text" id="apellido" name="apellido" placeholder="Tu apellido" required><br><br>
             <?php if($validation->getError('apellido')) {?>
                <div class="alert alert-danger mt-2">
                    <?= $error = $validation->getError('apellido');?>
            </div>
            <?php }?>
            <label for="email">Email:</label>
            <input class="input-registro" type="email" id="email" name="email"placeholder="Tu email" required><br><br>
             <?php if($validation->getError('email')) {?>
                <div class="alert alert-danger mt-2">
                    <?= $error = $validation->getError('email');?>
            </div>
            <?php }?>
            <label for="usuario">Usuario:</label>
            <input class="input-registro" type="text" id="usuario" name="usuario"placeholder="Tu usuario" required><br><br>
             <?php if($validation->getError('usuario')) {?>
                <div class="alert alert-danger mt-2">
                    <?= $error = $validation->getError('usuario');?>
            </div>
            <?php }?>

            <label for="pass">Contraseña:</label>
            <input class="input-registro" type="password" id="pass" name="pass" placeholder="Tu contraseña" required><br><br>
             <?php if($validation->getError('pass')) {?>
                <div class="alert alert-danger mt-2">
                    <?= $error = $validation->getError('pass');?>
            </div>
            <?php }?>
            <input class="button-registro" type="submit" value="Registrarse">
        </form>
    </div>