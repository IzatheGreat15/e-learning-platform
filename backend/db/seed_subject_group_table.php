<?php

// sql to create table
$sql = "INSERT subject_group (teacher_id, subject_id, section_id, subject_group_name, schedule) VALUES
                    (3, 1, 1, 'English 1-A',  'MWF 8:00-10:00'),
                    (2, 2, 1, 'Math 1-A',     'MWF 10:00-12:00'),
                    (3, 3, 1, 'Science 1-A',  'MWF 1:00-3:00'),
                    (2, 4, 1, 'Filipino 1-A', 'TTh 8:00-10:00'),
                    (2, 5, 1, 'Civics 1-A',   'TTh 10:00-12:00'),
                    (3, 6, 1, 'MAPE 1-A',     'TTh 1:00-3:00'),
                    (4, 1, 2, 'English 1-B',  'MWF 8:00-10:00'),
                    (2, 2, 2, 'Math 1-B',     'MWF 10:00-12:00'),
                    (3, 3, 2, 'Science 1-B',  'MWF 1:00-3:00'),
                    (4, 4, 2, 'Filipino 1-B', 'TTh 8:00-10:00'),
                    (2, 5, 2, 'Civics 1-B',   'TTh 10:00-12:00'),
                    (3, 6, 2, 'MAPE 1-B',     'TTh 1:00-3:00'),
                    (3, 1, 3, 'English 1-C',  'MWF 8:00-10:00'),
                    (2, 2, 3, 'Math 1-C',     'MWF 10:00-12:00'),
                    (3, 3, 3, 'Science 1-C',  'MWF 1:00-3:00'),
                    (2, 4, 3, 'Filipino 1-C', 'TTh 8:00-10:00'),
                    (2, 5, 3, 'Civics 1-C',   'TTh 10:00-12:00'),
                    (3, 6, 3, 'MAPE 1-C',     'TTh 1:00-3:00')";

if ($db->query($sql) === TRUE) {
  echo "\nTable subject_group seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>