<?php
include './vendor/autoload.php';
include './includes/enviroment.php';
  
$feedback = new App\Feedback();

$id = $_GET["id"] ?? null;
if($id && ctype_digit($id)) {
  $customerModel = new App\Models\Customer();
  if($customerModel->delete($id)) {
    $feedback->flashSuccess('Se ha borrado el cliente')->redirect('/');
  } else {
    $feedback->flashError('Algo no ha ido bien al borrar el elemento')->redirect('/');
  }
} else {
  $feedback->flashError('No se ha recibido el identificador del cliente')->redirect('/');
}
?>