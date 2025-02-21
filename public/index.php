<?php
// Incluye el autoload de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Configuración básica
require_once __DIR__ . '/../config/db.php';  // Configuración de la base de datos
require_once __DIR__ . '/../config/routes.php';  // Definición de rutas (opcional, si decides usar un sistema de routing propio)

// Inicializa el sistema de plantillas TWIG
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../var/cache/twig',
    'debug' => true,
]);

// Obtén la URL solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Sistema de enrutamiento (puedes usar un enrutador personalizado o un framework)
switch ($uri) {
    case '/':
        // Controlador para la página principal
        include __DIR__ . '/../controllers/HomeController.php';
        break;
    
    case '/admin':
        // Controlador para la administración (requiere autenticación)
        include __DIR__ . '/../controllers/AdminController.php';
        break;

    case '/login':
        // Controlador para la página de login
        include __DIR__ . '/../controllers/AuthController.php';
        break;
    
    default:
        // Si la ruta no existe, mostrar página 404
        http_response_code(404);
        echo $twig->render('404.twig');  // Crear una plantilla 404.twig
        break;
}

// Aquí puedes agregar más lógica para manejar los JWT, verificar sesión, etc.
