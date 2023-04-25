<?php $this->layout('layouts/layout', [
  'title' => $title,
]) ?>

<?= $this->insert('partials/customer-form', [
  'formTitle' => 'Insertar un cliente',
  'label' => 'Insertar',
  'action' => 'insertar.php',
  'old' => [],
  'errors' => [],
  'countries' => $countries,
]) ?>

<?= $this->insert('partials/customer-list', [
  'customers' => $customers,
]);