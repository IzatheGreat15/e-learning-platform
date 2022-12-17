<?php

// sql to create table
$sql = "CREATE TABLE quizzes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sg_id INT(6) UNSIGNED,
    quiz_title VARCHAR(128),
    quiz_instruction VARCHAR(15000),
    time_limit TIME,
    isPublished TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    close_datetime DATETIME,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SGQuiz FOREIGN KEY (sg_id) REFERENCES subject_group(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable quizzes created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>