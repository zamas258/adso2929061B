<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'pokemon';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$page = $url[0] ?? 'pokemon';
$action = $url[1] ?? 'index';
$id = $url[2] ?? null;

if ($page === 'pokemon') {
    require_once __DIR__ . '/controllers/PokemonController.php';
    $controller = new PokemonController();
    
    switch ($action) {
        case 'create':
            $controller->create();
            break;
        case 'store':
            $controller->store();
            break;
        case 'edit':
            if ($id) {
                $controller->edit($id);
            } else {
                header('Location: /18-mvc/pokemon');
                exit;
            }
            break;
        case 'update':
            if ($id) {
                $controller->update($id);
            } else {
                header('Location: /18-mvc/pokemon');
                exit;
            }
            break;
        case 'delete':
            if ($id) {
                $controller->delete($id);
            } else {
                header('Location: /18-mvc/pokemon');
                exit;
            }
            break;
        default:
            $controller->index();
    }
} else {
    header('Location: /18-mvc/pokemon');
    exit;
}