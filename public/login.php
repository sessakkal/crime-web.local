<?php
session_start();
include('../includes/db.php');

// Conectar a la base de datos
$conn = connect_to_database();

// Lógica de inicio de sesión
if (isset($_POST['login_button'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Comprobar si el usuario existe
    $query = "SELECT * FROM users WHERE username='$username'";
    $results = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Almacenar el ID del usuario y su nombre de usuario en la sesión
            $_SESSION['user_id'] = $row['id'];  // ID del usuario
            $_SESSION['username'] = $row['username'];  // Nombre de usuario
            $_SESSION['rol'] = $row['rol']; 

            // Redirigir al home (index.php)
            header('Location: /');
            exit();
        } else {
            $errors[] = "Nombre de usuario/contraseña inválidos";
        }
    } else {
        $errors[] = "Nombre de usuario/contraseña inválidos";
    }
}

// Si el usuario ya está logueado, redirigirlo a la página de inicio
if (isset($_SESSION['user_id'])) {
    header('Location: /');  // Redirigir al home si ya está logueado
    exit();
}

// Incluimos la vista de login
include('views/login.php');
?>
