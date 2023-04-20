<?php
include './vendor/autoload.php';
include './includes/enviroment.php';
include './includes/templates.php';

$customerModel = new App\Models\Customer();
$customers = $customerModel->getAll();

echo $templates->render('sections/home', [
  'title' => 'Curso de bases de datos con PHP',
  'customers' => $customers,
]);
?>