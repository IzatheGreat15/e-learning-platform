<?php
   include("config.php");
   session_start();

   if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../../frontend/index.php");
   
   if($_SESSION["role"] == "TEACHER" && isset($_POST["id"])) {
        $sql = $db->prepare("DELETE FROM quiz_items WHERE id = ?");
        $sql->bind_param("i", $_POST['id']);
        if($sql->execute()){
            echo 'Quiz item successfully deleted';
            header("location: ../../frontend/teacher/quizzes.php");
        }
   }else{
        header("location: ../../frontend/index.php"); 
   }
?>