<?php
namespace App\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Validation\CountryValidator;
use Psr\Http\Message\ServerRequestInterface;

class CountryController extends Controller {

  public function index() {
    $countryModel = new Country();
    $countries = $countryModel->getAll();

    return $this->response( $this->render('sections/countries/home', [
      'countries' => $countries,
    ]));
  }

  public function insert() {
    $countryValidator = new CountryValidator($_POST);
    $errors = $countryValidator->validate();

    if(count($errors) == 0) {
      $countryModel = new Country();
      if($countryModel->insert($_POST)) {
        $this->feedback->flashSuccess('País insertado con éxito')->redirect('/paises');
      } else {
        $errors[] = 'No se ha podido insertar el cliente, inténtalo más tarde';
      }
    }

    return $this->response( $this->render('sections/countries/insert', [
      'old' => $_POST,
      'errors' => $errors
    ]));
  }

  public function single(ServerRequestInterface $request, $params) {
    $id = $params["id"] ?? null;
    if(!$id || !ctype_digit($id)) {
      $this->feedback->flashError('Identificador no recibido')->redirect('/paises');
    }
    $countryModel = new Country();
    $country = $countryModel->getId($params['id']);
    if(!$country) {
      $this->feedback->flashError('País no encontrado')->redirect('/paises');
    }
    $stateModel = new State();
    $states = $stateModel->getCountryStates($country["id"]);
    return $this->response($this->render('sections/countries/single', [
      'country' => $country,
      'states' => $states,
    ]));
  }
}