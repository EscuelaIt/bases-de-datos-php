<?php $this->layout('layouts/layout', [
  'title' => 'Creación de un nuevo cliente',
]) ?>

<?= $this->insert('partials/customer-form', [
  'formTitle' => 'Insertar un cliente',
  'label' => 'Insertar',
  'action' => '/clientes/insertar',
  'old' => $old,
  'errors' => $errors,
  'countries' => $countries,
  'stateModel' => $stateModel,
  'isInsert' => true,
]);
?>

<p>
  <a href="/clientes">Volver</a>
</p>