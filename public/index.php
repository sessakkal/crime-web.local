<?php
session_start(); // Iniciar sesión
require __DIR__ . '/../includes/db.php';

$request_uri = $_SERVER['REQUEST_URI'];

$conn = connect_to_database();

// Manejo de rutas
if ($request_uri === '/') {
    require __DIR__ . '/views/home.php';
} elseif ($request_uri === '/peliculas') {
    require __DIR__ . '/views/peliculas.php';
} elseif ($request_uri === '/series') {
    require __DIR__ . '/views/series.php';
} elseif (strpos($request_uri, '/pelicula/') === 0) {
    require __DIR__ . '/views/detalle_pelicula.php';
} elseif (strpos($request_uri, '/serie/') === 0) {
    require __DIR__ . '/views/detalle_serie.php';
} elseif ($request_uri === '/registro') {
    require __DIR__ . '/views/registro.php';
} elseif ($request_uri === '/login') {
    require __DIR__ . '/views/login.php';
} elseif ($request_uri === '/logout') {
    require __DIR__ . '/views/logout.php'; // Agregamos logout
} else {
    require __DIR__ . '/views/404.php';
}

$conn->close();
?>
