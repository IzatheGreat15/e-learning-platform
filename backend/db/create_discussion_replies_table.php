<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS discussion_replies (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    discussion_id INT(6) UNSIGNED NOT NULL,
    student_id INT(6) UNSIGNED NOT NULL,
    reply_body VARCHAR(15000) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_DiscussionDR FOREIGN KEY (discussion_id) REFERENCES discussions(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE discussion_replies ADD CONSTRAINT FK_StudentDR FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "\n<br>Table discussion_replies created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>