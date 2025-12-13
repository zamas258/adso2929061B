<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'controllers/PokemonController.php';

$uri = $_SERVER['REQUEST_URI'];

$uri = parse_url($uri, PHP_URL_PATH);
$uri = str_replace('/18-mvc', '', $uri);

if ($uri === '/pokemon' || $uri === '/pokemon/') {
    $controller = new PokemonController();
    $controller->index();
} elseif ($uri === '/pokemon/create') {
    $controller = new PokemonController();
    $controller->create();
} elseif ($uri === '/pokemon/store') {
    $controller = new PokemonController();
    $controller->store();
} elseif (preg_match('#^/pokemon/edit/(\d+)$#', $uri, $matches)) {
    $controller = new PokemonController();
    $controller->edit($matches[1]);
} elseif (preg_match('#^/pokemon/update/(\d+)$#', $uri, $matches)) {
    $controller = new PokemonController();
    $controller->update($matches[1]);
} elseif (preg_match('#^/pokemon/delete/(\d+)$#', $uri, $matches)) {
    $controller = new PokemonController();
    $controller->delete($matches[1]);
} else {
    http_response_code(404);
    echo "404 Not Found";
}