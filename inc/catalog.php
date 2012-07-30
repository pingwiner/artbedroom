<?php

  function getSubItems($id) {
    $res = array();
    $q = Db::select('menu');    
    while ($r = Db::row($q)) {
      $res[$r['id']] = $r;      
    }
    return $res;
  }


?>
