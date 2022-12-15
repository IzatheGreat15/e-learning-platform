<?php
    include("config.php");
    session_start();
    
    var_dump($_POST);

    $quiz_title       = $_POST['title'];
    $quiz_instruction = $_POST['instructions']; 
    $time_limit       = $_POST['time_limit']; 
    $sg_id            = $_SESSION['sg_id']; 
    $close_datetime   = $_POST['due'];
    $q_count          = (int)$_POST['count'];

    $quiz_sql = $db->prepare("INSERT INTO quizzes (quiz_title, quiz_instruction, time_limit, sg_id, close_datetime) VALUES (?,?,?,?,?)");
    $quiz_sql->bind_param("sssis", $quiz_title, $quiz_instruction, $time_limit, $sg_id, $close_datetime);

    if($quiz_sql->execute()){
        $quiz_id = mysqli_fetch_assoc($db->query("SELECT id from quizzes ORDER BY id DESC"))['id'];
        for($x = 0; $x < $q_count; $x++){
            $question_sql = $db->prepare("INSERT INTO quiz_items (quiz_id, item_question, item_answer, max_score) VALUES (?,?,?,?)");
            $question_sql->bind_param("issi", $quiz_id, $_POST['question'][$x], $_POST['answer'][$x], $_POST['score'][$x]);
            if(!$question_sql->execute())
                header("location: ../../frontend/courses/quizzes.php?msg=errorSavingQuestion");
        }
        header("location: ../../frontend/courses/quizzes.php?msg=success");
    }else{
        header("location: ../../frontend/courses/quizzes.php?msg=errorSavingQuiz");
    }
    
?>