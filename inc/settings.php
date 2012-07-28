<?php

require_once('inc/locales.php');   
 
class Settings {
  private $language;
  private $current_page;
  
  public function __construct() {
    $this->language = 'ru';
    $this->current_page = 1;
  }
  
  public function lang($new_lang = null) {
    $loc = Locales::getInstance();
    if ($new_lang) {
      if ($loc->localeExists($new_lang)) {
        $this->language = $new_lang;
      }
    }
    return $this->language;
  }
  
  public function page($new_page = null) {
    if ($new_page) {
      $new_page = intval($new_page);
      if ($new_page < 1) $new_page = 1;
      if ($new_page > 5) $new_page = 5;
      $this->current_page = $new_page;
    }
    return $this->current_page;
  }
  
  
}

?>
