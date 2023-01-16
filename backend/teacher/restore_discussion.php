<?php
   include("config.php");
   session_start();
 
   $sql = "UPDATE discussions SET deleted_on = NULL WHERE id = ".$_GET['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/discussions.php?msg=success");
   } else {
        header("location: ../../frontend/courses/discussions.php?msg=failed");
   }
   