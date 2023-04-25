<?php
include './vendor/autoload.php';
include './includes/enviroment.php';
include './includes/validation.php';
include './includes/templates.php';

$feedback = new App\Feedback();

$errors = validateCustomer($_POST);

if(count($errors) == 0) {
  $customerModel = new App\Models\Customer();
  if($customerModel->insert($_POST)) {
    $feedback->flashSuccess('Se ha insertado el cliente')->redirect('/');
  } else {
    $errors[] = 'No se pudo insertar, inténtalo de nuevo más tarde...';
  }
} 

$countryModel = new App\Models\Country();
$countries = $countryModel->getAll();

echo $templates->render('sections/insert', [
    'old' => $_POST,
    'errors' => $errors,
    'countries' => $countries,
]);