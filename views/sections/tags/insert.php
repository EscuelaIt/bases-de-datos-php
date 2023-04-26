<?php $this->layout('layouts/layout', [
  'title' => 'Insertar una etiqueta'
]) ?>

<?= $this->insert('partials/tags/tag-form', [
  'formTitle' => 'Insertar una etiqueta',
  'action' => '/etiquetas/insertar',
  'label' => 'Añadir',
  'old' => $old,
  'errors' => $errors,
]) ?>

<p>
  <a href=".">Volver</a>
</p>