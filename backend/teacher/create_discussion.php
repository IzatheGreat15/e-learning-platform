<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $discussion_title       = $_POST['title'];
      $discussion_instruction = $_POST['content'];
      $sg_id                  = $_SESSION['sg_id'];

      $sql = "INSERT INTO discussions (sg_id, discussion_title, discussion_instruction) VALUES (".$sg_id.",'".$discussion_title."','".$discussion_instruction."')";

      if ($db->query($sql) === TRUE) {
        echo "Announcement saved successfully";
      } else {
        echo "Error saving announcement: " . $db->error;
      }
      header("location: ../../frontend/courses/discussions.php");
   }
?>