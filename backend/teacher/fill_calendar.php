<?php
    session_start();
    include("../config.php");

    $sql = $db->query("SELECT a.id, a.assignment_title AS activity_name, a.close_datetime AS activity_due, 'assignment' AS activity_type, a.isPublished AS activity_open 
        FROM assignments AS a LEFT JOIN subject_group AS sg ON a.sg_id = sg.id 
        WHERE sg.teacher_id = ". $_SESSION['user_id'] ." AND a.close_datetime IS NOT NULL
        UNION
        SELECT q.id, q.quiz_title AS activity_name, q.close_datetime AS activity_due, 'quiz' AS activity_type, q.isPublished AS activity_open
        FROM quizzes AS q LEFT JOIN subject_group AS sg ON q.sg_id = sg.id 
        WHERE sg.teacher_id = ". $_SESSION['user_id'] ." AND q.close_datetime IS NOT NULL
        ORDER BY activity_due ASC");

    echo json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)); 
    //href will redirect to course/<?= $activity['table'].".php?id=".$activity['id'] 
?>