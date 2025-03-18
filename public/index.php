<?php
session_start(); // Iniciar sesión
require __DIR__ . '/../includes/db.php';

$request_uri = $_SERVER['REQUEST_URI'];

$conn = connect_to_database();

// Comprobar si el usuario está autenticado y es admin
$is_admin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';

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
    require __DIR__ . '/logout.php'; // Agregamos logout

// Rutas del Panel de Administración (solo si es admin)
} elseif ($request_uri === '/admin') {
    if ($is_admin) {
        require __DIR__ . '/admin/panel_admin.php'; // Página principal del panel admin
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} elseif ($request_uri === '/views/add_pelicula') {
    if ($is_admin) {
        require __DIR__ . '/views/add_pelicula.php'; // Añadir película
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} elseif ($request_uri === '/views/add_serie') {
    if ($is_admin) {
        require __DIR__ . '/views/add_serie.php'; // Añadir serie
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} elseif ($request_uri === '/views/edit_pelicula') {
    if ($is_admin) {
        require __DIR__ . '/views/edit_pelicula.php'; // Editar película
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} elseif ($request_uri === '/views/edit_serie') {
    if ($is_admin) {
        require __DIR__ . '/views/edit_serie.php'; // Editar serie
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} elseif ($request_uri === '/views/delete_pelicula') {
    if ($is_admin) {
        require __DIR__ . '/views/delete_pelicula.php'; // Eliminar película
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} elseif ($request_uri === '/views/delete_serie') {
    if ($is_admin) {
        require __DIR__ . '/views/delete_serie.php'; // Eliminar serie
    } else {
        header("Location: /login"); // Redirigir al login si no es admin
        exit();
    }
} else {
    require __DIR__ . '/views/404.php'; // Página 404 para rutas no definidas
}

$conn->close();

?>
