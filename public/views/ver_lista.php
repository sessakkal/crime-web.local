<!-- /var/www/crime-web.local/public/views/ver_lista.php -->
<?php
session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../../includes/db.php';

$conn = connect_to_database();
$lista_id = $_GET['id']; // Obtiene el ID de la lista desde la URL

$stmt = $conn->prepare("
    SELECT li.id, li.tipo, li.contenido_id, p.titulo AS pelicula_titulo, s.titulo AS serie_titulo
    FROM lista_items li
    LEFT JOIN peliculas p ON li.contenido_id = p.id AND li.tipo = 'pelicula'
    LEFT JOIN series s ON li.contenido_id = s.id AND li.tipo = 'serie'
    WHERE li.lista_id = ?
");
$stmt->bind_param('i', $lista_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h1>Lista de contenido</h1>
<ul>
    <?php while ($item = $result->fetch_assoc()): ?>
        <li>
            <?php if ($item['tipo'] == 'pelicula'): ?>
                <a href="/pelicula/<?= $item['contenido_id'] ?>"><?= $item['pelicula_titulo'] ?></a>
            <?php else: ?>
                <a href="/serie/<?= $item['contenido_id'] ?>"><?= $item['serie_titulo'] ?></a>
            <?php endif; ?>
        </li>
    <?php endwhile; ?>
</ul>
