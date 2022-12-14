<?php
   include("config.php");
   session_start();
    
   $sql = "DELETE FROM admin_announcements WHERE id = ".$_POST['id'];

   if ($db->query($sql) === TRUE) {
        echo "Announcement deleted successfully";
        header("location: ../../frontend/admin/announcements.php?msg=success");
   } else {
        echo "Error deleting announcement: " . $db->error;
        header("location: ../../frontend/admin/announcements.php?msg=failed");
   }
   
?>