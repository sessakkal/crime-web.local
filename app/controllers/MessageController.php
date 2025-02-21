// En app/controllers/MessageController.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remitente_id = $_SESSION['user_id'];
    $destinatario_id = $_POST['destinatario_id'];
    $contenido = $_POST['contenido'];

    // Insertar mensaje en la base de datos
    $stmt = $pdo->prepare("INSERT INTO Mensajes (remitente_id, destinatario_id, contenido) VALUES (?, ?, ?)");
    $stmt->execute([$remitente_id, $destinatario_id, $contenido]);

    header('Location: /messages');
    exit();
}