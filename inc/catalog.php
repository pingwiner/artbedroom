<?php

  function getSubitems($id, &$items) {
    $res = array();
    foreach($items as $v) {
      if ($v['parent'] == $id) {
        $res[$v['id']] = $v;
        $res[$v['id']]['subitems'] = getSubitems($v['id'], $items);
      }
    }
    return $res;
  }

  function decorate(&$items, $level = 0) {
    if ($level == 0 )
      $res = '<ul class="dropdown-menu">';
    else
      $res = '<ul class="submenu">';  
    foreach($items as $v) {
      $res .= '<li><a href="/catalog/'.$v['id'].'">'.$v['title'].'</a>'; 
      if (count($v['subitems']) > 0) {
        $res .= decorate($v['subitems'], $level + 1);
      }
      $res .= '</li>';
    }  
    $res .= '</ul>';
    return $res;
  }
  
  function getMenu() {
    $items = array();
    $q = Db::select('menu');    
    while ($r = Db::row($q)) {
      $items[$r['id']] = $r;
    }
    
    $tree = getSubitems(0, $items);
    
    return decorate($tree);
  }


?>
