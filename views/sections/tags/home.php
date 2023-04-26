<?php $this->layout('layouts/layout', [
  'title' => 'Etiquetas'
]) ?>

<?= $this->insert('partials/tags/tag-form', [
  'formTitle' => 'Insertar una etiqueta',
  'label' => 'Insertar',
  'action' => '/etiquetas/insertar',
  'old' => [],
  'errors' => [],
]) ?>

<?= $this->insert('partials/tags/tag-list', [
  'tags' => $tags,
]);