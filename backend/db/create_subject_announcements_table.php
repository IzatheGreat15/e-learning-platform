<?php
// sql to create table
$sql = "CREATE TABLE subject_announcements (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    announcer_id INT(6) UNSIGNED NOT NULL,
    announcement_title VARCHAR(256) NOT NULL,
    announcement_body VARCHAR(1080) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_AnnouncerSA FOREIGN KEY (announcer_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable subject_announcements created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>