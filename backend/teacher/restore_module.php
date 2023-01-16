<?php
   include("config.php");
   session_start();

   $sql = "UPDATE modules SET deleted_on = NULL WHERE id = ".$_GET['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/modules.php?msg=success");
   } else {
        header("location: ../../frontend/courses/modules.php?msg=failed");
   }
   
?>