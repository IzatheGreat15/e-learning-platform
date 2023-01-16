<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(32) NOT NULL,
    lname VARCHAR(32) NOT NULL,
    pp_location VARCHAR(256) DEFAULT 'student.png',
    role ENUM('STUDENT', 'TEACHER', 'ADMIN', 'REGISTRAR') NOT NULL,
    address VARCHAR(128),
    contact_num VARCHAR(15),
    email VARCHAR(72) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL,
    token VARCHAR(256),
    verified_on DATETIME,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table users created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>