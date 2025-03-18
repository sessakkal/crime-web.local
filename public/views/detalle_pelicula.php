<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-4">
    <?php
    // Obtener el ID de la URL
    $id = explode('/', $_SERVER['REQUEST_URI'])[2];

    // Obtener la película desde la base de datos
    $pelicula = $conn->query("SELECT * FROM Peliculas WHERE id = $id")->fetch_assoc();

    // Comprobar si la película fue encontrada
    if ($pelicula):
        $user_id = $_SESSION['user_id'];  // Obtener el ID del usuario actual

        // Verificar si el usuario ya ha marcado la película como vista
        $visto_query = "SELECT visto FROM vistas WHERE user_id = $user_id AND pelicula_id = $id";
        $visto_result = $conn->query($visto_query);
        $visto = ($visto_result && $visto_result->num_rows > 0) ? $visto_result->fetch_assoc()['visto'] : false;
    ?>
        <div class="pelicula-card bg-black text-light">
            <img src="<?= $pelicula['imagen_url'] ?>" class="card-img-top" alt="<?= $pelicula['titulo'] ?>">
            <div class="card-body">
                <h1 class="card-title"><?= $pelicula['titulo'] ?></h1>
                <p class="card-text"><?= $pelicula['descripcion'] ?></p>

                <!-- Formulario para marcar la película como vista o no vista -->
                <form action="/visto_pelicula.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="pelicula_id" value="<?= $pelicula['id'] ?>">
                    <button type="submit" class="btn btn-link" style="color: #fff;">
                        <i class="fas fa-eye<?= $visto ? '-slash' : '' ?>"></i> <?= $visto ? 'Marcada como vista' : 'Marcar como vista' ?>
                    </button>
                </form>

                <a href="/peliculas" class="btn btn-danger">Volver</a>
            </div>
        </div>
    <?php else: ?>
        <p>Película no encontrada.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>
