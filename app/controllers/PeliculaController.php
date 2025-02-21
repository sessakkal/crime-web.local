<?php
require_once __DIR__ . '/../models/Pelicula.php';
require_once __DIR__ . '/../config/twig.php';

class PeliculaController {
    private $peliculaModel;
    private $twig;

    public function __construct($pdo) {
        $this->peliculaModel = new Pelicula($pdo);
        $this->twig = $twig;
    }

    public function index() {
        $peliculas = $this->peliculaModel->getAll();
        echo $this->twig->render('peliculas/index.html', ['peliculas' => $peliculas]);
    }

    public function show($id) {
        $pelicula = $this->peliculaModel->getById($id);
        echo $this->twig->render('peliculas/show.html', ['pelicula' => $pelicula]);
    }
}