<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS sections (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    adviser_id INT(6) UNSIGNED,
    year_level INT(3) NOT NULL,
    section_name VARCHAR(16) NOT NULL,
    school_year INT(6) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_AdviserSection FOREIGN KEY (adviser_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table sections created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>