<?php
    include("config.php");

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(32) NOT NULL,
    lname VARCHAR(32) NOT NULL,
    roles ENUM('STUDENT', 'TEACHER', 'ADMIN') NOT NULL,
    address VARCHAR(128) NOT NULL,
    contact_num VARCHAR(15) NOT NULL,
    email VARCHAR(72) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "Table users created successfully";
} else {
  echo "Error creating table: " . $db->error;
}

$db->close();
?>