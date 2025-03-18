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
            $_SESSION['username'] = $username;
            header('Location: /');  // Redirigir al home (index.php)
            exit();
        } else {
            $errors[] = "Nombre de usuario/contraseña inválidos";
        }
    } else {
        $errors[] = "Nombre de usuario/contraseña inválidos";
    }
}

// Incluimos la vista de login
include('views/login.php');
?>
