<!-- /var/www/crime-web.local/public/views/agregar_a_lista.php -->
<?php
session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../../includes/db.php';
require __DIR__ . '/../../includes/listas.php';

if (isset($_POST['lista_id'], $_POST['tipo'], $_POST['contenido_id'])) {
    $lista_id = $_POST['lista_id'];
    $tipo = $_POST['tipo']; // 'pelicula' o 'serie'
    $contenido_id = $_POST['contenido_id'];

    $conn = connect_to_database();
    agregar_item_a_lista($conn, $lista_id, $tipo, $contenido_id);
    header('Location: /ver_lista.php?id=' . $lista_id); // Redirige al ver la lista
}
?>

<form action="/agregar_a_lista.php" method="POST">
    <div class="form-group">
        <label for="lista_id">Seleccionar lista:</label>
        <select name="lista_id" class="form-control" required>
            <!-- Mostrar todas las listas disponibles para el usuario -->
            <?php
            $user_id = $_SESSION['usuario_id']; // Obtén el ID del usuario
            $conn = connect_to_database();
            $stmt = $conn->prepare("SELECT id, nombre FROM listas WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($lista = $result->fetch_assoc()):
            ?>
                <option value="<?= $lista['id'] ?>"><?= $lista['nombre'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="tipo">Tipo:</label>
        <select name="tipo" class="form-control" required>
            <option value="pelicula">Película</option>
            <option value="serie">Serie</option>
        </select>
    </div>

    <div class="form-group">
        <label for="contenido_id">ID del contenido (película/serie):</label>
        <input type="number" name="contenido_id" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-danger">Agregar</button>
</form>
