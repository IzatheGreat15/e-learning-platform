<?php

// sql to create table
$sql = "CREATE TABLE messages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    thread_id INT(6) UNSIGNED,
    sender_id INT(6) UNSIGNED,
    message_body VARCHAR(256),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_ThreadMessage FOREIGN KEY (thread_id) REFERENCES threads(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE messages ADD CONSTRAINT FK_SenderMessage FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "Table messages created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>