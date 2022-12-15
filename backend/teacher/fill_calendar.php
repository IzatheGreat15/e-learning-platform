<?php

    $sql = "
        SELECT a.id, a.assignment_title AS activity_name, a.close_datetime AS activity_due, 'assignment' AS activtity_type 
        FROM assignments AS a LEFT JOIN subject_group AS sg ON a.sg_id = sg.id 
        WHERE sg.teacher_id = ? AND a.close_datetime IS NOT NULL
        UNION
        SELECT q.id, q.quiz_title AS activity_name, q.close_datetime AS activity_due, 'quiz' AS activtity_type 
        FROM quizzes AS q LEFT JOIN subject_group AS sg ON q.sg_id = sg.id 
        WHERE sg.teacher_id = ? AND q.close_datetime IS NOT NULL
        ORDER BY activity_due ASC";
    $sql->bind_param("ii", $_SESSION['user_id'], $_SESSION['user_id']);
    $sql->execute();

    //href will redirect to course/<?= $activity['table'].".php?id=".$activity['id'] ?>
?>