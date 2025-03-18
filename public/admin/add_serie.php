<?php
// /public/admin/add_serie.php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: /login');  // Redirigir a login si no está autenticado o no es admin
    exit();
}
include('../../includes/db.php'); // Asegúrate de incluir la conexión a la base de datos

// Conectar a la base de datos
$conn = connect_to_database();

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Comprobar si los datos del formulario están presentes
if (isset($_POST['titulo'], $_POST['descripcion'], $_POST['imagen_url'])) {
    // Recoger los datos del formulario
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $imagen_url = mysqli_real_escape_string($conn, $_POST['imagen_url']);

    // Insertar la serie en la base de datos
    $query = "INSERT INTO Series (titulo, descripcion, imagen_url) VALUES ('$titulo', '$descripcion', '$imagen_url')";

    if (mysqli_query($conn, $query)) {
        // Redirigir al panel de administración o mostrar un mensaje de éxito
        header("Location: /admin/panel_admin.php");
        exit();  // Asegúrate de que el script termine después de la redirección
    } else {
        echo "Error al añadir la serie: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
