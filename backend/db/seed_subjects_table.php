<?php

// sql to create table
$sql = "INSERT subjects (subject_name, year_level, teacher_id) VALUES
                    ('English',  1, 5),
                    ('Math',     1, 6),
                    ('Science',  1, 7),
                    ('Filipino', 1, 5),
                    ('Civics',   1, 6),
                    ('MAPE',     1, 7),
                    ('English',  2, 5),
                    ('Math',     2, 6),
                    ('Science',  2, 7),
                    ('Filipino', 2, 5),
                    ('Civics',   2, 6),
                    ('MAPE',     2, 7),
                    ('English',  3, 5),
                    ('Math',     3, 6),
                    ('Science',  3, 7),
                    ('Filipino', 3, 5),
                    ('Civics',   3, 6),
                    ('MAPE',     3, 7)";

if ($db->query($sql) === TRUE) {
  echo "\nTable subjects seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>