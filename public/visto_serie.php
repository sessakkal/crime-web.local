<?php
session_start();
include('../includes/db.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}

$user_id = $_POST['user_id'];
$serie_id = $_POST['serie_id'];

// Conectar a la base de datos
$conn = connect_to_database();

// Verificar si ya existe un registro en la tabla 'vistas' para la serie
$query_visto = "SELECT * FROM vistas WHERE user_id = $user_id AND serie_id = $serie_id";
$result = mysqli_query($conn, $query_visto);

if (mysqli_num_rows($result) > 0) {
    // Si ya existe un registro, actualizar el estado de "visto"
    $visto_row = mysqli_fetch_assoc($result);
    $nuevo_estado = $visto_row['visto'] ? 0 : 1;  // Cambiar el estado de "visto"
    $query_update = "UPDATE vistas SET visto = $nuevo_estado WHERE user_id = $user_id AND serie_id = $serie_id";
    mysqli_query($conn, $query_update);
} else {
    // Si no existe un registro, insertarlo
    $query_insert = "INSERT INTO vistas (user_id, serie_id, visto) VALUES ($user_id, $serie_id, TRUE)";
    mysqli_query($conn, $query_insert);
}

header('Location: /serie/' . $serie_id); // Redirigir de vuelta a la página de detalles de la serie
exit();

mysqli_close($conn);
?>
