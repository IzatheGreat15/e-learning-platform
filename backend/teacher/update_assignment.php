<?php
    include("../config.php");
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id      = $_POST['id'];
        $sg_id   = $_SESSION['sg_id'];
        $title   = $_POST['title'];
        $due     = $_POST['due'];
        $max     = $_POST['total_score'];
        $type    = $_POST['type'];
        $inst    = $_POST['instructions'];
        $isNotif = isset($_POST['isNotif']) ? TRUE : FALSE;

        $sql = $db->prepare("UPDATE assignments SET sg_id = ?, assignment_title = ?, assignment_instruction = ?, max_score = ?, submission_type = ?, close_datetime = ? WHERE id = ?");
        $sql->bind_param("ississi", $sg_id, $title, $inst, $max, $type, $due, $id);

        if ($sql->execute()) {
            echo "\nAssignment saved successfully";

            $assignment_id = mysqli_fetch_assoc($db->query("SELECT id FROM assignments ORDER BY id DESC"))['id'];   

            if($isNotif == TRUE){
                $message = "Assignment '".$title."' updated, due for ".date("F d, Y", strtotime($due));
                $link = "assignment.php?id=".$assignment_id;
                $subject = "Assignment Created";

                include("../notification/main_notif.php");

                if($notif->execute())
                    header("location: ../../frontend/courses/assignments.php?m=sucess");
                else
                    header("location: ../../frontend/courses/assignments.php?m=notifFailed");
            }    
            header("location: ../../frontend/courses/assignments.php?m=sucess");

        } else {
            echo "\nError saving assignment: " . $db->error;
            header("location: ../../frontend/courses/assignments.php?m=fail");
        }
    }
?>