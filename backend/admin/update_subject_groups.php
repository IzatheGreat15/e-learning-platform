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
      $schedule   = ($day == '' && $time == '') ? mysqli_fetch_assoc($db->query("SELECT schedule FROM subject_group WHERE id = ".$sg_id))['schedule'] : $day." ".$time;

      $sql = $db->prepare("UPDATE subject_group SET teacher_id = ?, schedule = ?, subject_group_name = ? WHERE id = ?");
      $sql->bind_param("issi", $teacher_id, $schedule, $sg_name, $sg_id);

      if ($sql->execute() === TRUE) {
         header("location: ../../frontend/admin/admin-courses.php?id=".$sg_id."&msg=success");
      } else {
         header("location: ../../frontend/admin/admin-courses.php?id=".$sg_id."&msg=failed");
      }
   }
?>