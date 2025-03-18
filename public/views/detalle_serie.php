<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-4">
    <?php
    $id = explode('/', $_SERVER['REQUEST_URI'])[2];
    $serie = $conn->query("SELECT * FROM Series WHERE id = $id")->fetch_assoc();
    if ($serie):
    ?>
        <div class="card bg-black text-light">
            <img src="<?= $serie['imagen_url'] ?>" class="card-img-top" alt="<?= $serie['titulo'] ?>">
            <div class="card-body">
                <h1 class="card-title"><?= $serie['titulo'] ?></h1>
                <p class="card-text"><?= $serie['descripcion'] ?></p>
                <a href="/series" class="btn btn-danger">Volver</a>
            </div>
        </div>
    <?php else: ?>
        <p>Serie no encontrada.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>