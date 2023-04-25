<?php
include './vendor/autoload.php';
include './includes/enviroment.php';
include './includes/templates.php';
$feedbackElement = new App\Feedback();

$customerModel = new App\Models\Customer();
$customers = $customerModel->getAll();

$countryModel = new App\Models\Country();
$countries = $countryModel->getAll();

echo $templates->render('sections/home', [
  'title' => 'Curso de bases de datos con PHP',
  'customers' => $customers,
  'countries' => $countries,
]);
?>