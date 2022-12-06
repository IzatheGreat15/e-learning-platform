<?php

// sql to create table
$sql = "INSERT enrollments (student_id, section_id, school_year) VALUES
                    (2, 1, 2022),
                    (3, 2, 2022),
                    (4, 3, 2022)";

if ($db->query($sql) === TRUE) {
  echo "\nTable enrollments seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>