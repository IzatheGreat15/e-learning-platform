<?php

// sql to create table
$sql = "INSERT quizzes (sg_id, quiz_title, quiz_instruction, time_limit, isPublished, close_datetime) VALUES
                    (1, 'Quiz 1-A', 'Left intenianally blank', '1:00:00', '2022-12-11 14:32:00', '2022-12-21 14:32:00'),
                    (2, 'Quiz 1-B', 'Left intenianally blank', '1:00:00', '2022-12-13 14:32:00', '2022-12-23 14:32:00'),
                    (3, 'Quiz 1-C', 'Left intenianally blank', '1:00:00', '2022-12-15 14:32:00', '2022-12-25 14:32:00'),
                    (4, 'Quiz 1-D', 'Left intenianally blank', '1:00:00', '2022-12-17 14:32:00', '2022-12-27 14:32:00'),
                    (5, 'Quiz 1-E', 'Left intenianally blank', '1:00:00', '2022-12-19 14:32:00', '2022-12-29 14:32:00'),
                    (6, 'Quiz 1-F', 'Left intenianally blank', '1:00:00', '2022-12-10 14:32:00', '2022-12-20 14:32:00'),
                    (6, 'Quiz 2-A', 'Left intenianally blank', '1:00:00', '2022-12-19 14:32:00', '2022-12-29 14:32:00'),
                    (5, 'Quiz 2-B', 'Left intenianally blank', '1:00:00', '2022-12-18 14:32:00', '2022-12-28 14:32:00'),
                    (4, 'Quiz 2-C', 'Left intenianally blank', '1:00:00', '2022-12-17 14:32:00', '2022-12-27 14:32:00'),
                    (3, 'Quiz 2-D', 'Left intenianally blank', '1:00:00', '2022-12-16 14:32:00', '2022-12-26 14:32:00'),
                    (2, 'Quiz 2-E', 'Left intenianally blank', '1:00:00', '2022-12-15 14:32:00', '2022-12-25 14:32:00'),
                    (1, 'Quiz 2-F', 'Left intenianally blank', '1:00:00', '2022-12-14 14:32:00', '2022-12-24 14:32:00'),
                    (3, 'Quiz 3-A', 'Left intenianally blank', '1:00:00', '2022-12-13 14:32:00', '2022-12-23 14:32:00'),
                    (4, 'Quiz 3-B', 'Left intenianally blank', '1:00:00', '2022-12-12 14:32:00', '2022-12-22 14:32:00'),
                    (2, 'Quiz 3-C', 'Left intenianally blank', '1:00:00', '2022-12-11 14:32:00', '2022-12-21 14:32:00'),
                    (5, 'Quiz 3-D', 'Left intenianally blank', '1:00:00', '2022-12-10 14:32:00', '2022-12-20 14:32:00'),
                    (1, 'Quiz 3-E', 'Left intenianally blank', '1:00:00', '2022-12-19 14:32:00', '2022-12-29 14:32:00'),
                    (6, 'Quiz 3-F', 'Left intenianally blank', '1:00:00', '2022-12-18 14:32:00', '2022-12-28 14:32:00')";

if ($db->query($sql) === TRUE) {
  echo "\nTable quizzes seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>