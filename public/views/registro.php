<?php require __DIR__ . '/header.php'; ?>

<main>
    <div class="container">
        <h1>Registro</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form action="/registro" method="POST">
            <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión</a></p>
    </div>
</main>

<?php require __DIR__ . '/footer.php'; ?>