<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-4">
    <?php
    // Obtener el ID de la URL
    $id = explode('/', $_SERVER['REQUEST_URI'])[2];

    // Obtener la serie desde la base de datos
    $serie = $conn->query("SELECT * FROM Series WHERE id = $id")->fetch_assoc();

    // Comprobar si la serie fue encontrada
    if ($serie):
        $user_id = $_SESSION['user_id'];  // Obtener el ID del usuario actual

        // Verificar si el usuario ya ha marcado la serie como vista
        $visto_query = "SELECT visto FROM vistas WHERE user_id = $user_id AND serie_id = $id";
        $visto_result = $conn->query($visto_query);
        $visto = ($visto_result && $visto_result->num_rows > 0) ? $visto_result->fetch_assoc()['visto'] : false;
    ?>
        <div class="card card bg-black text-light">
            <img src="<?= $serie['imagen_url'] ?>" class="card-img-top" alt="<?= $serie['titulo'] ?>">
            <div class="card-body">
                <h1 class="card-title"><?= $serie['titulo'] ?></h1>
                <p class="card-text"><?= $serie['descripcion'] ?></p>

                <!-- Formulario para marcar la serie como vista o no vista -->
                <form action="/visto_serie.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="serie_id" value="<?= $serie['id'] ?>">
                    <button type="submit" class="btn btn-link" style="color: #fff;">
                        <i class="fas fa-eye<?= $visto ? '-slash' : '' ?>"></i> <?= $visto ? 'Marcada como vista' : 'Marcar como vista' ?>
                    </button>
                </form>

                <a href="/series" class="btn btn-danger">Volver</a>
            </div>
        </div>
    <?php else: ?>
        <p>Serie no encontrada.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>