<?php

// sql to create table
$sql = "CREATE TABLE assignments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sg_id INT(6) UNSIGNED NOT NULL,
    assignment_title VARCHAR(32) NOT NULL,
    assignment_instruction VARCHAR(256) NOT NULL,
    submission_type ENUM('FILE_UPLOAD', 'TEXTBOX') NOT NULL,
    max_score INT(6) NOT NULL,
    isPublished TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    close_datetime DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SubGroupAssignment FOREIGN KEY (sg_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable assignments created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>