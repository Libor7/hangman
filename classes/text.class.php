<?php 

 /**
  *
  * Prevents direct access to this file 
  *
  */

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  exit('Direct access denied');
}


 /**
  *
  * Class Text handles all the operations with text content of the application 
  *
  */

class Text {

  private static $appname = 'Šibenica';
  private $city;
  private $hidden = array();
  private $formatted;
  private static $invitation = 'Uhádnite názvy slovenských miest';
  private static $moreinfo = 'Po stlačení tlačidla Nová hra si hráč zvolí obtiažnosť a následne sa mu zobrazí nevyplnená tajnička. Hráč háda písmená v tajničke, uhádnuté písmená sa zobrazia v slove. Po vyčerpaní pokusov a neuhádnutí hra končí. Stlačenie tlačidla Nová hra v priebehu hry ukončuje rozohratú a automaticky začína novú hru.';

  public function __construct($city = NULL) {
    $this->city = $city;
  }

  /** Returns the name of the city */
  public function getCity() {
    return $this->city;
  }

  /** Returns the name of the application */
  public function getAppName() {
    return self::$appname;
  }

  /** Returns the invitation text */
  public function getInvitation() {
    return self::$invitation;
  }

  /** Returns short game instruction */
  public function getMoreInfo() {
    return self::$moreinfo;
  }

  /** Receives the name of the city and returns its hidden form */
  public function hideCity() {
    if(mb_strpos($this->city, '-') === FALSE) {
      $words = explode(' ', $this->city);
      foreach($words as $key => $val) {
        $word = '';
        for($i = 0; $i < mb_strlen($val); $i++) {
          $word .= ' ';
        }
        $this->hidden[] = $word;
      }
      return $this->hidden;
    }else{
      $words = explode('-', $this->city);
      $last = end($words);
      $word = '';
      foreach($words as $key => $val) {
        $temp = '';
        for($i = 0; $i < mb_strlen($val); $i++) {
          $temp .= ' ';
        }
        if($val != $last) {
          $temp .= '-';
        }
        $word .= $temp;
      }
      $this->hidden[] = $word;
      return $this->hidden;
    }
  }

  /** Converts characters into lowercase and into format compatible with ASCII and returns it back */
  private function format($city) {
    $chars = array('ä'=>'a', 'Ä'=>'A', 'á'=>'a', 'Á'=>'A', 'č'=>'c', 'Č'=>'C', 'ď'=>'d', 'Ď'=>'D', 'ě'=>'e', 'Ě'=>'E', 
'é'=>'e', 'É'=>'E', 'ë'=>'e', 'Ë'=>'E', 'í'=>'i', 'Í'=>'I', 'ľ'=>'l', 'Ľ'=>'L', 'ĺ'=>'l', 'Ĺ'=>'L', 'ň'=>'n', 'Ň'=>'N',     'ó'=>'o', 'Ó'=>'O', 'ö'=>'o', 'Ö'=>'O', 'ô'=>'o', 'Ô'=>'O', 'ř'=>'r', 'Ř'=>'R', 'ŕ'=>'r', 'Ŕ'=>'R', 'š'=>'s', 'Š'=>'S', 
'ť'=>'t', 'Ť'=>'T', 'ú'=>'u', 'Ú'=>'U', 'ü'=>'u', 'Ü'=>'U', 'ý'=>'y', 'Ý'=>'Y', 'ž'=>'z', 'Ž'=>'Z');

    $this->formatted = mb_strtolower(strtr($city, $chars));
    return $this->formatted;
  }

  /** Finds all characters in a string */
  public function findChars($string, $char) {
    $chars = array();
    $string = $this->format($string);
    $char = $this->format($char);
    $array = explode(' ', $string);

    foreach($array as $arr) {
      $temp = array();
      $result = mb_strpos($arr, $char);

      if($result === FALSE) {
        $chars[] = $temp;
      }else{
        do{
          $temp[] = $result;
          $offset = ++$result;
          $result = mb_strpos($arr, $char, $offset);
        }while($result !== FALSE);
        $chars[] = $temp;
      }
    }
    return $chars;
  }

  /** Displays the individual letters in the name of the city */
  public function update($city, $chars, $result = []) {
    if(empty($result)) {
      $city = explode(' ', $city);
      $arr = array();
      foreach($city as $key => $val) {
        if(!empty($chars[$key])) {
          $len = mb_strlen($val);
          $str = '';
          for($i = 0; $i < $len; $i++) {
            if(in_array($i, $chars[$key])) {
              $char = mb_substr($val, $i, 1);
              $str .= $char;
            }else{
              if(mb_substr($val, $i, 1) == '-') {
                $str .= '-';
              }else{
                $str .= ' ';
              }
            }
          }
          $arr[] = $str;
        }else{
          $len = mb_strlen($val);
          $str = '';
          for($i = 0; $i < $len; $i++) {
            if(mb_substr($val, $i, 1) == '-') {
              $str .= '-';
            }else{
              $str .= ' ';
            }
          }
          $arr[] = $str;
        }
      }
      return $arr;
    }else{
      $city = explode(' ', $city);
      $arr = array();
      foreach($city as $key => $val) {
        if(!empty($chars[$key])) {
          $len = mb_strlen($val);
          $str = '';
          for($i = 0; $i < $len; $i++) {
            if(in_array($i, $chars[$key])) {
              $char = mb_substr($val, $i, 1);
              $str .= $char;
            }else{
              $char = mb_substr($result[$key], $i, 1);
              $str .= $char;
            }
          }
          $arr[] = $str;
        }else{
          $arr[] = $result[$key];
        }
      }
      return $arr;
    }
  }

}