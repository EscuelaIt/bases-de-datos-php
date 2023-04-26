<?php

namespace App;

class Feedback {

  public function __construct() {
    session_start();
    if(! isset($_SESSION['feedback_success'])) {
      $_SESSION['feedback_success'] = [];
    }
    if(! isset($_SESSION['feedback_error'])) {
      $_SESSION['feedback_error'] = [];
    }
  }

  public function flashSuccess($message) {
    $_SESSION['feedback_success'][] = $message;
    return $this;
  }

  public function flashError($message) {
    $_SESSION['feedback_error'][] = $message;
    return $this;
  }

  public function flashErrorArray($array) {
    foreach($array as $message) {
      $this->flashError($message);
    }
    return $this;
  }

  public function redirect($url) {
    header("location: $url");
    exit;
  }


  

  public static function showFeedback($templateSystem) {
    if(isset($_SESSION['feedback_success']) && count($_SESSION['feedback_success']) > 0) {
      echo $templateSystem->insert('partials/feedback', [
        'messages' => $_SESSION['feedback_success'],
        'status' => 'success',
      ]);
    }
    if(isset($_SESSION['feedback_error']) && count($_SESSION['feedback_error']) > 0) {
      echo $templateSystem->insert('partials/feedback', [
        'messages' => $_SESSION['feedback_error'],
        'status' => 'error',
      ]);
    }
    $_SESSION['feedback_success'] = [];
    $_SESSION['feedback_error'] = [];
  }

  
}