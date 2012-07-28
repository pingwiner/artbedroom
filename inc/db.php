<?php

class Db {
  static protected $conn;
  
  public static function connect() {
    self::$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS)
      or die("Could not connect to MySQL.");
    mysql_set_charset('utf8', self::$conn);
    mysql_select_db(MYSQL_BASE, self::$conn)
      or die("Could not select database.");
  }

  public static function query($query) {
    return mysql_query($query, self::$conn);
  }

  public static function row($qresult) {
    if (!$qresult) return false;
    return mysql_fetch_array($qresult);
  }

  public static function insert($table, $args) {
    $names_components = array();
    $values_components = array();
    foreach($args as $k => $v) {
        if (is_array($v)) continue;
        if (is_integer($k)) continue;
        $names_components[] = "`".  mysql_real_escape_string($k)."`";
        $values_components[] = "'".  mysql_real_escape_string($v)."'";        
    }
    $names = implode(', ', $names_components);
    $values = implode(', ', $values_components);
    $sql = "insert into `".mysql_real_escape_string($table)."` ($names) values ($values)";
    self::query($sql);
  }
  
  private static function prepare_conditions($cond) {
    if (!is_array($cond)) return '';
    $where = ' where ';
    $conditions = array();
    foreach($cond as $k => $v) {
      $conditions[] = "`". mysql_real_escape_string($k) ."` = '". mysql_real_escape_string($v) ."' ";
    }
    $where .= implode(' and ', $conditions);    
    return $where;
  }
  
  public static function update($table, $args, $cond = null) {
    if (!is_array($args)) return;
    $sql = "update `".  mysql_real_escape_string($table). "` set ";
    $fields = array();
    foreach ($args as $k => $v) {
      if (is_integer($k)) continue;
      if (is_array($v)) continue;
      $fields[] = "`".mysql_real_escape_string($k)."` = '".mysql_real_escape_string($v)."'";
    }
    $sql .= implode(', ', $fields);
    $sql .= self::prepare_conditions($cond);
    self::query($sql);
  }
  
  /*
   * select(
   *    'table_name', 
   *    array('id' => 1), 
   *    array('user_name', 'user_age'),
   *    array(   //order
   *      'fields' => array('id'),
   *      'desc' => true,
   *    ),
   *    array(   //limit 
   *      'offset' => 5,
   *      'count' => 10
   *    )
   *  );
   */
  public static function select($table, $cond = null, $select_fields = null, $order = null, $limit = null) {
     $fields = '';
     if (is_array($select_fields)) {
       $components = array();
       foreach($select_fields as $v) {
         $components[] = "`". mysql_real_escape_string($v) ."`";;
       }
       $fields .= implode(', ', $components);
     } else {
       $fields = "*";
     }
     $sql = "select $fields from `".mysql_real_escape_string($table)."` " . self::prepare_conditions($cond);
     
     if (is_array($order)) {
       $order_fields = array();
       $desc = false;
       if (isset($order['desc']) && ($order['desc'])) $desc = true;
       foreach($order['fields'] as $f) {
         $order_fields[] = mysql_real_escape_string($f);
       }
       $sql .= " order by `".implode('`, `', $order_fields).'`';
       if ($desc) $sql .= ' desc';
     } else if ($order) {
       $sql .= " order by `".mysql_real_escape_string($order) . "`";
     }

     $offset = 0;
     $count = 0;
     if (is_array($limit)) {
       $offset = $limit['offset'];
       $count = $limit['count'];       
     } else {
      $count = $limit;  
     }
     $offset = intval($offset);
     $count = intval($count);
     if ($offset && $count) {
       $sql .= " limit $offset, $count";
     } else if ($count) {
       $sql .= " limit $count";
     }
     
     return self::query($sql);
  }
  
  public static function delete($table, $cond = null) {
    $sql = "delete from `".mysql_real_escape_string($table)."` ".self::prepare_conditions($cond);
    self::query($sql);
  }
  
  public static function count($table, $cond = null) {
    $sql = "select count(*) as `cnt` from `".mysql_real_escape_string($table)."` ". self::prepare_conditions($cond);
    $q = self::query($sql);
    $r = Db::row($q);
    if ($r) return $r['cnt'];
    return 0;
  }
  
  public static function last_id() {
    $sql = "select last_insert_id() as `id`";
    $q = self::query($sql);
    $r = self::row($q);
    return $r['id'];
  }
}