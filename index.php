<?php
  
  require_once('inc/config.php');
  require_once('inc/common.php');
  require_once('inc/db.php');
  require_once('inc/tpl.php');
  require_once('inc/helpers.php');    
  require_once('inc/catalog.php');   
  require_once('inc/price.php');   

  define('PARAM_TYPE_INT', 1);
  define('PARAM_TYPE_STRING', 2); 
  
  session_start();
  Db::connect();
  
  $actions = array(
    'catalog' => array(
       'id' => PARAM_TYPE_INT
    ),
    'product' => array(
       'id' => PARAM_TYPE_INT
    ),      
    'payment' => array(
        
    ),
    'contacts' => array(
        
    ),
    'search' => array(
      '#post' => true,  
      'q'     => PARAM_TYPE_STRING  
    ),  
    'buy' => array(
      '#post'     => true,   
      '#ajax'     => true,  
      'id'        => PARAM_TYPE_INT,
      'color'     => PARAM_TYPE_INT,
      'size'      => PARAM_TYPE_INT,
      'phone'     => PARAM_TYPE_STRING,
      'username'  => PARAM_TYPE_STRING,
      'message'   => PARAM_TYPE_STRING,        
    ),
    'index' => array(       
    )  
  );

  $action = 'index';
  if (isset($_GET['action'])) $action = $_GET['action'];
  if (!key_exists($action, $actions)) {
    $action = 'index';    
  } 
  
  $params = array();
  if (isset($actions[$action]['#post']) && ($actions[$action]['#post'] == true))
    $data = &$_POST;
  else
    $data =&$_GET;
  
  if (isset($actions[$action]['#ajax']) && ($actions[$action]['#ajax'] == true))
    $ajax = true;
  else
    $ajax = false;
  
  foreach($data as $k => $v) {    
    if ($k == 'action') continue;
    if (substr($k, 0, 1) == '#') continue;
    if (!isset($actions[$action][$k])) continue;
    switch($actions[$action][$k]) {
      case PARAM_TYPE_INT:
        $params[$k] = intval($v);
        break;
      case PARAM_TYPE_STRING:
        $params[$k] = $v;
        break;
    }    
  }
  
  include('actions/'.$action.'.php');
  $ac = new ActionController($params);
  $content = $ac->getContent();  
  if ($ajax) {
    print $content;
    exit;
  }  
  $catalog = getMenu();  
  $title = $ac->getTitle();
  if ($title) $title .= ' - ';
  $description = $ac->getDescription();
  
  $tpl = new Tpl('page');     

  print $tpl->build(array(
    '{CONTENT}' => $content,
    '{CATALOG}' => $catalog,  
    '{TITLE}' => strip_tags($title),
    '{DESCRIPTION}' => strip_tags($description),  
    '{PAYMENT_ACTIVE}' => ($action == 'payment')?'active':'',
    '{CONTACTS_ACTIVE}' => ($action == 'contacts')?'active':'',      
    '{CATALOG_ACTIVE}' => (in_array($action, array('catalog', 'product')))?' active':'',  
  ));
  exit;  
