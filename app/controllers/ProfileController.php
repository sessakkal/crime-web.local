// En app/controllers/ProfileController.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Actualizar perfil en la base de datos
    $stmt = $pdo->prepare("UPDATE Usuarios SET username = ?, email = ?, bio = ? WHERE id = ?");
    $stmt->execute([$username, $email, $bio, $usuario_id]);

    header('Location: /profile');
    exit();
}