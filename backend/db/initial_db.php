<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($hostname, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE elearn_db";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  $conn->query("DROP DATABASE elearn_db");
  $conn->query("CREATE DATABASE elearn_db");
  //echo "Error creating database: " . $conn->error;
}

$conn->close();
?>