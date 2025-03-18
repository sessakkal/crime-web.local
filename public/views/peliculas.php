<?php require __DIR__ . '/header.php'; ?>

<div class="container col-8 mt-4">
    <h1 class="mb-4">Películas de Crimen</h1>

    <?php
    // Obtener todas las películas sin paginación
    $peliculas = $conn->query("SELECT * FROM Peliculas");
    if (!$peliculas) {
        die("Error en la consulta: " . $conn->error);
    }
    $peliculas = $peliculas->fetch_all(MYSQLI_ASSOC);
    ?>

    <div class="row">
        <?php foreach ($peliculas as $pelicula): ?>
            <div class="col-md-4 mb-4">
                <a href="/pelicula/<?= $pelicula['id'] ?>" class="text-decoration-none">
                    <div class="card bg-black text-light">
                        <img src="<?= $pelicula['imagen_url'] ?>" class="card-img-top" alt="<?= $pelicula['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"> <?= $pelicula['titulo'] ?> </h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>