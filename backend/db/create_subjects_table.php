<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS subjects (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT(6) UNSIGNED NOT NULL,
    subject_name VARCHAR(32) NOT NULL,
    year_level INT(3) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_TeacherSubject FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table subjects created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>