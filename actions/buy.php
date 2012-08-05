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
    $id = $this->getParam('id');
    $color = $this->getParam('color');
    $size = $this->getParam('size');
    $phone = $this->getParam('phone');
    $username = $this->getParam('username');
    $message = $this->getParam('message');
    
    $q = Db::select('products', array('id' => $id));
    $product = Db::row($q);
    if (!$product) return 'fail';
    
    Db::insert('orders', array(
      'product_id' => $id,
      'color' => $color,
      'size' => $size,
      'phone' => $phone,
      'username' => $username,
      'message' => $message        
    ));
    
    $tpl = new Tpl('email');
    mail('i486dx@yandex.ru', 
         'Новый заказ в магазине Art bedroom', 
         $tpl->build(array(
           '{ID}' => $product['id'],
           '{TITLE}' => $product['title'],
           '{SKU}' => $product['sku'],      
           '{PHONE}' => $phone,
           '{USERNAME}' => $username,
           '{MESSAGE}' => $message 
         )),
         'From: robot@artbedroom.ru' . "\r\n" .
         'Reply-To: robot@artbedroom.ru'. "\r\n".
         'MIME-Version: 1.0' . "\r\n".
         'Content-type: text/plain; charset=UTF-8');
    return 'ok';
  }

  public function getTitle() {
    return '';  
  }
  
  public function getDescription() {
    return '';
  }
  
}