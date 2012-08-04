<?php

class ActionController {
  private $params;
  private $catalog;
  private $valid;
  
  public function __construct($params) {
    $this->params = $params;
    $this->valid = false;
    $id = $this->getParam('id');
    $q = Db::select('menu', array('id' => $id));
    if ($this->catalog = Db::row($q)) $this->valid = true;
  }
  
  private function getParam($paramName, $defaultValue = null) {
    if (isset($this->params[$paramName])) return $this->params[$paramName];
    return $defaultValue;
  }
  
  public function getContent() {
    $id = $this->getParam('id');
    if (!$id) return '';
    
    if ($id)
      $q = Db::select('products', array(
        'catalog' => $id,
        'visible' => 1,      
      ));
    else 
      $q = Db::select('products');
    $tpl = new Tpl('product_preview');
    $result = '';
    while($r = Db::row($q)) {
      $result .= $tpl->build(array(
        '{ID}' => $r['id'],
        '{TITLE}' => $r['title']  
      ));
    }
    return $result;
  }

  public function getTitle() {
    if (!$this->valid) return '';
    return $this->catalog['title'];  
  }
  
  public function getDescription() {
    if (!$this->valid) return '';
    return $this->catalog['title'];  
  }
  
}