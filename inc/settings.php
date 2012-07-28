<?php
 
class Settings {
  private $current_page;
  
  public function __construct() {
    $this->current_page = 1;
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
