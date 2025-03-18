<?php 
session_start(); 
require __DIR__ . '/header.php'; 
// Obtener la cantidad de películas y series
$peliculas_count = $conn->query("SELECT COUNT(*) AS count FROM Peliculas")->fetch_assoc()['count'];
$series_count = $conn->query("SELECT COUNT(*) AS count FROM Series")->fetch_assoc()['count'];

// Calcular el total y el porcentaje
$total = $peliculas_count + $series_count;
$peliculas_percentage = ($total > 0) ? ($peliculas_count / $total) * 100 : 0;
$series_percentage = ($total > 0) ? ($series_count / $total) * 100 : 0;

?>

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
                            <a href="/pelicula/<?= $pelicula['id'] ?>" class="text-decoration-none">
                            <img src="<?= $pelicula['imagen_url'] ?>" class="card-img-top" alt="<?= $pelicula['titulo'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $pelicula['titulo'] ?></h5>
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
                            <a href="/serie/<?= $serie['id'] ?>" class="text-decoration-none">
                            <img src="<?= $serie['imagen_url'] ?>" class="card-img-top" alt="<?= $serie['titulo'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $serie['titulo'] ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Gráfico de distribución de Películas y Series -->
        <h2 class="mt-4">Distribución de Películas y Series</h2>
        <canvas id="myPieChart" width="100" height="100"></canvas>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Obtener los datos de PHP
            var peliculasPercentage = <?= $peliculas_percentage ?>;
            var seriesPercentage = <?= $series_percentage ?>;

            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Películas', 'Series'],
                    datasets: [{
                        label: 'Porcentaje',
                        data: [peliculasPercentage, seriesPercentage],
                        backgroundColor: ['#FF6384', '#36A2EB'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</main>

<?php require __DIR__ . '/footer.php'; ?>
