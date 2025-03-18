<?php
require __DIR__ . '/../includes/db.php';
$conn = connect_to_database();

// Intentar insertar un registro en la tabla `usuarios`
$sql = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES ('test_user', 'test@example.com', 'test_password')";
if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente.";
} else {
    echo "Error al insertar el registro: " . $conn->error;
}
?>