<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $sg_id   = $_SESSION['sg_id'];
      $announcement_title    = $_POST['title'];
      $announcement_body     = $_POST['content'];
      $announcer_id          = $_SESSION['sg_id'];
      $isNotif = true; //$_POST['isNotif'];

      $sql = "INSERT INTO subject_announcements (announcer_id, announcement_title, announcement_body) VALUES (".$announcer_id.",'".$announcement_title."','".$announcement_body."')";

      if ($db->query($sql) === TRUE) {
        echo "Announcement saved successfully";
        if($isNotif == TRUE){
            $announcement_id = mysqli_fetch_assoc($db->query("SELECT id FROM subject_announcements ORDER BY id DESC"))['id'];
            $message = $announcement_body;
            $link = "announcements.php?id=".$sg_id."&aid=".$announcement_id;

            $subject = "Announcement Created";

            include("../notification/main_notif.php");
        }

        if($notif->execute())
            header("location: ../../frontend/courses/assignments.php?m=sucess");
        else
            header("location: ../../frontend/courses/assignments.php?m=notifFailed");
      } else {
        echo "Error saving announcement: " . $db->error;
      }
      header("location: ../../frontend/courses/announcements.php");
   }
?>