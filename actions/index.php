<?php

class ActionController {
  private $params;
  
  public function __construct($params) {
    $this->params = $params;
  }
  
  private function getParam($paramName, $defaultValue = null) {
    if (isset($this->params[$paramName])) return $this->params[$paramName];
    return $defaultValue;
  }
  
  public function getContent() {
    $tpl = new Tpl('index');
    return $tpl->build();
  }

  public function getTitle() {
    return '';  
  }
  
  public function getDescription() {
    return '';
  }
  
}