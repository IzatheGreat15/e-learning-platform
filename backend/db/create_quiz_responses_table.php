<?php

// sql to create table
$sql = "CREATE TABLE quiz_responses (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    qi_id INT(6) UNSIGNED NOT NULL,
    student_id INT(6) UNSIGNED NOT NULL,
    response_answer VARCHAR(256),
    response_score INT(6) DEFAULT 0,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_QIQR FOREIGN KEY (qi_id) REFERENCES quiz_items(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE quiz_responses ADD CONSTRAINT FK_StudentQR FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";
//$q = "CREATE TRIGGER `insertQuestions` AFTER INSERT ON `quizzes` FOR EACH ROW INSERT INTO quiz_items (quiz_id, item_question, item_answer, max_score) VALUES (NEW.id, 'Question x: Sample Question Here', 'Answer Here', 5), (NEW.id, 'Question x: Sample Question Here', 'Answer Here', 5), (NEW.id, 'Question x: Sample Question Here', 'Answer Here', 5), (NEW.id, 'Question x: Sample Question Here', 'Answer Here', 5)";
//&& $db->query($q)
if ($db->query($sql) && $db->query($s)) {
  echo "\nTable quiz_responses created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>