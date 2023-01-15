<?php
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS subject_announcements (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    announcer_id INT(6) UNSIGNED NOT NULL,
    announcement_title VARCHAR(256) NOT NULL,
    announcement_body VARCHAR(15000) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_AnnouncerSA FOREIGN KEY (announcer_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\n<br>Table subject_announcements created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>