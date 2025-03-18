<?php
function connect_to_database() {
    $host = "localhost";
    $user = "usuario";
    $password = "usuario";
    $database = "zona_crimen";

    // Crear la conexión
    $conn = new mysqli($host, $user, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}
?>