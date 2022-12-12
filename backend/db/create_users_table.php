<?php

// sql to create table
$sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(32) NOT NULL,
    lname VARCHAR(32) NOT NULL,
    pp_location VARCHAR(256) DEFAULT 'student.png',
    role ENUM('STUDENT', 'TEACHER', 'ADMIN') NOT NULL,
    address VARCHAR(128),
    contact_num VARCHAR(15),
    email VARCHAR(72) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable users created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>