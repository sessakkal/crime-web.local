<?php
require '../app/config/database.php';

try {
    $stmt = $pdo->query('SELECT * FROM Peliculas');
    while ($row = $stmt->fetch()) {
        echo $row['titulo'] . '<br>';
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}