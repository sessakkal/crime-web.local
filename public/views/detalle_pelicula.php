<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-4">
    <?php
    $id = explode('/', $_SERVER['REQUEST_URI'])[2];
    $pelicula = $conn->query("SELECT * FROM Peliculas WHERE id = $id")->fetch_assoc();
    if ($pelicula):
    ?>
        <div class="card bg-black text-light">
            <img src="<?= $pelicula['imagen_url'] ?>" class="card-img-top" alt="<?= $pelicula['titulo'] ?>">
            <div class="card-body">
                <h1 class="card-title"><?= $pelicula['titulo'] ?></h1>
                <p class="card-text"><?= $pelicula['descripcion'] ?></p>
                <a href="/peliculas" class="btn btn-danger">Volver</a>
            </div>
        </div>
    <?php else: ?>
        <p>Película no encontrada.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>