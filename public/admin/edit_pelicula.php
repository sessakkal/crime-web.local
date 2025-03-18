<?php
// /public/admin/edit_pelicula.php

session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: /login');  // Redirigir a login si no está autenticado o no es admin
    exit();
}
include('../../includes/db.php'); // Conexión a la base de datos

// Conectar a la base de datos
$conn = connect_to_database();

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si se ha recibido el ID de la película
if (isset($_POST['pelicula_id'], $_POST['titulo'], $_POST['descripcion'], $_POST['imagen_url'])) {
    $pelicula_id = mysqli_real_escape_string($conn, $_POST['pelicula_id']);
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $imagen_url = mysqli_real_escape_string($conn, $_POST['imagen_url']);

    // Actualizar la película en la base de datos
    $query = "UPDATE Peliculas SET titulo='$titulo', descripcion='$descripcion', imagen_url='$imagen_url' WHERE id='$pelicula_id'";

    if (mysqli_query($conn, $query)) {
        // Redirigir al panel de administración tras la edición
        header("Location: /admin/panel_admin.php");
        exit();
    } else {
        echo "Error al actualizar la película: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
