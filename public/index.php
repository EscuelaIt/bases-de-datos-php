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
$router->map('GET', '/clientes/{id}', 'App\Controllers\CustomerController::single');
$router->map('POST', '/clientes/{id}/asociar-tag', 'App\Controllers\CustomerController::asssocTag');
$router->map('GET', '/clientes/{customer_id}/desvincular-tag/{tag_id}', 'App\Controllers\CustomerController::unAsssocTag');

$router->map('GET', '/etiquetas', 'App\Controllers\TagController::home');
$router->map('POST', '/etiquetas/insertar', 'App\Controllers\TagController::insert');
$router->map('GET', '/etiquetas/borrar/{id}', 'App\Controllers\TagController::delete');
$router->map('GET', '/etiquetas/editar/{id}', 'App\Controllers\TagController::edit');
$router->map('POST', '/etiquetas/editar/{id}', 'App\Controllers\TagController::editSave');

$router->map('GET', '/pdo', 'App\Controllers\MainController::pdo');

$router->map('GET', '/paises', 'App\Controllers\CountryController::index');
$router->map('POST', '/paises/insertar', 'App\Controllers\CountryController::insert');
$router->map('GET', '/paises/{id}', 'App\Controllers\CountryController::single');
$router->map('POST', '/paises/{id}/provincia', 'App\Controllers\StateController::insert');

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);