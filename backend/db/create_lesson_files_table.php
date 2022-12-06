<?php
// sql to create table
$sql = "CREATE TABLE lesson_files (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lesson_id INT(6) UNSIGNED,
    file_location VARCHAR(1080),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_LessonPF FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

if ($db->query($sql) === TRUE) {
  echo "\nTable lesson_files created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>