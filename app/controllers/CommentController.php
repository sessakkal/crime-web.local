// En app/controllers/CommentController.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['user_id'];
    $pelicula_id = $_POST['pelicula_id'];
    $serie_id = $_POST['serie_id'];
    $contenido = $_POST['contenido'];

    // Insertar comentario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO Comentarios (usuario_id, pelicula_id, serie_id, contenido) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuario_id, $pelicula_id, $serie_id, $contenido]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}