<?php
namespace App\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Validation\StateValidator;
use Psr\Http\Message\ServerRequestInterface;

class StateController extends Controller {
  public function insert(ServerRequestInterface $request, $params) {
    $countryModel = new Country();
    $country_id = $params['id'] ?? null;
    if(!$country_id || !ctype_digit($country_id)) {
      $this->feedback->flashError('No sabemos el id del país')->redirect('/paises');
    }
    $country = $countryModel->getId($country_id);
    $state = [
      'name' => $_POST['name'] ?? null,
      'country_id' => $country_id,
    ];
    $stateValidator = new StateValidator($state);
    $errors = $stateValidator->validate();
    if(count($errors) == 0) {
      $stateModel = new State();
      if($stateModel->insert($state)) {
        $this->feedback->flashSuccess('Provincia insertada')->redirect('/paises/' . $country_id);
      } else {
        $errors[] = 'No se ha podido insertar...';
      }
    }

    return $this->response($this->render('sections/countries/single', [
      'country' => $country,
      'old' => $state,
      'errors' => $errors,
    ]));
  }
}