<?php

class DB {
  private $host;
  private $db;
  private $user;
  private $password;
  private $charset;

  public function __construct()
  {
    $this->charset  = 'utf8mb4';
    $this->db       = 'test_db';
    $this->host     = 'localhost';
    $this->password = '';
    $this->user     = 'root';
  }

  function connect()
  {
    try {
      $connection = "mysql:dbname=".$this->db.";host=".$this->host.";charset=".$this->charset;

      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
      ];

      $pdo = new PDO($connection, $this->user, $this->password, $options);

      return $pdo;
    } catch (PDOException $error) {
      print_r('Error connection: ' . $error->getMessage());
    }
  }
}
