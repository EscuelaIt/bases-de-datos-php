<?php $this->layout('layouts/layout', [
  'title' => 'Edición de cliente',
]) ?>

<?= $this->insert('partials/customer-form', [
  'formTitle' => 'Editar un cliente',
  'label' => 'Guardar',
  'action' => 'editar.php',
  'old' => $customer,
  'errors' => $errors,
  'countries' => $countries,
]);
?>

<p>
  <a href=".">Volver</a>
</p>