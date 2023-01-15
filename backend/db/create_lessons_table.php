<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS lessons (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    module_id INT(6) UNSIGNED NOT NULL,
    lesson_title VARCHAR(64) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_ModulePage FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table lessons created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>