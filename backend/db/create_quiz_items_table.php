<?php

// sql to create table
$sql = "CREATE TABLE quiz_items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT(6) UNSIGNED NOT NULL,
    item_question VARCHAR(256) NOT NULL,
    item_answer VARCHAR(256) NOT NULL,
    max_score INT(6) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_QuizItem FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable quiz_items created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>