<?php

class ActionController {
  private $params;
  
  public function __construct($params) {
    $this->params = $params;
  }
  
  public function getContent() {
    return '';
  }
  
}