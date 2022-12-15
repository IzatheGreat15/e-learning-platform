<?php

    $sql = "
    SELECT a.id, a.assignment_title AS activity_name, a.close_datetime AS activity_due, 'assignment' AS activtity_type, ar.created_on AS done_on 
    FROM assignments AS a 
    LEFT JOIN subject_group AS sg ON a.sg_id = sg.id 
    LEFT JOIN assignment_responses AS ar ON ar.assignment_id = a.id 
    WHERE sg.section_id = ? AND a.close_datetime IS NOT NULL
    UNION
    SELECT q.id, q.quiz_title AS activity_name, q.close_datetime AS activity_due, 'quiz' AS activtity_type, qr.created_on AS done_on 
    FROM quizzes AS q LEFT JOIN subject_group AS sg ON q.sg_id = sg.id 
    LEFT JOIN quiz_items AS qi ON qi.quiz_id = q.id 
    LEFT JOIN quiz_responses AS qr ON qr.qi_id = qi.id 
    WHERE sg.section_id = ? AND q.close_datetime IS NOT NULL GROUP BY qi.id
    ORDER BY activity_due ASC";
    $sql->bind_param("ii", $_SESSION['section_id'], $_SESSION['section_id']);
    $sql->execute();

    //href will redirect to course/<?= $activity['table'].".php?id=".$activity['id'] 
    //with this query, you can cross out the done activity by checking if activity['done_on'] != NULL

?>