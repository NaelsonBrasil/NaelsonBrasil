<?php

class Mysql
{

  public $conn;
  public $error = false;
  function __construct($host = 0, $username = 0, $password = 0, $dbname = 0, $port = 0)
  {

    $this->conn = new mysqli($host, $username, $password, $dbname, $port);

    if($this->conn->connect_error) {

      $this->error = true;
      $this->conn->close();
    }
  }
}
