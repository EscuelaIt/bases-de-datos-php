<?php $this->layout('layouts/layout', [
  'title' => 'Creación de un nuevo cliente',
]) ?>

<?= $this->insert('partials/customer-form', [
  'formTitle' => 'Insertar un cliente',
  'label' => 'Insertar',
  'action' => 'insertar.php',
  'old' => $old,
  'errors' => $errors,
]);
?>

<p>
  <a href=".">Volver</a>
</p>