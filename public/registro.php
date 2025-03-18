<?php
session_start(); // Iniciar sesión
require __DIR__ . '/includes/db.php'; // Incluir la conexión a la base de datos
$conn = connect_to_database();

$error = ""; // Inicializar la variable de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario']); // Limpiar espacios en blanco
    $email = trim($_POST['email']); // Limpiar espacios en blanco
    $password = $_POST['password'];

    // Validar campos vacíos
    if (empty($nombre_usuario) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validar formato de email
        $error = "El correo electrónico no es válido.";
    } else {
        // Verificar si el usuario ya existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? OR email = ?");
        if (!$stmt) {
            die("Error en la consulta: " . $conn->error); // Depuración en caso de error
        }
        $stmt->bind_param("ss", $nombre_usuario, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "El nombre de usuario o correo electrónico ya está en uso.";
        } else {
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar nuevo usuario
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)");
            if (!$stmt) {
                die("Error en la consulta: " . $conn->error); // Depuración en caso de error
            }
            $stmt->bind_param("sss", $nombre_usuario, $email, $hashed_password);

            if ($stmt->execute()) {
                // Obtener el ID del usuario recién registrado
                $usuario_id = $stmt->insert_id;

                // Iniciar sesión automáticamente después del registro
                $_SESSION['usuario_id'] = $usuario_id;

                // Redirigir a la página de inicio
                header("Location: /index.php");
                exit;
            } else {
                $error = "Error al registrar el usuario: " . $stmt->error; // Depuración
            }
        }
    }
}

// Mostrar la vista de registro si hay un error o si no es una solicitud POST
require __DIR__ . '/views/registro.php';
?>