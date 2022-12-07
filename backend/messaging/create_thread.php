<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $reply_body    = $_POST['reply'];
      $discussion_id = $_POST['thread_id'];
      $student_id    = $_SESSION['user_id'];

      $sql = "INSERT INTO messages (thread_id, sender_id, message_body) VALUES (".$discussion_id.",".$student_id.",'".$reply_body."')";

      var_dump($_POST);

      if ($db->query($sql) === TRUE) {
        echo "\nReply saved successfully";
      } else {
        echo "\nError saving reply: " . $db->error;
      }
      header("location: ../../frontend/view-message.php?id=".$discussion_id);
   }
?>