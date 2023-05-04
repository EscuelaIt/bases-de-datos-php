<?php $this->layout('layouts/layout', [
  'title' => 'Edición de cliente',
]) ?>

<?= $this->insert('partials/customer-form', [
  'formTitle' => 'Editar un cliente',
  'label' => 'Guardar',
  'action' => '/clientes/editar',
  'old' => $customer,
  'errors' => $errors,
  'countries' => $countries,
  'stateModel' => $stateModel,
]);
?>

<p>
  <a href="/clientes">Volver</a>
</p>