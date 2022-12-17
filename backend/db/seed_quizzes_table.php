<?php

// sql to create table
$s = "INSERT quizzes (sg_id, quiz_title, quiz_instruction, time_limit, isPublished, close_datetime) VALUES
                    (1, 'Quiz 1-A', 'Left intenianally blank', '1:00:00', '2022-12-21 13:32:00', '2022-12-21 14:32:00'),
                    (2, 'Quiz 1-B', 'Left intenianally blank', '1:00:00', '2022-12-23 13:32:00', '2022-12-23 14:32:00'),
                    (3, 'Quiz 1-C', 'Left intenianally blank', '1:00:00', '2022-12-25 13:32:00', '2022-12-25 14:32:00'),
                    (4, 'Quiz 1-D', 'Left intenianally blank', '1:00:00', '2022-12-27 13:32:00', '2022-12-27 14:32:00'),
                    (5, 'Quiz 1-E', 'Left intenianally blank', '1:00:00', '2022-12-29 13:32:00', '2022-12-29 14:32:00'),
                    (6, 'Quiz 1-F', 'Left intenianally blank', '1:00:00', '2022-12-20 13:32:00', '2022-12-20 14:32:00'),
                    (6, 'Quiz 2-A', 'Left intenianally blank', '1:00:00', '2022-12-29 13:32:00', '2022-12-29 14:32:00'),
                    (5, 'Quiz 2-B', 'Left intenianally blank', '1:00:00', '2022-12-28 13:32:00', '2022-12-28 14:32:00'),
                    (4, 'Quiz 2-C', 'Left intenianally blank', '1:00:00', '2022-12-27 13:32:00', '2022-12-27 14:32:00'),
                    (3, 'Quiz 2-D', 'Left intenianally blank', '1:00:00', '2022-12-26 13:32:00', '2022-12-26 14:32:00'),
                    (2, 'Quiz 2-E', 'Left intenianally blank', '1:00:00', '2022-12-25 13:32:00', '2022-12-25 14:32:00'),
                    (1, 'Quiz 2-F', 'Left intenianally blank', '1:00:00', '2022-12-24 13:32:00', '2022-12-24 14:32:00'),
                    (3, 'Quiz 3-A', 'Left intenianally blank', '1:00:00', '2022-12-23 13:32:00', '2022-12-23 14:32:00'),
                    (4, 'Quiz 3-B', 'Left intenianally blank', '1:00:00', '2022-12-22 13:32:00', '2022-12-22 14:32:00'),
                    (2, 'Quiz 3-C', 'Left intenianally blank', '1:00:00', '2022-12-21 13:32:00', '2022-12-21 14:32:00'),
                    (5, 'Quiz 3-D', 'Left intenianally blank', '1:00:00', '2022-12-20 13:32:00', '2022-12-20 14:32:00'),
                    (1, 'Quiz 3-E', 'Left intenianally blank', '1:00:00', '2022-12-29 13:32:00', '2022-12-29 14:32:00'),
                    (6, 'Quiz 3-F', 'Left intenianally blank', '1:00:00', '2022-12-28 13:32:00', '2022-12-28 14:32:00')";

$q = "INSERT quiz_items (quiz_id, item_question, item_answer, max_score) VALUES
                    (1, 'Yes?', 'Yes', 1),
                    (2, 'Yes?', 'Yes', 2),
                    (3, 'Yes?', 'Yes', 3),
                    (4, 'Yes?', 'Yes', 4),
                    (5, 'Yes?', 'Yes', 5),
                    (6, 'Yes?', 'Yes', 6),
                    (7, 'Yes?', 'Yes', 7),
                    (8, 'Yes?', 'Yes', 8),
                    (9, 'Yes?', 'Yes', 9),
                    (10, 'Yes?', 'Yes', 9),
                    (11, 'Yes?', 'Yes', 8),
                    (12, 'Yes?', 'Yes', 7),
                    (13, 'Yes?', 'Yes', 6),
                    (14, 'Yes?', 'Yes', 5),
                    (15, 'Yes?', 'Yes', 4),
                    (16, 'Yes?', 'Yes', 3),
                    (17, 'Yes?', 'Yes', 2),
                    (18, 'Yes?', 'Yes', 1),
                    (18, 'Yes?', 'Yes', 1),
                    (17, 'Yes?', 'Yes', 2),
                    (16, 'Yes?', 'Yes', 3),
                    (15, 'Yes?', 'Yes', 4),
                    (14, 'Yes?', 'Yes', 5),
                    (13, 'Yes?', 'Yes', 6),
                    (12, 'Yes?', 'Yes', 7),
                    (11, 'Yes?', 'Yes', 8),
                    (10, 'Yes?', 'Yes', 9),
                    (9, 'Yes?', 'Yes', 9),
                    (8, 'Yes?', 'Yes', 8),
                    (7, 'Yes?', 'Yes', 7),
                    (6, 'Yes?', 'Yes', 6),
                    (5, 'Yes?', 'Yes', 5),
                    (4, 'Yes?', 'Yes', 4),
                    (3, 'Yes?', 'Yes', 3),
                    (2, 'Yes?', 'Yes', 2),
                    (1, 'Yes?', 'Yes', 1)";

if ($db->query($s) && $db->query($q)) {
  echo "\nTable quizzes seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>