<div class="login-container">
    <h2 class="header-sections titulo-HeaderSections">Iniciar sesión</h2>
    <form action="<?= base_url('enviar-login') ?>" method="POST" class="form-login">

     <label for="email">Email:</label>
        <input class="input-login" type="email" name ="email" placeholder="Correo electrónico" required>
        <label for="pass">Contraseña:</label>
        <input class="input-login" type="password" name="pass" placeholder="Contraseña" required>
        <button class="button-login" type="submit">Entrar</button>
      <!--Error-->
        <?php if(!empty (session()->getFlashdata('msg'))):?>
            <div class="alert alert-danger" role="alert"><?=session()->getFlashdata('msg');?></div>
            <?php endif?>
    </form>
</div>
