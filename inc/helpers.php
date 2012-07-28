<?php

  function html_options($options, $selected = null, $default_value = null) {
    $res = '';
    if ($default_value) {
      $res .= '<option value="0">'.$default_value.'</option>';
    }
    foreach($options as $k => $v) {
      if (is_array($selected)) {
        $sel = (in_array($k, $selected))?'selected="selected"':'';
      } else {
        $sel = ($selected == $k)?'selected="selected"':'';
      }
      $res .= '<option '.$sel.' value="'.$k.'">'.$v.'</option>';
    }
    return $res;
  }
  
  function html_radio($name, $values, $selected = null, $read_only = false) {
    $res = '';
    $disabled = '';
    if ($read_only) $disabled = ' disabled="disabled" ';
    foreach($values as $v) {
      $sel = ($v == $selected)?'checked="checked"':'';
      $res .= '<input '.$sel.$disabled.' type="radio" name="'.$name.'" value="'.$v.'" class="star required" />';
    }
    return $res;
  }

  function take5() {
    $res = array();
    
    for ($i = 0; $i < 5; $i++) {
      $res[$i] = $i;
    }
    return $res;
  }

  function pager($path, $items_per_page, $total, $page) {
    $res = '';
    if ($page > 0) {
      $res .= '<a href="'.$path.'page=0">&lt;&lt;</a> ';
      $res .= '<a href="'.$path.'page='.($page-1).'">&lt;</a> ';
    }
    $total_pages = (int) ($total / $items_per_page);
    if ($total % $items_per_page) $total_pages++;
    
    for($i = 0; $i < $total_pages - 1; $i++) {
      if ($i == $page) {
        $res .= ' '.$i.' ';
      } else {
        $res .= '<a href="'.$path.'page='.$i.'">'.($i + 1).'</a>';
      }
    }
    
    if ($page < $total_pages - 1) {
      $res .= '<a href="'.$path.'page='.($page + 1).'">&gt;</a> ';
      $res .= '<a href="'.$path.'page='.($total_pages - 1).'">&gt;&gt;</a> ';      
    }
    
    return $res;
  }