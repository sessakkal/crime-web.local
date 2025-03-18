<?php
session_start(); // Iniciar sesión
require __DIR__ . '/includes/db.php'; // Incluir la conexión a la base de datos
$conn = connect_to_database();

$error = ""; // Inicializar la variable de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario']); // Limpiar espacios en blanco
    $password = $_POST['password'];

    // Validar campos vacíos
    if (empty($nombre_usuario) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Buscar al usuario en la base de datos
        $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE nombre_usuario = ? OR email = ?");
        if (!$stmt) {
            die("Error en la consulta: " . $conn->error); // Depuración en caso de error
        }
        $stmt->bind_param("ss", $nombre_usuario, $nombre_usuario);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $hashed_password);

        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['usuario_id'] = $id;

            // Redirigir a la página de inicio
            header("Location: /index.php");
            exit;
        } else {
            $error = "Credenciales incorrectas.";
        }
    }
}

// Mostrar la vista de login si hay un error o si no es una solicitud POST
require __DIR__ . '/views/login.php';
?>