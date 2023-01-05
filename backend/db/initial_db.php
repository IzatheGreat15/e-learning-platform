<?php
$hostname = "127.0.0.1";
$username = ":F5t3XlQTPM8";
$password = "";

// Create connection
$conn = new mysqli($hostname, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = $conn->query("CREATE DATABASE IF NOT EXISTS elearn_db");
if($sql === TRUE)
  header("location: frontend/index.php");
  
$conn->close();
?>