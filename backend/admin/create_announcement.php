<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $announcement_title    = $_POST['title'];
      $announcement_body     = $_POST['content'];

      $sql = "INSERT INTO admin_announcements (announcement_title, announcement_body) VALUES ('".$announcement_title."','".$announcement_body."')";

      if ($db->query($sql) === TRUE) {
        echo "Announcement saved successfully";
        header("location: ../../frontend/admin/announcements.php?msg=success");
      } else {
        echo "Error saving announcement: " . $db->error;
        header("location: ../../frontend/admin/announcements.php?msg=failed");
      }
      
   }
?>