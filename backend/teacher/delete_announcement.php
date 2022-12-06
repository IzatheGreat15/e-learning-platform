<?php
   include("config.php");
   session_start();
    
   $sql = "DELETE FROM subject_announcements WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        echo "Announcement deleted successfully";
   } else {
        echo "Error deleting announcement: " . $db->error;
   }
   header("location: ../../frontend/courses/announcements.php");
?>