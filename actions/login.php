<?php

class ActionController {

  public function __construct($params) {
  }

  public function getTitle() {
    return 'Авторизация';
  }

  public function getDescription() {
    return "Страница авторизаии";
  }

  public function getContent() {
    $tpl = new Tpl('login');

    $result .= $tpl->build(array(
		'{ERROR}' => (isset($_SESSION['bad_pass']))?'inherit':'none'
    ));
    unset($_SESSION['bad_pass']);
    return $result;
  }

}
