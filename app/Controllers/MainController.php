<?php 

namespace App\Controllers;

use App\Feedback;
use League\Plates\Engine;
use App\Models\Connection;
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

  public function pdo(ServerRequestInterface $request): ResponseInterface {
    $response = new Response;
    
    $conn = Connection::getInstance()->getConnection();
    $ssql = 'SELECT * from tags';
    $result = $conn->query($ssql);
    $output = '';
    foreach($result as $tag) {
      echo '<pre>';
      var_dump($tag);
      echo '</pre>';
      $output .= '<p>' . $tag["name"];
    }
    $response->getBody()->write($output);

    $ssql = "INSERT INTO tags (name, description) VALUES (:name, :description)";
    $statement = $conn->prepare($ssql);
    $statement->execute([
      ':name' => 'uno',
      ':description' => 'uno desc',
    ]);
    $statement->execute([
      ':name' => 'dos',
      ':description' => 'dos',
    ]);


    return $response;
  }


}