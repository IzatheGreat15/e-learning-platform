<?php
   include("config.php");
   session_start();

   var_dump($_POST);
    
   $sql = "DELETE FROM quizzes WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/quizzes.php?msg=success");
   } else {
        header("location: ../../frontend/courses/quizzes.php?msg=failed");
   }
   
?>