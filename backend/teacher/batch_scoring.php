<?php
   include("../config.php");
   session_start();

    if(isset($_POST)){
        for($x = 0; $x < sizeof($_POST['id']); $x++){
            $db->query("UPDATE assignment_responses SET response_score = ".$_POST['score'][$x]." WHERE id = ".$_POST['id'][$x]);
        }

        if($x == sizeof($_POST['id'])){
            header("location: ../../frontend/courses/view-responses-assignments.php?id=". $_POST['ass_id'] ."&view=grid&m=sucess");
        }else{
            header("location: ../../frontend/courses/view-responses-assignments.php?id=". $_POST['ass_id'] ."&view=grid&m=failed");
        }
    }
?>