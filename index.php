<?php
  
  require_once('inc/config.php');
  require_once('inc/common.php');
  require_once('inc/db.php');
  require_once('inc/tpl.php');
  require_once('inc/helpers.php');    
  require_once('inc/settings.php');   
  require_once('inc/catalog.php');   

  define('PARAM_TYPE_INT', 1);
  define('PARAM_TYPE_STRING', 2);
  
  $settings = new Settings(); 
  
  session_start();
  Db::connect();
  
  $actions = array(
    'catalog' => array(
       'id' => PARAM_TYPE_INT
    )
  );
  
  $action = null;
  if (isset($_GET['action'])) $action = $_GET['action'];
  if (!in_array($action, $actions)) {
    $action = 'catalog';    
  }
  
  $params = array();
  foreach($_GET as $k => $v) {
    if ($k == 'action') continue;
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
  
  $catalog = getMenu();  
  
  $tpl = new Tpl('page');  
   
  $content = '';
  print $tpl->build(array(
    '{CONTENT}' => $content,
    '{CATALOG}' => $catalog,  
  ));
  exit;  
