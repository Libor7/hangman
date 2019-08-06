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
  * Class Database manages database connection and queries 
  *
  */

class Database {

  private $connection;
  private static $servername = 'localhost';
  private static $dbusername = 'root';
  private static $dbpassword = '';
  private static $dbname = 'hangman';
  private static $cities = array();

  public function __construct() {
      $this->connection = new mysqli(self::$servername, self::$dbusername, self::$dbpassword, self::$dbname);
      $this->connection->set_charset('utf8mb4');
  }

  /** Closes connection with the database and destroys the instance of class */
  private function disconnect($connection, $object) {
    $connection->close();
    unset($object);
  }

  /** Selects all records from database and saves them in array, disconnects from the database */
  public function getCities() {
    $query = 'SELECT city FROM cities;';
    $result = $this->connection->query($query);
    $i = 1;
    while($row = $result->fetch_assoc()) {      
      self::$cities[$i] = $row['city'];
      $i++;
    }
    $this->disconnect($this->connection, $this);
    return self::$cities;
  }

  /** Select one city from cities */
  public function getCity($cities, $usedCities = []) {
    if(!empty($usedCities)) {
      do{
        $id = rand(1, 140);
      }while(in_array($id, $usedCities));
      $city = $cities[$id];
      if(count($usedCities) == 100) array_shift($usedCities);
      $usedCities[] = $id;
      $this->disconnect($this->connection, $this);
      return [$city, $usedCities];
    }else{
      $id = rand(1, 140);
      $city = $cities[$id];
      $usedCities[] = $id;
      $this->disconnect($this->connection, $this);
      return [$city, $usedCities];
    }
  }

}