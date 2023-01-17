<?php
    include("../config.php");
    session_start();

    $ar_id = $_POST['ar_id'];
    $score = $_POST['score'];

    $sql = $db->prepare("UPDATE assignment_responses SET response_score = ? WHERE id = ?");
    var_dump($_POST);
    $sql->bind_param("ii", $score, $ar_id);

    if($sql->execute() === TRUE){
        header("location: ../../frontend/courses/done-assignment.php?id=".$ar_id);
    }else{
        header("location: ../../frontend/courses/done-assignment.php?id=".$ar_id."?failed");
    }
?>