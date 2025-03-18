<?php require __DIR__ . '/header.php'; ?>

<div class="container col-8 mt-4">
    <h1 class="mb-4">Series de Crimen</h1>

    <?php
    // Obtener todas las series sin paginación
    $series = $conn->query("SELECT * FROM Series");
    if (!$series) {
        die("Error en la consulta: " . $conn->error);
    }
    $series = $series->fetch_all(MYSQLI_ASSOC);
    ?>

    <div class="row">
        <?php foreach ($series as $serie): ?>
            <div class="col-md-4 mb-4">
                <a href="/serie/<?= $serie['id'] ?>" class="text-decoration-none">
                    <div class="card bg-black text-light">
                        <img src="<?= $serie['imagen_url'] ?>" class="card-img-top" alt="<?= $serie['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"> <?= $serie['titulo'] ?> </h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>