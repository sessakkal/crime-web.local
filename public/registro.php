<?php
session_start();
include('../includes/db.php');

// Inicializamos la variable $errors como un array vacío
$errors = [];

// Conectar a la base de datos
$conn = connect_to_database();

// Lógica de registro
if (isset($_POST['register_button'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);
    
    // Verificar que las contraseñas coinciden
    if ($password != $password_confirm) {
        $errors[] = "Las contraseñas no coinciden";
    }
    
    // Verificar si el nombre de usuario ya existe
    $query = "SELECT * FROM users WHERE username='$username'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) > 0) {
        $errors[] = "El nombre de usuario ya está en uso";
    }

    // Si no hay errores, registrar al usuario
    if (count($errors) == 0) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['username'] = $username;
            header('Location: /');  // Redirigir al home (index.php)
            exit();
        } else {
            $errors[] = "Error al registrar el usuario";
        }
    }
}

// Incluimos la vista de registro
include('views/registro.php');
?>
