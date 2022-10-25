<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=parksyoc', 'root', '');
// See the "errors" folder for details...
// If I make a mistake with my PDO please go totally blow it up
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>