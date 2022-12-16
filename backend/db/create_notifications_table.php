<?php
// sql to create table
$sql = "CREATE TABLE notifications (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sg_id INT(6) UNSIGNED NOT NULL,
    message VARCHAR(1080) NOT NULL,
    link VARCHAR(1080) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SGNotification FOREIGN KEY (sg_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql)) {
  echo "\nTable notifications created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>