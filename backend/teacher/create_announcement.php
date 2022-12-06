<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $announcement_title    = $_POST['title'];
      $announcement_body     = $_POST['content'];
      $announcer_id          = $_SESSION['sg_id'];

      $sql = "INSERT INTO subject_announcements (announcer_id, announcement_title, announcement_body) VALUES (".$announcer_id.",'".$announcement_title."','".$announcement_body."')";

      if ($db->query($sql) === TRUE) {
        echo "Announcement saved successfully";
      } else {
        echo "Error saving announcement: " . $db->error;
      }
      header("location: ../../frontend/courses/announcements.php");
   }
?>