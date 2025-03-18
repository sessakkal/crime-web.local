<?php require __DIR__ . '/header.php'; ?>

<main>
    <div class="container">
        <h1>Iniciar sesión</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form action="/login" method="POST">
            <input type="text" name="nombre_usuario" placeholder="Nombre de usuario o correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>

        <p>¿No tienes una cuenta? <a href="/registro">Regístrate</a></p>
    </div>
</main>

<?php require __DIR__ . '/footer.php'; ?>