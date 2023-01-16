<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS modules (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sg_id INT(6) UNSIGNED NOT NULL,
    module_title VARCHAR(64) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SGModule FOREIGN KEY (sg_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table modules created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>