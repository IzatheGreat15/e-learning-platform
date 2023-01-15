<?php

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS threads (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    respondent1_id INT(6) UNSIGNED NOT NULL,
    respondent2_id INT(6) UNSIGNED NOT NULL,
    thread_subject VARCHAR(256) NOT NULL,
    deleted_on DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_R1Thread FOREIGN KEY (respondent1_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE threads ADD CONSTRAINT FK_R2Thread FOREIGN KEY (respondent2_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "\n<br>Table threads created successfully";
} else {
  echo "\n<br>Error creating table: " . $db->error;
}
?>