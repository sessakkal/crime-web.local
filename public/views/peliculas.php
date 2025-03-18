<?php require __DIR__ . '/header.php'; ?>

<div class="container col-8 mt-4">
    <h1 class="mb-4">Películas de Crimen</h1>

    <?php
    // Paginación
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $por_pagina = 18;
    $inicio = ($pagina - 1) * $por_pagina;

    // Obtener películas
    $peliculas = $conn->query("SELECT * FROM Peliculas LIMIT $inicio, $por_pagina");
    if (!$peliculas) {
        die("Error en la consulta: " . $conn->error);
    }
    $peliculas = $peliculas->fetch_all(MYSQLI_ASSOC);

    // Obtener total de películas
    $total_peliculas = $conn->query("SELECT COUNT(*) as total FROM Peliculas")->fetch_assoc()['total'];
    $total_paginas = ceil($total_peliculas / $por_pagina);

    // Validar página
    $pagina = max(1, min($pagina, $total_paginas));
    ?>

    <div class="row">
        <?php foreach ($peliculas as $pelicula): ?>
            <div class="col-md-4 mb-4">
                <a href="/pelicula/<?= $pelicula['id'] ?>" class="text-decoration-none">
                    <div class="card bg-black text-light">
                        <img src="<?= $pelicula['imagen_url'] ?>" class="card-img-top" alt="<?= $pelicula['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $pelicula['titulo'] ?></h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= $i === $pagina ? 'active' : '' ?>">
                    <a class="page-link" href="/peliculas?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php require __DIR__ . '/footer.php'; ?>