<?php

class Tpl {
  private $html;
  
  public function __construct($name) {
    //запрет на выход из каталога TEMPLATES_FOLDER
    if (strpos($name, '..') !== false) return '';
    $full_name = TEMPLATES_FOLDER.'/'.$name.'.tpl';
    if (!file_exists($full_name)) return '';
    //загрузка шаблона
    $this->html = file_get_contents($full_name);
  }

  //замена тэгов в шаблоне
  public function build($args, $lang, $dict = 'common') {
    $l = Lang::getInstance();
    $res = $l->translateTokens($lang, $this->html, $dict);
    if (is_array($args)) {
      $res = str_replace(array_keys($args), array_values($args), $res);
    }
    return preg_replace("/\{[A-Z_]+\}/", '', $res);    
  }
  
}
