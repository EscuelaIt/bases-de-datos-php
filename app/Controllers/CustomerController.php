<?php

namespace App\Controllers;

use App\Models\Tag;
use App\Models\Country;
use App\Models\Customer;
use App\Validation\CustomerValidator;
use App\Validation\CustomerTagValidator;
use Psr\Http\Message\ServerRequestInterface;

class CustomerController extends Controller {
  
  public function home() {
    $customerModel = new Customer();
    $customers = $customerModel->getAll();
    $countryModel = new Country();
    $countries = $countryModel->getAll();

    $output = $this->render('sections/customers/home', [
      'title' => 'Curso de bases de datos con PHP',
      'customers' => $customers,
      'countries' => $countries,
    ]);

    return $this->response($output);
  }

  public function single($request, $params) {
    $customer = $this->getCustomerParam($params); 

    $customerModel = new Customer();
    $customerTags = $customerModel->getCustomerTags($customer["id"]);

    $tagModel = new Tag();
    $tags = $tagModel->getAll();


    return $this->response(
      $this->render('sections/customers/single', [
        'customer' => $customer,
        'tags' => $tags,
        'customerTags' => $customerTags,
      ])
    );
  }

  private function getCustomerParam($params) {
    $id = $params["id"] ?? null;
    if(!$id || !ctype_digit($id)) {
      $this->feedback->flashError('Identificador no recibido')->redirect('/clientes');
    }
    $customerModel = new Customer(); 
    $relatedCustomer = $customerModel->getId($id);
    if(! $relatedCustomer) {
      $this->feedback->flashError('No se encuentra el cliente')->redirect('/clientes');
    }
    return $relatedCustomer;
  }


  public function insert() {
    $customerValidator = new CustomerValidator($_POST);
    $errors = $customerValidator->getErrors();


    if($customerValidator->isValid()) {
      $customerModel = new Customer();
      if($customerModel->insert($_POST)) {
        $this->feedback->flashSuccess('Se ha insertado el cliente')->redirect('/clientes');
      } else {
        $errors[] = 'No se pudo insertar, inténtalo de nuevo más tarde...';
      }
    } 
    
    $countryModel = new Country();
    $countries = $countryModel->getAll();
    
    $output = $this->render('sections/customers/insert', [
        'old' => $_POST,
        'errors' => $errors,
        'countries' => $countries,
    ]);

    return $this->response($output);
  }

  public function delete() {
    $id = $_GET["id"] ?? null;
    if($id && ctype_digit($id)) {
      $customerModel = new Customer();
      if($customerModel->delete($id)) {
        $this->feedback->flashSuccess('Se ha borrado el cliente')->redirect('/clientes');
      } else {
        $this->feedback->flashError('Algo no ha ido bien al borrar el elemento')->redirect('/clientes');
      }
    } else {
      $this->feedback->flashError('No se ha recibido el identificador del cliente')->redirect('/clientes');
    }
  }

  public function edit() {
    $customerModel = new Customer();
    $countryModel = new Country();
    $countries = $countryModel->getAll();
    // obtener el cliente que debe editarse
    $id = $_GET["id"] ?? null;
    if(! $id || !ctype_digit($id)) {
      $feedback->flashError('No hemos recibido el identificador del cliente')->redirect('/clientes');
    } else {
      $customer = $customerModel->getId($id);
      if(! $customer) {
        $feedback->flashError('No existe el cliente')->redirect('/clientes');
      }
    }
    
    $output = $this->render('sections/customers/edit', [
      'errors' => [],
      'customer' => $customer,
      'countries' => $countries,
    ]);

    return $this->response($output);
  }

  public function editSave() {
    // Estoy recibiendo datos de un cliente para supuestamente guardarlo
    $customerModel = new Customer();
    $countryModel = new Country();
    $countries = $countryModel->getAll();

    $customerValidator = new CustomerValidator($_POST);
    $errors = $customerValidator->getErrors();

    if($customerValidator->isValid()) {
      if($customerModel->update($_POST)) {
        $this->feedback->flashSuccess('Se ha editado el cliente')->redirect('/clientes');
      } else {
        $errors[] = 'Hubo un error al editar, intenta más tarde';
        $customer = $_POST;
      }
    } else {
      $customer = $_POST;
    }

    $output = $this->render('sections/customers/edit', [
      'errors' => $errors,
      'customer' => $customer,
      'countries' => $countries,
    ]);

    return $this->response($output);
  }

  public function asssocTag(ServerRequestInterface $request, $params) {
    $customer = $this->getCustomerParam($params);
    $data = [
      'customer_id' => $customer["id"],
      'tag_id' => $_POST['tag_id'] ?? null,
    ];
    $customerTagValidator = new CustomerTagValidator($data);
    $errors = $customerTagValidator->getErrors();
    if(! $customerTagValidator->isValid()) {
      $this->feedback->flashErrorArray($errors)->redirect('/clientes/' . $customer["id"]);
    }

    $customerModel = new Customer();
    if($customerModel->associateTag($data['customer_id'], $data['tag_id'])) {
      $this->feedback->flashSuccess('Asociado la etiqueta al cliente')->redirect('/clientes/'  . $customer["id"]);
    } else {
      $this->feedback->flashError('No se pudo asociar la etiqueta al cliente')->redirect('/clientes/'  . $customer["id"]);
    }
  }

  public function unAsssocTag(ServerRequestInterface $request, $params) {
    $data = [
      'customer_id' => $params["customer_id"],
      'tag_id' => $params["tag_id"],
    ];
    $customerTagValidator = new CustomerTagValidator($data, false);
    $errors = $customerTagValidator->getErrors();
    if(! $customerTagValidator->isValid()) {
      $this->feedback->flashErrorArray($errors)->redirect('/clientes/' . $params["customer_id"]);
    }
    $customerModel = new Customer();
    if($customerModel->unAssociateTag($params["customer_id"], $params["tag_id"])) {
      $this->feedback->flashSuccess('Eliminada la etiqueta del cliente')->redirect('/clientes/'  . $params["customer_id"]);
    } else {
      $this->feedback->flashError('No se pudo eliminar la asociación de la etiqueta')->redirect('/clientes/'  . $params["customer_id"]);
    }
  }
}