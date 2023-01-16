<?php
// $hostname = "localhost";
// $username = "root";
// $password = "";

$hostname = "localhost";
$username = "u342914934_mysqldbname113";
$password = "gKiek]t9*u9X";

// Create connection
$conn = new mysqli($hostname, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database

if($conn->query("CREATE DATABASE IF NOT EXISTS elearn_db") == TRUE)
  header("location: frontend/index.php");
  
$conn->close();
?>