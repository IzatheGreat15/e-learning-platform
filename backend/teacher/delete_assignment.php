<?php
   include("config.php");
   session_start();

   var_dump($_POST);
    
   $sql = "DELETE FROM assignments WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/assignments.php?msg=success");
   } else {
        header("location: ../../frontend/courses/assignments.php?msg=failed");
   }
   
?>