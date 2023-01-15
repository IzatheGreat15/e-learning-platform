<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS messages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    thread_id INT(6) UNSIGNED NOT NULL,
    sender_id INT(6) UNSIGNED NOT NULL,
    message_body VARCHAR(15000) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_ThreadMessage FOREIGN KEY (thread_id) REFERENCES threads(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE messages ADD CONSTRAINT FK_SenderMessage FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "\n<br>Table messages created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>