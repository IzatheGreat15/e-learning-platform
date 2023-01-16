<?php
   include("config.php");
   session_start();
    
   $sql = "UPDATE admin_announcements SET deleted_on = NULL WHERE id = ".$_GET['id'];

   if ($db->query($sql) === TRUE) {
        echo "Announcement deleted successfully";
        header("location: ../../frontend/admin/announcements.php?msg=success");
   } else {
        echo "Error deleting announcement: " . $db->error;
        header("location: ../../frontend/admin/announcements.php?msg=failed");
   }
   
?>