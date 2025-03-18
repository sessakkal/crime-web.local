<?php
// public/index.php

// Incluir el archivo de conexión a la base de datos
require __DIR__ . '/../includes/db.php';

// Obtener la ruta solicitada
$request_uri = $_SERVER['REQUEST_URI'];

// Conexión a la base de datos
$conn = connect_to_database();

// Manejo de rutas
if ($request_uri === '/') {
    require __DIR__ . '/views/home.php'; // Ruta corregida
} elseif (strpos($request_uri, '/peliculas') === 0) {
    require __DIR__ . '/views/peliculas.php'; // Ruta corregida
} elseif (strpos($request_uri, '/series') === 0) {
    require __DIR__ . '/views/series.php'; // Ruta corregida
} elseif (strpos($request_uri, '/pelicula/') === 0) {
    require __DIR__ . '/views/detalle_pelicula.php'; // Ruta corregida
} elseif (strpos($request_uri, '/serie/') === 0) {
    require __DIR__ . '/views/detalle_serie.php'; // Ruta corregida
} elseif ($request_uri === '/registro') {
    require __DIR__ . '/views/registro.php'; // Nueva ruta para el registro
} elseif ($request_uri === '/login') {
    require __DIR__ . '/views/login.php'; // Nueva ruta para el inicio de sesión
} else {
    require __DIR__ . '/views/404.php'; // Ruta corregida
}

$conn->close();
?>