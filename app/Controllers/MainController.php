<?php 

namespace App\Controllers;

use App\Feedback;
use League\Plates\Engine;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MainController {

  private $templates;
  public $feedback;

  public function __construct() {
    $this->templates = new Engine('../views');  
    $this->feedback = new Feedback();
  }

  public function home(ServerRequestInterface $request): ResponseInterface {
    $response = new Response;
    $output = $this->templates->render('sections/home');
    $response->getBody()->write($output);
    return $response;
  }
}