<?php

namespace App\Controllers;

use App\Models\Tag;
use App\Validation\TagValidator;
use Psr\Http\Message\ServerRequestInterface;

class TagController extends Controller {

  public function home() {
    $tagModel = new Tag();
    $tags = $tagModel->getAll();

    return $this->response(
      $this->render('sections/tags/home', [
        'tags' => $tags,
      ])
    );
  }

  public function insert() {
    $tagValidator = new TagValidator($_POST);
    $errors = $tagValidator->getErrors();
    
    if($tagValidator->isValid()) {
      $tagModel = new Tag();
      if($tagModel->insert($_POST)) {
        $this->feedback->flashSuccess('Tag insertado con éxito')->redirect('/etiquetas');
      } else {
        $errors[] = 'No se ha podido insertar la etiqueta, inténtalo más tarde';
      }
    }

    return $this->response( 
      $this->render('sections/tags/insert', [
        'old' => $_POST,
        'errors' => $errors
      ])
    );
  }

  public function delete($request, $params) {
    $id = $this->getIdParameter($params);
    $tagModel = new Tag();
    if($tagModel->delete($id)) {
      $this->feedback->flashSuccess('Tag borrado con éxito')->redirect('/etiquetas');
    } else {
      $this->feedback->flashError('Error al borrar...')->redirect('/etiquetas');
    }
  }

  public function edit($request, $params) {
    $id = $this->getIdParameter($params);

    $tagModel = new Tag();
    $tag = $tagModel->getId($id);
    if(!$tag) {
      $this->feedback->flashError('No existe esta etiqueta')->redirect('/etiquetas');
    }

    return $this->response(
      $this->render('sections/tags/edit', [
        'errors' => [],
        'old' => $tag,
      ])
    );
  }
  
  public function editSave(ServerRequestInterface $request, $params) {
    $id = $this->getIdParameter($params);

    $tagValidator = new TagValidator($_POST);
    $errors = $tagValidator->getErrors();
    if($tagValidator->isValid()) {
      $tagModel = new Tag();
      if($tagModel->update($_POST)) {
        $this->feedback->flashSuccess('Tag editado con éxito')->redirect('/etiquetas');
      } else {
        $errors[] = 'No se ha podido editar la etiqueta, inténtalo más tarde';
      }
    }

    return $this->response(
      $this->render('sections/tags/edit', [
        'errors' => $errors,
        'old' => $_POST,
      ])
    );
  }

  private function getIdParameter($params) {
    $id = $params["id"] ?? null;
    if(!$id || !ctype_digit($id)) {
      $this->feedback->flashError('Identificador no recibido')->redirect('/etiquetas');
    }
    return $id;
  }

}