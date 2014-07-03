<?php

class ActionController {
  private $params;

  public function __construct($params) {
	unset($_SESSION['authorized']);
  }

  public function getTitle() {
    return 'Авторизация';
  }

  public function getDescription() {
    return "Страница авторизаии";
  }

  public function getContent() {
	jump('index.php');
    return '';
  }

}

