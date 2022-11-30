<?php

// sql to create table
$sql = "CREATE TABLE sections (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    adviser_id INT(6) UNSIGNED,
    year_level INT(3),
    section_name VARCHAR(16),
    school_year VARCHAR(5),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_AdviserSection FOREIGN KEY (adviser_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "Table sections created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>