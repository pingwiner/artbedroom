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
    $search = $this->getParam('q');
    if (!$search) return 'Ничего не найдено';
    $search = mysql_real_escape_string($search);
    $q = Db::query("select p.id, p.title from `products` as p
            left join `materials` as m on m.id = p.material_id
      where p.title LIKE '%$search%' 
            or p.description LIKE '%$search%'
            or m.name LIKE '%$search%'
            or p.sku = '$search'");
    $tpl = new Tpl('product_preview');
    $result = '';
    while($r = Db::row($q)) {
      $result .= $tpl->build(array(
        '{ID}' => $r['id'],
        '{TITLE}' => $r['title']  
      ));
    }
    $tpl = new Tpl('catalog');
    return $tpl->build(array(
      '{TITLE}' => $search,  
      '{CONTENT}' => $result 
    ));            
  }

  public function getTitle() {
    return '';  
  }
  
  public function getDescription() {
    return '';
  }
  
}