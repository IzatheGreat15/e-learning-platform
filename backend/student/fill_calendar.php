<?php
    session_start();
    include("../config.php");

    $sql = $db->query("SELECT a.id, a.assignment_title AS activity_name, a.close_datetime AS activity_due, 'assignment' AS activity_type, ar.created_on AS done_on, a.isPublished AS activity_open 
    FROM assignments AS a 
    LEFT JOIN subject_group AS sg ON a.sg_id = sg.id 
    LEFT JOIN assignment_responses AS ar ON ar.assignment_id = a.id 
    WHERE sg.section_id = ". $_SESSION['section_id'] ." AND a.close_datetime IS NOT NULL
    UNION
    SELECT q.id, q.quiz_title AS activity_name, q.close_datetime AS activity_due, 'quiz' AS activity_type, qr.created_on AS done_on, q.isPublished AS activity_open 
    FROM quizzes AS q LEFT JOIN subject_group AS sg ON q.sg_id = sg.id 
    LEFT JOIN quiz_items AS qi ON qi.quiz_id = q.id 
    LEFT JOIN quiz_responses AS qr ON qr.qi_id = qi.id 
    WHERE sg.section_id = ". $_SESSION['section_id'] ." AND q.close_datetime IS NOT NULL GROUP BY qi.id
    ORDER BY activity_due ASC");

    $events = [];
    $x = 0;
    foreach($sql->fetch_all(MYSQLI_ASSOC) as $row){
        $row['activity_due'] = str_replace(" ", "T", $row['activity_due']);
        $row['activity_open'] = str_replace(" ", "T", $row['activity_open']);
        $row['done_on'] = str_replace(" ", "T", $row['done_on']);
        $events[$x++] = $row;
    }

    echo json_encode($events);

    //href will redirect to course/<?= $activity['table'].".php?id=".$activity['id'] 
    //with this query, you can cross out the done activity by checking if activity['done_on'] != NULL

?>