<?php
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS assignment_files (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ar_id INT(6) UNSIGNED NOT NULL,
    file_location VARCHAR(1080) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_ARAF FOREIGN KEY (ar_id) REFERENCES assignment_responses(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable assignment_files created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>