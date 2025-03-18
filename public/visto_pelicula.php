<?php
// /public/visto_pelicula.php

session_start();
include('../includes/db.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}

$user_id = $_SESSION['user_id']; // Asegúrate de obtener el user_id de la sesión, no de POST
$pelicula_id = $_POST['pelicula_id'];

// Conectar a la base de datos
$conn = connect_to_database();

// Escapar las variables para prevenir inyección SQL
$user_id = mysqli_real_escape_string($conn, $user_id);
$pelicula_id = mysqli_real_escape_string($conn, $pelicula_id);

// Verificar si ya existe un registro en la tabla 'vistas'
$query_visto = "SELECT * FROM vistas WHERE user_id = $user_id AND pelicula_id = $pelicula_id";
$result = mysqli_query($conn, $query_visto);

if ($result && mysqli_num_rows($result) > 0) {
    // Si ya existe un registro, actualizar el estado de "visto"
    $visto_row = mysqli_fetch_assoc($result);
    $nuevo_estado = $visto_row['visto'] ? 0 : 1;  // Cambiar el estado de "visto"
    $query_update = "UPDATE vistas SET visto = $nuevo_estado WHERE user_id = $user_id AND pelicula_id = $pelicula_id";
    mysqli_query($conn, $query_update);
} else {
    // Si no existe un registro, insertarlo
    $query_insert = "INSERT INTO vistas (user_id, pelicula_id, visto) VALUES ($user_id, $pelicula_id, TRUE)";
    mysqli_query($conn, $query_insert);
}

header('Location: /pelicula/' . $pelicula_id); // Redirigir de vuelta a la página de detalles de la película
exit();

mysqli_close($conn);
?>
