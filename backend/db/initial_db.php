<?php
$hostname = "localhost";
$username = "u342914934_marickuser";
$password = ":F5t3XlQTPM8";

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