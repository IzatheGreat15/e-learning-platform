<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $reply_body    = $_POST['reply'];
      $assigmnent_id = $_POST['assignment_id'];
      $student_id    = $_SESSION['user_id'];

      $sql = "INSERT INTO assignment_responses (assignment_id, student_id, response_answer) VALUES (".$assigmnent_id.",".$student_id.",'".$reply_body."')";

      if ($db->query($sql) === TRUE) {
        echo "Reply saved successfully";
      } else {
        echo "Error saving reply: " . $db->error;
      }
      header("location: ../../frontend/courses/discussion.php?id=".$discussion_id);
   }
?>