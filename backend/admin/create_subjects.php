<?php
   /** ADD SUBJECTS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $teacher_id   = $_POST["teacher"];
      $year_level   = $_POST["grade_level"];
      $subject_name = $_POST["title"];

      $sql = $db->prepare("INSERT INTO subjects (teacher_id, year_level, subject_name) VALUES (?,?,?)");
      $sql->bind_param("iis", $teacher_id, $year_level, $subject_name);

      if ($sql->execute()) {
         $subject_id = mysqli_fetch_assoc($db->query("SELECT id from subjects ORDER BY id DESC"))['id'];
         $section_sql = $db->prepare("INSERT INTO subject_group (subject_id, section_id, teacher_id, subject_group_name) VALUES (?,?,?,?)");
         foreach($db->query("SELECT id, section_name FROM sections WHERE year_level = ".$year_level) as $section){
            $sg_name = $subject_name." - ".$section['section_name'];
            $section_sql->bind_param("iiis", $subject_id, $section['id'], $teacher_id, $sg_name);
            $section_sql->execute();
         }
         header("location: ../../frontend/admin/courses.php");
      } else {
         echo "Error inserting section: " . $db->error;
      }
   }
?>