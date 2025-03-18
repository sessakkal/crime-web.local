<?php
// /public/admin/edit_serie.php

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

// Verificar si se han recibido los datos del formulario
if (isset($_POST['serie_id'], $_POST['titulo'], $_POST['descripcion'], $_POST['imagen_url'])) {
    $serie_id = mysqli_real_escape_string($conn, $_POST['serie_id']);
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $imagen_url = mysqli_real_escape_string($conn, $_POST['imagen_url']);

    // Actualizar la serie en la base de datos
    $query = "UPDATE Series SET titulo='$titulo', descripcion='$descripcion', imagen_url='$imagen_url' WHERE id='$serie_id'";

    if (mysqli_query($conn, $query)) {
        // Redirigir al panel de administración tras la edición
        header("Location: /admin/panel_admin.php");
        exit();
    } else {
        echo "Error al actualizar la serie: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>