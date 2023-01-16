<?php
   include("config.php");
   session_start();
    
   $sql = "UPDATE subject_announcements SET deleted_on = NULL WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        echo "Announcement deleted successfully";
   } else {
        echo "Error deleting announcement: " . $db->error;
   }
   header("location: ../../frontend/courses/announcements.php");
?>