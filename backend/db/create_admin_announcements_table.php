<?php
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS admin_announcements (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    announcement_title VARCHAR(256) NOT NULL,
    announcement_body VARCHAR(15000) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable admin_announcements created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>