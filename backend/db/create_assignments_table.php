<?php

// sql to create table
$sql = "CREATE TABLE assignments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sg_id INT(6) UNSIGNED,
    assignment_title VARCHAR(32),
    assignment_instruction VARCHAR(256),
    submission_type ENUM('FILE_UPLOAD', 'TEXTBOX'),
    max_score INT(6),
    isPublished BOOLEAN DEFAULT FALSE,
    close_datetime DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SubGroupAssignment FOREIGN KEY (sg_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "Table assignments created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>