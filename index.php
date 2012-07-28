<?php
  
  require_once('inc/config.php');
  require_once('inc/common.php');
  require_once('inc/db.php');
  require_once('inc/tpl.php');
  require_once('inc/lang.php');  
  require_once('inc/helpers.php');    
  require_once('inc/db_entities/user.php'); 
  require_once('inc/db_entities/entity.php');   
  require_once('inc/locales.php');   
  require_once('inc/settings.php');   

  $settings = new Settings(); 
  
  session_start();
  Db::connect();
  
  $page_to_save = 0;
  if ( isset($_SESSION['page']) && isset($_POST['page']) ) {
    if ($_SESSION['page'] != $_POST['page']) {
      //page flip occured, so we need to update form data
      $page_to_save = intval($_SESSION['page']);
    }
  }
  
  if (isset($_SESSION['lang'])) $settings->lang($_SESSION['lang']);
  if (isset($_SESSION['page'])) $settings->page($_SESSION['page']);
  
  if (isset($_POST['lang'])) {    
    $settings->lang($_POST['lang']);
    $_SESSION['lang'] = $settings->lang();
    jump('/');
  }
  if (isset($_POST['page'])) {    
    $settings->page($_POST['page']);
  }
    
  $_SESSION['lang'] = $settings->lang();
  $_SESSION['page'] = $settings->page();
  
  $user_id = 0;
  if (isset($_SESSION['user_id'])) $user_id = intval($_SESSION['user_id']);
    
  $loc = Locales::getInstance();
  setlocale(LC_COLLATE | LC_CTYPE, $loc->getCode($settings->lang()));  
  
  $filepath = 'inc/forms/form'.($page_to_save?$page_to_save:$settings->page()).'.php';
  if (file_exists($filepath)) {
    include($filepath);
  }
  
  $errors = array();
  if ($page_to_save) {
    $errors = Form::check($user_id, $_POST);
    if (count($errors) == 0) {
      //user_id is 0 until first page saved
      $_POST['lang'] = $settings->lang();
      $user_id = saveFormData($user_id, $_POST);
      if ($user_id) {
        $_SESSION['user_id'] = $user_id;
      } else { // Ahtung !!!
        unset($_SESSION['user_id']);
        unset($_SESSION['page']);        
      }
      jump('/');
    } else {
      //don't flip page if errors occured
      $_SESSION['page'] = $settings->page($page_to_save);
    }
  }
  
  $data = Form::load($user_id, $settings->lang());
  $data['{PAGE}'] = $settings->page();
  
  $tpl = new Tpl('page');  
  $form = new Tpl('form'.$settings->page());
  
  print $tpl->build(array(
    '{LANGUAGES}' => html_options($loc->getLanguages(), $settings->lang()),  
    '{LANG}' => $settings->lang(),
    '{CONTENT}' => $form->build(
      array_merge($errors, $data),
      $settings->lang(),
      'form'.$settings->page()      
     ),  
  ), $settings->lang());
  if ($settings->page() == 4) {
    $user = User::load($user_id);
    $user['complete'] = 1;
    User::save($user);
    unset($_SESSION['user_id']);
    unset($_SESSION['page']);
  }
  exit;
  
  //-----------------------------------------------//
  
  function saveFormData($user_id, $data) {
    //filter html in user input
    foreach($data as $k => $v) {
      if (!is_array($v)) {
        $data[$k] = strip_tags($v);
      }
    }
    return Form::save($user_id, $data);  
  }

  
