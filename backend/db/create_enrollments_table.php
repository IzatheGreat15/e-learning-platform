<?php

// sql to create table
$sql = "CREATE TABLE enrollments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT(6) UNSIGNED,
    section_id INT(6) UNSIGNED,
    school_year VARCHAR(24),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_StudentEnrollment FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE enrollments ADD CONSTRAINT FK_SectionEnrollment FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s)) {
  echo "Table enrollments created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>