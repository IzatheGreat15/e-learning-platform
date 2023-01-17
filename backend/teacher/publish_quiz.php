<?php
   include("../config.php");
   session_start();
    
   $sql = "UPDATE quizzes SET isPublished = TRUE WHERE id = ".$_GET['id'];

   if ($db->query($sql) === TRUE) {
        echo "Quiz deleted successfully";
        header("location: ../../frontend/courses/quizzes.php?msg=success");
   } else {
        echo "Error deleting quiz: " . $db->error;
        header("location: ../../frontend/courses/quizzes.php?msg=failed");
   }
   
?>