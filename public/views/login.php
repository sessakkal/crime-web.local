<?php require __DIR__ . '/header.php'; ?>

<div class="container">
    <div class="d-flex min-vh-100">
        <div class="row d-flex flex-grow-1 justify-content-center align-items-center">
            <div class="col-md-4 form login-form">
                <form action="../login.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Inicio de sesión</h2>

                    <?php
                    if (isset($errors) && count($errors) > 0) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                        echo "</div>";
                    }
                    ?>

                    <div class="form-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" name="login_button" class="form-control btn btn-danger" value="Acceder">
                    </div>
                    <p class="text-center">¿No tienes cuenta? <a href="/registro" class="text-danger">Regístrate aquí</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
