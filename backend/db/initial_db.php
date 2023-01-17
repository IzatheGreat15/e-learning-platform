<?php
include("../credentials.php");
// Create connection
$conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database

if($conn->query("CREATE DATABASE IF NOT EXISTS elearn_db") == TRUE)
  header("location: frontend/index.php");
  
$conn->close();
?>