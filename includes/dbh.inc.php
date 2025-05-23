<?php
//$dsn: Data Source Name
$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = "root";
$dbpassword = "";

//conection to the database and error handling message
try {
   //pdo= php data object that is used to connect to a database
  $pdo = new PDO($dsn, $dbusername, $dbpassword); //this line of code alone can connect to the database
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //error handling
} catch (PDOException $e) {
   echo "Connection failed: ".$e->getMessage(); //error handling
}