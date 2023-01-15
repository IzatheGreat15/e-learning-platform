<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS discussions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sg_id INT(6) UNSIGNED NOT NULL,
    discussion_title VARCHAR(256) NOT NULL,
    discussion_instruction VARCHAR(15000) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SGDiscussions FOREIGN KEY (sg_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table discussions created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>