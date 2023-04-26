<?php $this->layout('layouts/layout', [
  'title' => 'Editar una etiqueta'
]) ?>

<?= $this->insert('partials/tags/tag-form', [
  'formTitle' => 'Editar una etiqueta',
  'action' => '/etiquetas/editar/' . $old["id"],
  'label' => 'Guardar',
  'old' => $old,
  'errors' => $errors,
]) ?>

<p>
  <a href="/etiquetas">Volver</a>
</p>