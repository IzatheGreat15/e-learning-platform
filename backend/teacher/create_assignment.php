<?php
    include("config.php");
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        var_dump($_POST);
        $sg_id = $_SESSION['sg_id'];
        $title = $_POST['title'];
        $due   = $_POST['due'];
        $max   = $_POST['total_score'];
        $type  = $_POST['type'];
        $inst  = $_POST['instructions'];

        $sql = $db->prepare("INSERT INTO assignments (sg_id, assignment_title, assignment_instruction, max_score, submission_type, close_datetime) VALUES (?,?,?,?,?,?)");
        $sql->bind_param("ississ", $sg_id, $title, $inst, $max, $type, $due);

        if ($sql->execute() === TRUE) {
            echo "\nAssignment saved successfully";
            header("location: ../../frontend/courses/assignments.php?m=sucess");
        } else {
            echo "\nError saving assignment: " . $db->error;
            header("location: ../../frontend/courses/assignments.php?m=fail");
        }
    }
?>