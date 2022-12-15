<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $message      = $_POST['message'];
      $subject      = $_POST['subject'];
      $recepient_id = $_POST['id'];
      $sender_id    = $_SESSION['user_id'];

      $sql = $db->prepare("INSERT INTO threads (respondent1_id, respondent2_id, thread_subject) VALUES (?,?,?)");
      $sql->bind_param("iis", $recepient_id, $sender_id, $subject);
      if ($sql->execute()) {
        $thread_id = mysqli_fetch_assoc($db->query("SELECT id FROM threads ORDER BY id DESC"))['id'];
        $sql = $db->prepare("INSERT INTO messages (thread_id, sender_id, message_body) VALUES (?,?,?)");
        $sql->bind_param("iis", $thread_id, $sender_id, $message);
        if($sql->execute())
          header("location: ../../frontend/view-message.php?id=".$thread_id);
        else
          header("location: ../../frontend/inbox.php?error=messageNotCreated");
      } else {
        header("location: ../../frontend/inbox.php?error=threadNotCreated");
      }
   }else
   header("location: ../../frontend/inbox.php?error=invalidRequestType");
?>