<?php
session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: /login');  // Redirigir a login si no está autenticado o no es admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="admin-panel">
    <div class="container mt-5">
        <h1>Panel de Administración</h1>

        <!-- Menú de administración -->
        <div class="list-group">
            <h3>Gestión de Series</h3>
            <a href="/views/add_serie.php" class="list-group-item list-group-item-action admin-link">Añadir Serie</a>
            <a href="/views/edit_serie.php" class="list-group-item list-group-item-action admin-link">Editar Serie</a>
            <a href="/views/delete_serie.php" class="list-group-item list-group-item-action admin-link">Eliminar Serie</a>
            
            <h3 class="mt-4">Gestión de Películas</h3>
            <a href="/views/add_pelicula.php" class="list-group-item list-group-item-action admin-link">Añadir Película</a>
            <a href="/views/edit_pelicula.php" class="list-group-item list-group-item-action admin-link">Editar Película</a>
            <a href="/views/delete_pelicula.php" class="list-group-item list-group-item-action admin-link">Eliminar Película</a>
        </div>

        <!-- Botón para cerrar sesión -->
        <a href="/logout.php" class="btn btn-danger mt-4">Cerrar sesión</a>
    </div>
</body>
</html>
