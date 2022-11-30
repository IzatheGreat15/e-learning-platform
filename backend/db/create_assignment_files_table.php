<?php
// sql to create table
$sql = "CREATE TABLE assignment_files (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    AR_id INT(6) UNSIGNED,
    file_location VARCHAR(1080),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_ARAF FOREIGN KEY (AR_id) REFERENCES assignment_responses(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "Table assignment_files created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>