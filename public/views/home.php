<?php 
session_start(); 
require __DIR__ . '/header.php'; ?>

<main>
    <div class="container">
        <h1>Bienvenido a Zona Crimen</h1>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p>¡Hola, <?= $_SESSION['username']; ?>! Has iniciado sesión correctamente.</p>
            <a href="/logout" class="btn btn-danger">Cerrar sesión</a>
        <?php else: ?>
            <p>Explora nuestras películas y series de crimen.</p>
            <a href="/login" class="btn btn-danger">Iniciar sesión</a>
            <a href="/registro" class="btn btn-danger">Registrarse</a>
        <?php endif; ?>

        <!-- Películas destacadas -->
        <h2 class="mt-4">Películas destacadas</h2>
        <div class="scroll-container">
            <div class="scroll-wrapper">
                <?php
                // Obtener películas desde la base de datos
                $stmt = $conn->prepare("SELECT id, titulo, imagen_url FROM Peliculas LIMIT 10");
                $stmt->execute();
                $result = $stmt->get_result();

                while ($pelicula = $result->fetch_assoc()):
                ?>
                    <div class="scroll-item">
                        <div class="card">
                            <img src="<?= $pelicula['imagen_url'] ?>" class="card-img-top" alt="<?= $pelicula['titulo'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $pelicula['titulo'] ?></h5>
                                <a href="/pelicula/<?= $pelicula['id'] ?>" class="btn btn-danger btn-sm">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Series destacadas -->
        <h2 class="mt-4">Series destacadas</h2>
        <div class="scroll-container">
            <div class="scroll-wrapper">
                <?php
                // Obtener series desde la base de datos
                $stmt = $conn->prepare("SELECT id, titulo, imagen_url FROM Series LIMIT 10");
                $stmt->execute();
                $result = $stmt->get_result();

                while ($serie = $result->fetch_assoc()):
                ?>
                    <div class="scroll-item">
                        <div class="card">
                            <img src="<?= $serie['imagen_url'] ?>" class="card-img-top" alt="<?= $serie['titulo'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $serie['titulo'] ?></h5>
                                <a href="/serie/<?= $serie['id'] ?>" class="btn btn-danger btn-sm">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</main>

<?php require __DIR__ . '/footer.php'; ?>
