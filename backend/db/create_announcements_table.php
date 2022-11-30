<?php
// sql to create table
$sql = "CREATE TABLE announcements (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    announcer_id INT(6) UNSIGNED,
    announcer_type ENUM('ADVISER', 'SUBJECT') NOT NULL,
    announement_body VARCHAR(1080),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "Table announcements created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>