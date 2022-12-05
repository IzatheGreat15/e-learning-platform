<?php

// sql to create table
$sql = "CREATE TABLE modules (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_id INT(6) UNSIGNED,
    module_title VARCHAR(64),
    module_description VARCHAR(256),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SubjectModule FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "Table modules created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>