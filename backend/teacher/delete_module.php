<?php
   include("config.php");
   session_start();

   var_dump($_POST);
    
   $sql = "DELETE FROM modules WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        header("location: ../../frontend/courses/modules.php?msg=success");
   } else {
        header("location: ../../frontend/courses/modules.php?msg=failed");
   }
   
?>