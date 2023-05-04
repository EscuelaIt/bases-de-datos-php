<?php $this->layout('layouts/layout', [
  'title' => 'Home de países'
]) ?>

<?= $this->insert('partials/country-form', [
  'formTitle' => 'Insertar un País',
  'action' => '/paises/insertar',
  'label' => 'Añadir',
  'old' => [],
  'errors' => [],
]); ?>

<?= $this->insert('partials/country-list', [
  'countries' => $countries,
]); ?>