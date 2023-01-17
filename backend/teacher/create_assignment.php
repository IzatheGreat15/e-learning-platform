<?php
    include("../config.php");
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        var_dump($_POST);
        $sg_id   = $_SESSION['sg_id'];
        $title   = $_POST['title'];
        $due     = $_POST['due'];
        $max     = $_POST['total_score'];
        $type    = $_POST['type'];
        $inst    = $_POST['instructions'];
        $isNotif = isset($_POST['isNotif']) ? TRUE : FALSE;

        $sql = $db->prepare("INSERT INTO assignments (sg_id, assignment_title, assignment_instruction, max_score, submission_type, close_datetime) VALUES (?,?,?,?,?,?)");
        $sql->bind_param("ississ", $sg_id, $title, $inst, $max, $type, $due);

        

        if ($sql->execute()) {
            echo "\nAssignment saved successfully";

            $assignment_id = mysqli_fetch_assoc($db->query("SELECT id FROM assignments ORDER BY id DESC"))['id'];   
            $path = "../../frontend/files/assignment/".$_SESSION['sg_id']."_".$assignment_id;
            if(!is_dir($path)){
                mkdir($path, $mode = 0777, true);
            }else{
                header("location: ../../frontend/courses/assignments.php?m=failedMakingAssignmentFolder");
            }

            if($isNotif == TRUE){
                $message = "Assignment '".$title."' created, due for ".date("F d, Y", strtotime($due));
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