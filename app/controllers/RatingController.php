// En app/controllers/RatingController.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['user_id'];
    $pelicula_id = $_POST['pelicula_id'];
    $serie_id = $_POST['serie_id'];
    $puntuacion = $_POST['puntuacion'];

    // Insertar valoración en la base de datos
    $stmt = $pdo->prepare("INSERT INTO Valoraciones (usuario_id, pelicula_id, serie_id, puntuacion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuario_id, $pelicula_id, $serie_id, $puntuacion]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}