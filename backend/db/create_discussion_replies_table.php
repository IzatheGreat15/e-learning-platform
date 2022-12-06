<?php

// sql to create table
$sql = "CREATE TABLE discussion_replies (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    discussion_id INT(6) UNSIGNED,
    student_id INT(6) UNSIGNED,
    reply_body VARCHAR(1080),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_DiscussionDR FOREIGN KEY (discussion_id) REFERENCES discussions(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE discussion_replies ADD CONSTRAINT FK_StudentDR FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "\nTable discussion_replies created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>