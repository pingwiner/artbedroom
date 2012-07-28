<?php

  define('FIELD_TYPE_STRING', 1);
  define('FIELD_TYPE_INT', 2);
  define('FIELD_TYPE_ARRAY', 3);

//go to url
function jump($url) {
    header('Location: '.$url);
    die;
}

//default argument  
function def($a, $b) {
    return $a?$a:$b;
}

//safe array copy
function safeCopy(&$dest, $source, $fields) {
  foreach($fields as $field_name => $field_type) {
    if (!isset($source[$field_name])) {
      switch($field_type) {
        case FIELD_TYPE_INT:
          $source[$field_name] = 0;
          break;
        case FIELD_TYPE_STRING:
          $source[$field_name] = '';
          break;
        default:
          continue;
      }      
    }
    switch($field_type) {
      case FIELD_TYPE_INT:
        $dest[$field_name] = intval($source[$field_name]);
        break;
      case FIELD_TYPE_STRING:
        $dest[$field_name] = (string)$source[$field_name];
        break;
      case FIELD_TYPE_ARRAY:
        if (!is_array($source[$field_name])) {
          $dest[$field_name] = array($source[$field_name]);          
        } else {
          $dest[$field_name] = $source[$field_name];          
        }
        break;
    }      
  }  
}