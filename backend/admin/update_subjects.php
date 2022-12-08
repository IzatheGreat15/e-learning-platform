<?php
   /** UPDATE SUBJECTS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $teacher_id   = $_POST["teacher"];
      $year_level   = $_POST["grade_level"];
      $subject_name = $_POST["title"];
      $subject_id   = $_POST["subject_id"];

      $sql = $db->prepare("UPDATE subjects SET teacher_id = ?, year_level = ?, subject_name = ? WHERE id = ?");
      $sql->bind_param("iisi", $teacher_id, $year_level, $subject_name, $subject_id);

      if ($sql->execute() === TRUE) {
         header("location: ../../frontend/admin/courses.php");
      } else {
         echo "Error updating subject: " . $db->error;
      }
   }
?>