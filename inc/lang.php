<?php

class Lang {
  private $lang_arr;  
  protected static $instance;
  
  private function __construct() {
    $this->lang_arr = array();
  }
  
  public static function getInstance() { 
    if ( is_null(self::$instance) ) {
      self::$instance = new Lang;
    }
    return self::$instance;
  }
  
  private function loadDictionary($lang, $dict) {
    if (!isset($this->lang_arr[$lang][$dict])) {
      $this->lang_arr[$lang][$dict] = array();
      $strings = file('lang/'.$lang.'/'.$dict.'.lng', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      if (!$strings) return '';
      foreach($strings as $s) {
        $a = explode('|', $s);
        $this->lang_arr[$lang][$dict][trim($a[0])] = trim($a[1]);
      }
    }    
  }
  
  public function translate($lang, $key, $dict = 'common') {
    $key = trim($key);
    if (!isset($this->lang_arr[$lang])) $this->lang_arr[$lang] = array();
    $this->loadDictionary($lang, $dict);
    if (isset($this->lang_arr[$lang][$dict][$key])) return $this->lang_arr[$lang][$dict][$key];
    return '';
  }
  
  public function translateTokens($lang, $text, $dict = 'common') {
    $this->loadDictionary($lang, $dict);
    $arr = array();
    foreach($this->lang_arr[$lang][$dict] as $k => $v) {
      $arr['{'.$k.'}'] = $v;
    }
    $text = str_replace(array_keys($arr), array_values($arr), $text);
    return preg_replace("/\{[a-z_]+\}/", '', $text);    
  } 
  
}