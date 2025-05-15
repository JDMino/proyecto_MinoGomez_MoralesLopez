<div class="login-form">
    <h2 class="header-sections">Iniciar sesión</h2>
    <form action="<?= base_url('enviar-login') ?>" method="POST">
        <input type="email" placeholder="Correo electrónico" required>
        <input type="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</div>
