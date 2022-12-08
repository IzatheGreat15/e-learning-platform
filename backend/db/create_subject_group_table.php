<?php

// sql to create table
$sql = "CREATE TABLE subject_group (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_group_name VARCHAR(64),
    subject_id INT(6) UNSIGNED NOT NULL,
    section_id INT(6) UNSIGNED NOT NULL,
    teacher_id INT(6) UNSIGNED,
    schedule VARCHAR(24) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_SubjectSG FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE ON UPDATE CASCADE
)";

$s = "ALTER TABLE subject_group ADD CONSTRAINT FK_SectionSG FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE CASCADE ON UPDATE CASCADE";
$q = "ALTER TABLE subject_group ADD CONSTRAINT FK_TeacherSG FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE";

if ($db->query($sql) === TRUE && $db->query($s) && $db->query($q)) {
  echo "\nTable subject_group created successfully";
} else {
  echo "\nError creating table: " . $db->error;
}
?>