<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_management";



//credentials for connecting database with php
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $excep) {
    echo "Connection failed: " . $excep->getMessage();
    exit();
  }
?>