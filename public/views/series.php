<?php require __DIR__ . '/header.php'; ?>

<div class="container col-8 mt-4">
    <h1 class="mb-4">Series de Crimen</h1>

    <?php
    // Paginación
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $por_pagina = 18;
    $inicio = ($pagina - 1) * $por_pagina;

    $series = $conn->query("SELECT * FROM Series LIMIT $inicio, $por_pagina")->fetch_all(MYSQLI_ASSOC);
    $total_series = $conn->query("SELECT COUNT(*) as total FROM Series")->fetch_assoc()['total'];
    $total_paginas = ceil($total_series / $por_pagina);
    ?>

    <div class="row">
        <?php foreach ($series as $serie): ?>
            <div class="col-md-4 mb-4">
                <a href="/serie/<?= $serie['id'] ?>" class="text-decoration-none">
                    <div class="card bg-black text-light">
                        <img src="<?= $serie['imagen_url'] ?>" class="card-img-top" alt="<?= $serie['titulo'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $serie['titulo'] ?></h5>
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
                    <a class="page-link" href="/series?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php require __DIR__ . '/footer.php'; ?>