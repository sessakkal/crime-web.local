<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/PeliculaController.php';
require_once __DIR__ . '/../controllers/SerieController.php';

$peliculaController = new PeliculaController($pdo);
$serieController = new SerieController($pdo);

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        $peliculaController->index();
        break;
    case '/peliculas':
        $peliculaController->index();
        break;
    case (preg_match('/\/peliculas\/(\d+)/', $request, $matches) ? true : false):
        $peliculaController->show($matches[1]);
        break;
    case '/series':
        $serieController->index();
        break;
    case (preg_match('/\/series\/(\d+)/', $request, $matches) ? true : false):
        $serieController->show($matches[1]);
        break;
    default:
        http_response_code(404);
        echo $twig->render('404.html');
        break;
}