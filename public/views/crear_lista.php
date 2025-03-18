<!-- /var/www/crime-web.local/public/views/crear_lista.php -->
<?php
session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../../includes/db.php';
require __DIR__ . '/../../includes/listas.php';

if (isset($_POST['nombre_lista'])) {
    $nombre_lista = $_POST['nombre_lista'];
    $user_id = $_SESSION['usuario_id']; // Asegúrate de que el usuario esté autenticado

    $conn = connect_to_database();
    $lista_id = crear_lista($conn, $user_id, $nombre_lista);
    header('Location: /mis_listas.php'); // Redirige a la página de listas
}
?>

<form action="/crear_lista.php" method="POST">
    <div class="form-group">
        <label for="nombre_lista">Nombre de la lista:</label>
        <input type="text" name="nombre_lista" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-danger">Crear Lista</button>
</form>
