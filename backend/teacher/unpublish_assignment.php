<?php
   include("../config.php");
   session_start();
    
   $sql = "UPDATE assignments SET isPublished = FALSE WHERE id = ".$_GET['id'];

   if ($db->query($sql) === TRUE) {
        echo "Assignment deleted successfully";
        header("location: ../../frontend/courses/assignments.php?msg=success");
   } else {
        echo "Error deleting assignment: " . $db->error;
        header("location: ../../frontend/courses/assignments.php?msg=failed");
   }
   
?>