<?php

class ActionController {
  private $params;
  private $product;
  private $valid;
  
  public function __construct($params) {
    $this->params = $params;
    $this->valid = false;
    $this->product = null;
    $this->load();
  }
  
  private function load() {
    $id = $this->getParam('id', 0);
    if (!$id) return '';
    
    $q = Db::select('products', array(
      'id' => $id,
      'visible' => 1,  
    ));
    if ($this->product = Db::row($q)) $this->valid = true;     
  }
  
  private function getParam($paramName, $defaultValue = null) {
    if (isset($this->params[$paramName])) return $this->params[$paramName];
    return $defaultValue;
  }
  
  private function getOptions($optName, $pid) {
    $result = array();
    if (!in_array($optName, array('size', 'color'))) return $result;
    $pid = intval($pid);
    
    $q = Db::query("select s.id, s.name from `product_'.$optName.'s` as `ps`
      left join `'.$optName.'s` as `s` on s.id = ps.'.$optName.'_id
      where ps.product_id = ". $pid);
    
    while($r = Db::row($q)) {
      $result[$r['id']] = $r['name'];
    }
    
    return $result;
  }

  public function getTitle() {
    if (!$this->valid) return '';
    return $this->product['title'];
  }
  
  public function getDescription() {
    if (!$this->valid) return '';
    return $this->product['description'];
  }
  
  public function getContent() {
    if (!$this->valid) return '';

    $tpl = new Tpl('product');
    $result = '';
    $r = $this->product;
    $q2 = Db::select('materials', array('id' => $r['material_id']));
    if ($r2 = Db::row($q2)) $material = $r2['name']; else $material = '';

    $catalog = '';
    $catalog_id = '';
    $q2 = Db::select('menu', array('id' => $r['catalog']));
    if ($r2 = Db::row($q2)) {
      $catalog = $r2['title'];
      $catalog_id = $r2['id'];
    }
    
    $sizes = $this->getOptions('size', $r['id']);
    $colors = $this->getOptions('color', $r['id']);

    $result .= $tpl->build(array(
      '{ID}' => $r['id'],
      '{TITLE}' => $r['title'],
      '{SIZE_OPTIONS}' => html_options($sizes),
      '{COLOR_OPTIONS}' => html_options($colors), 
      '{SKU}' => $r['sku'],  
      '{DESCRIPTION}' => $r['description'],  
      '{PRICE}' => getUserPrice($r).'р.',
      '{QTY}' => $r['qty'],  
      '{MATERIAL}' => $material,  
      '{CATALOG}' => $catalog,  
      '{CATALOG_ID}' => $catalog_id,          
    ));    
    return $result;
  }
  
}