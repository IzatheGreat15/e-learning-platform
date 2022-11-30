<?php

// sql to create table
$sql = "CREATE TABLE assignment_responses (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    assignment_id INT(6) UNSIGNED,
    student_id INT(6) UNSIGNED,
    response_answer VARCHAR(256),
    response_score INT(6),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_AssignmentAR FOREIGN KEY (assignment_id) REFERENCES assignments(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE assignment_responses ADD CONSTRAINT FK_StudentAR FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "Table assignment_responses created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>