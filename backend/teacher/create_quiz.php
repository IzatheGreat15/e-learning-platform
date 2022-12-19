<?php
    include("config.php");
    session_start();

    $quiz_title       = $_POST['title'];
    $quiz_instruction = $_POST['instructions']; 
    $time_limit       = $_POST['hour'].':'.$_POST['minute'].':'.$_POST['second']; 
    $sg_id            = $_SESSION['sg_id']; 
    $close_datetime   = $_POST['due'];
    $q_count          = (int)$_POST['count'];
    $unlock_datetime  = $_POST['unlock_time'];

    $quiz_sql = $db->prepare("INSERT INTO quizzes (quiz_title, quiz_instruction, time_limit, sg_id, close_datetime, isPublished) VALUES (?,?,?,?,?,?)");
    $quiz_sql->bind_param("sssiss", $quiz_title, $quiz_instruction, $time_limit, $sg_id, $close_datetime, $unlock_datetime);

    if($quiz_sql->execute()){
        $quiz_id = mysqli_fetch_assoc($db->query("SELECT id from quizzes ORDER BY id DESC"))['id'];
        for($x = 0; $x < $q_count; $x++){
            $question_sql = $db->prepare("INSERT INTO quiz_items (quiz_id, item_question, item_answer, max_score) VALUES (?,?,?,?)");
            $question_sql->bind_param("issi", $quiz_id, $_POST['question'][$x], $_POST['answer'][$x], $_POST['score'][$x]);
            if(!$question_sql->execute())
                header("location: ../../frontend/courses/quizzes.php?msg=errorSavingQuestion");
        }

        $quiz_id = mysqli_fetch_assoc($db->query("SELECT id FROM quizzes ORDER BY id DESC"))['id'];
        $message = "Quiz '".$quiz_title."' created, to be unlocked at ".date("F d, Y h:i A", strtotime($close_datetime));
        $link = "quiz.php?id=".$quiz_id;

        $notif = $db->prepare("INSERT INTO notifications (sg_id, message, link) VALUES (?,?,?)");
        $notif->bind_param("iss", $sg_id, $message, $link);

        if($notif->execute())
            header("location: ../../frontend/courses/quizzes.php?m=sucess");
        else
            header("location: ../../frontend/courses/quizzes.php?m=notifFailed");
    }else{
        header("location: ../../frontend/courses/quizzes.php?msg=errorSavingQuiz");
    }
    
?>