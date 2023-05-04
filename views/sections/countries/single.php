<?php $this->layout('layouts/layout', [
  'title' => 'Página del país ' . $country['name'],
]) ?>

<?= $this->insert('partials/state-form', [
  'formTitle' => 'Insertar una provincia',
  'action' => "/paises/{$country['id']}/provincia",
  'label' => 'Añadir',
  'old' => $old ?? [] ,
  'errors' => $errors ?? [],
]); ?>

<?= $this->insert('partials/state-list', [
  'states' => $states,
]); ?>

<p>
  <a href="/paises">Volver</a>
</p>