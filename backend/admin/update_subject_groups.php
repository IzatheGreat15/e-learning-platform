<?php
   /** UPDATE SUBJECT GROUPS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $sg_id      = $_POST["sg_id"];
      $sg_name    = $_POST["title"];
      $teacher_id = $_POST["teacher"];
      $day        = $_POST["day"];
      $time       = $_POST["time"];
      $schedule   = $day." ".$time;

      $sql = $db->prepare("UPDATE subject_group SET teacher_id = ?, schedule = ?, subject_group_name = ? WHERE id = ?");
      $sql->bind_param("issi", $teacher_id, $schedule, $sg_name, $sg_id);

      if ($sql->execute() === TRUE) {
         header("location: ../../frontend/admin/courses.php?success");
      } else {
         header("location: ../../frontend/admin/courses.php?failed");
      }
   }
?>