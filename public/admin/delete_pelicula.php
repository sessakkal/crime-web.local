<?php
// /public/admin/delete_pelicula.php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
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

// Comprobar si se ha recibido el ID de la película
if (isset($_POST['pelicula_id'])) {
    $pelicula_id = mysqli_real_escape_string($conn, $_POST['pelicula_id']);

    // Eliminar la película de la base de datos
    $query = "DELETE FROM Peliculas WHERE id='$pelicula_id'";

    if (mysqli_query($conn, $query)) {
        // Redirigir al panel de administración tras eliminar
        header("Location: /admin/panel_admin.php");
        exit();
    } else {
        echo "Error al eliminar la película: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
