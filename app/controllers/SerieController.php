<?php
require_once __DIR__ . '/../models/Serie.php';
require_once __DIR__ . '/../vendor/twig.php';

class SerieController {
    private $serieModel;
    private $twig;

    public function __construct($pdo) {
        $this->serieModel = new Serie($pdo);
        $this->twig = $twig;
    }

    public function index() {
        $series = $this->serieModel->getAll();
        echo $this->twig->render('series/index.html', ['series' => $series]);
    }

    public function show($id) {
        $serie = $this->serieModel->getById($id);
        echo $this->twig->render('series/show.html', ['serie' => $serie]);
    }
}