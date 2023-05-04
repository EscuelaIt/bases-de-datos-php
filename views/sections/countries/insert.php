<?php $this->layout('layouts/layout', [
  'title' => 'Insertar un País'
]) ?>

<?= $this->insert('partials/country-form', [
  'formTitle' => 'Insertar un país',
  'action' => '/paises/insertar',
  'label' => 'Añadir',
  'old' => $old,
  'errors' => $errors,
]) ?>

<p>
  <a href="/paises">Volver</a>
</p>