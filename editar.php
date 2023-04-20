<?php
include './vendor/autoload.php';
include './includes/enviroment.php';
include './includes/templates.php';
include './includes/validation.php';

$feedback = new App\Feedback();
$customerModel = new App\Models\Customer();

$errors = [];

if(!$_POST) {
  // obtener el cliente que debe editarse
  $id = $_GET["id"] ?? null;
  if(! $id || !ctype_digit($id)) {
    $feedback->flashError('No hemos recibido el identificador del cliente')->redirect('/');
  } else {
    $customer = $customerModel->getId($id);
    if(! $customer) {
      $feedback->flashError('No existe el cliente')->redirect('/');
    }
  }
} else {
  // Estoy recibiendo datos de un cliente para supuestamente guardarlo
  $errors = validateCustomer($_POST);
  if(count($errors) == 0) {
    if($customerModel->update($_POST)) {
      $feedback->flashSuccess('Se ha editado el cliente')->redirect('/');
    } else {
      $errors[] = 'Hubo un error al editar, intenta más tarde';
      $customer = $_POST;
    }
  } else {
    $customer = $_POST;
  }
}

echo $templates->render('sections/edit', [
  'errors' => $errors,
  'customer' => $customer,
]);