<?php
   include("config.php");
   session_start();
   
   if($_SESSION["role"] == "ADMIN" && isset($_POST["id"])) {
        $sql = $db->prepare("INSERT INTO enrollments (student_id, section_id, school_year) VALUES (?,?,?)");
        $sql->bind_param("iii", $_POST['id'], $_POST['sec'], $year);
        if($sql->execute()){
            echo "Successfully enrolled";
        }
        else{
          echo "Failed: ".$db->error;
        }
   }else{
        header("location: ../../frontend/index.php"); 
   }
?>