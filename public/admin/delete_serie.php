<?php
// /public/admin/delete_serie.php

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

// Comprobar si se ha recibido el ID de la serie
if (isset($_POST['serie_id'])) {
    $serie_id = mysqli_real_escape_string($conn, $_POST['serie_id']);

    // Eliminar la serie de la base de datos
    $query = "DELETE FROM Series WHERE id='$serie_id'";

    if (mysqli_query($conn, $query)) {
        // Redirigir al panel de administración tras eliminar
        header("Location: /admin/panel_admin.php");
        exit();
    } else {
        echo "Error al eliminar la serie: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>