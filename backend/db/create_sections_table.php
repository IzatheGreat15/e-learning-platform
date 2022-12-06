<?php

// sql to create table
$sql = "CREATE TABLE sections (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year_level INT(3),
    section_name VARCHAR(16),
    school_year INT(6),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable sections created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>