<?php
class Pelicula {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Peliculas");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Peliculas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}