<?php
$hostname = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($hostname, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database

$conn->query("CREATE DATABASE IF NOT EXISTS elearn_db");
// if($conn->query("CREATE DATABASE IF NOT EXISTS elearn_db") == TRUE)
//   header("location: frontend/index.php");
  
$conn->close();
?>