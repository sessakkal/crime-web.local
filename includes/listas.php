<?php // Crear una lista para un usuario
function crear_lista($conn, $user_id, $nombre_lista) {
    $stmt = $conn->prepare("INSERT INTO listas (user_id, nombre) VALUES (?, ?)");
    $stmt->bind_param('is', $user_id, $nombre_lista);
    $stmt->execute();
    return $conn->insert_id; // Retorna el ID de la lista recién creada
}

// Agregar una película/serie a una lista
function agregar_item_a_lista($conn, $lista_id, $tipo, $contenido_id) {
    $stmt = $conn->prepare("INSERT INTO lista_items (lista_id, tipo, contenido_id) VALUES (?, ?, ?)");
    $stmt->bind_param('isi', $lista_id, $tipo, $contenido_id);
    $stmt->execute();
}
?>