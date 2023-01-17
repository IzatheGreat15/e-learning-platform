<?php
   include("../config.php");
   session_start();

   $sql = "UPDATE modules SET deleted_on = CURRENT_TIMESTAMP WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/modules.php?msg=success");
   } else {
        header("location: ../../frontend/courses/modules.php?msg=failed");
   }
   
?>