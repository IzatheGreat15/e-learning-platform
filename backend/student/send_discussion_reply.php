<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $reply_body    = $_POST['reply'];
      $discussion_id = $_POST['discussion_id'];
      $student_id    = $_SESSION['user_id'];

      $sql = "INSERT INTO discussion_replies (discussion_id, student_id, reply_body) VALUES (".$discussion_id.",".$student_id.",'".$reply_body."')";

      if ($db->query($sql) === TRUE) {
        echo "Reply saved successfully";
      } else {
        echo "Error saving reply: " . $db->error;
      }
      header("location: ../../frontend/courses/discussion.php?id=".$discussion_id);
   }
?>