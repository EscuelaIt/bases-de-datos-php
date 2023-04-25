<?php

namespace App\Controllers;

use App\Feedback;
use League\Plates\Engine;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;

class Controller {

  private $templates;
  public $feedback;

  public function __construct() {
    $this->templates = new Engine('../views');
    $this->feedback = new Feedback();
  }

  protected function response($output): ResponseInterface {
    $response = new Response;
    $response->getBody()->write($output);
    return $response;
  }

  protected function render($view, $data) {
    return $this->templates->render($view, $data);
  }
}