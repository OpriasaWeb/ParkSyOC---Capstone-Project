<?php

try {
  //code...
  $db = new PDO("mysql:host=localhost; dbname=parksyoc; charset=utf8", "root", "");

} catch (PDOException $e) {
  //throw $th;
  echo $e->getMessage();
}



?>