<?php

// sql to create table
$sql = "INSERT assignments (sg_id, assignment_title, assignment_instruction, submission_type, max_score) VALUES
                    (1, 'Assignment1', 'No instruction', 'FILE_UPLOAD', 100),
                    (2, 'Assignment2', 'No instruction', 'TEXTBOX', 100),
                    (3, 'Assignment3', 'No instruction', 'FILE_UPLOAD', 100),
                    (4, 'Assignment1', 'No instruction', 'TEXTBOX', 100),
                    (5, 'Assignment2', 'No instruction', 'FILE_UPLOAD', 100),
                    (6, 'Assignment3', 'No instruction', 'TEXTBOX', 100),
                    (1, 'Assignment1', 'No instruction', 'FILE_UPLOAD', 100),
                    (2, 'Assignment2', 'No instruction', 'TEXTBOX', 100),
                    (3, 'Assignment3', 'No instruction', 'FILE_UPLOAD', 100),
                    (4, 'Assignment1', 'No instruction', 'TEXTBOX', 100),
                    (5, 'Assignment2', 'No instruction', 'FILE_UPLOAD', 100),
                    (6, 'Assignment3', 'No instruction', 'TEXTBOX', 100),
                    (1, 'Assignment1', 'No instruction', 'FILE_UPLOAD', 100),
                    (2, 'Assignment2', 'No instruction', 'TEXTBOX', 100),
                    (3, 'Assignment3', 'No instruction', 'FILE_UPLOAD', 100),
                    (4, 'Assignment1', 'No instruction', 'TEXTBOX', 100),
                    (5, 'Assignment2', 'No instruction', 'FILE_UPLOAD', 100),
                    (6, 'Assignment3', 'No instruction', 'TEXTBOX', 100)";

if ($db->query($sql) === TRUE) {
  echo "\nTable assignments seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>