<?php
   include("../config.php");
   session_start();

   $sql = "UPDATE quizzes SET deleted_on = CURRENT_TIMESTAMP WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/quizzes.php?msg=success");
   } else {
        header("location: ../../frontend/courses/quizzes.php?msg=failed");
   }
   
?>