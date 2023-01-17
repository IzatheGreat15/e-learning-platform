<?php
    include("../config.php");
    session_start();

    $quiz_id          = $_POST['id'];
    $quiz_title       = $_POST['title'];
    $quiz_instruction = $_POST['instructions']; 
    $time_limit       = $_POST['hour'].':'.$_POST['minute'].':'.$_POST['second']; 
    $sg_id            = $_SESSION['sg_id']; 
    $close_datetime   = $_POST['due'];
    $q_count          = count($_POST['i_id']);
    $unlock_datetime  = $_POST['unlock_time'];
    $isNotif = isset($_POST['isNotif']) ? TRUE : FALSE;

    $quiz_sql = $db->prepare("UPDATE quizzes SET quiz_title = ?, quiz_instruction = ?, time_limit = ?, sg_id = ?, close_datetime = ?, isPublished = ? WHERE id = ?");
    $quiz_sql->bind_param("sssissi", $quiz_title, $quiz_instruction, $time_limit, $sg_id, $close_datetime, $unlock_datetime, $quiz_id);

    if($quiz_sql->execute()){
        for($x = 0; $x < $q_count; $x++){
            if($_POST['i_id'][$x] == 0){
                $question_sql = $db->prepare("UPDATE quiz_items SET quiz_id = ?, item_question = ?, item_answer = ?, max_score = ? WHERE id = ?");
                $question_sql->bind_param("issii", $quiz_id, $_POST['question'][$x], $_POST['answer'][$x], $_POST['score'][$x], $_POST['i_id'][$x]);
            }else{
                $question_sql = $db->prepare("INSERT INTO quiz_items (quiz_id, item_question, item_answer, max_score) VALUES (?,?,?,?)");
                $question_sql->bind_param("issi", $quiz_id, $_POST['question'][$x], $_POST['answer'][$x], $_POST['score'][$x]);
            }
            if(!$question_sql->execute())
                header("location: ../../frontend/courses/quizzes.php?msg=errorSavingQuestion");
        }

        if($isNotif == TRUE){
            $quiz_id = mysqli_fetch_assoc($db->query("SELECT id FROM quizzes ORDER BY id DESC"))['id'];
            $message = "Quiz '".$quiz_title."' updated, due on ".date("F d, Y h:i A", strtotime($close_datetime));
            $link = "quiz.php?id=".$quiz_id;

            $subject = "Quiz Updated";

            include("../notification/main_notif.php");

            if($notif->execute())
                header("location: ../../frontend/courses/quizzes.php?m=sucess");
            else
                header("location: ../../frontend/courses/quizzes.php?m=notifFailed");
        }else{
            header("location: ../../frontend/courses/quizzes.php?m=sucess");
        }

        
    }else{
        header("location: ../../frontend/courses/quizzes.php?msg=errorSavingQuiz");
    }
    
?>