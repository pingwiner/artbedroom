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
    $id = $this->getParam('id', 0);
    if (!$id) return '';
    
    $q = Db::select('products', array('id' => $id));
    $tpl = new Tpl('product');
    $result = '';
    while($r = Db::row($q)) {
      $result .= $tpl->build(array(
        '{ID}' => $r['id'],
        '{TITLE}' => $r['title']  
      ));
    }
    return $result;
  }
  
}