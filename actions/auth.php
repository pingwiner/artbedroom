<?php

class ActionController {
  private $params;

  public function __construct($params) {
	  if (($params['username'] == ADMIN_USERNAME) && ($params['password'] == ADMIN_PASS)) {
		$_SESSION['authorized'] = true;
		unset($_SESSION['bad_pass']);
	  } else {
		$_SESSION['bad_pass'] = true;
	  }
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
