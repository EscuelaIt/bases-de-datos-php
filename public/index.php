<?php

include '../vendor/autoload.php';
include '../includes/enviroment.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

// map routes
$router->map('GET', '/', 'App\Controllers\MainController::home');
$router->map('GET', '/clientes', 'App\Controllers\CustomerController::home');
$router->map('POST', '/clientes/insertar', 'App\Controllers\CustomerController::insert');
$router->map('GET', '/clientes/borrar', 'App\Controllers\CustomerController::delete');
$router->map('GET', '/clientes/editar', 'App\Controllers\CustomerController::edit');
$router->map('POST', '/clientes/editar', 'App\Controllers\CustomerController::editSave');

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);