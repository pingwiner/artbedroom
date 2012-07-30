<?php
  
  require_once('inc/config.php');
  require_once('inc/common.php');
  require_once('inc/db.php');
  require_once('inc/tpl.php');
  require_once('inc/helpers.php');    
  require_once('inc/settings.php');   
  require_once('inc/catalog.php');   

  $settings = new Settings(); 
  
  session_start();
  Db::connect();
  
  $catalog =   
  
  $tpl = new Tpl('page');  
   
  print $tpl->build(array(
    '{CONTENT}' => $content,
    '{CATALOG}' => $catalog,  
  ));
  exit;  
