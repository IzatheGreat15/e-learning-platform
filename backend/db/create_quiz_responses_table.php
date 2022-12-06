<?php

// sql to create table
$sql = "CREATE TABLE quiz_responses (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    qi_id INT(6) UNSIGNED,
    student_id INT(6) UNSIGNED,
    response_answer VARCHAR(256),
    response_score INT(6),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_QIQR FOREIGN KEY (qi_id) REFERENCES quiz_items(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE quiz_responses ADD CONSTRAINT FK_StudentQR FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "\nTable quiz_responses created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>