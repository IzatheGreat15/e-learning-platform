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
$needSeed = $conn->query($sql) === TRUE ? 1 : 0;

header("location: frontend/index.php");
$conn->close();
?>