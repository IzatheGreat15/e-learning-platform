<?php
   /** ADD SECTIONS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $adviser_id   = $_POST["adviser"];
      $year_level   = $_POST["grade_level"];
      $section_name = $_POST["title"];
      $year = 2023;

      $sql = $db->prepare("INSERT INTO sections (adviser_id, year_level, section_name, school_year) VALUES (?,?,?,?)");
      $sql->bind_param("iisi", $adviser_id, $year_level, $section_name, $year);

      if ($sql->execute()) {
         $sec_id = mysqli_fetch_assoc($db->query("SELECT id FROM sections ORDER BY id DESC"))['id'];
         foreach($db->query("SELECT id, subject_name, teacher_id FROM subjects WHERE year_level = ".$year_level) as $sub){
            $sg_name = $sub['subject_name']." - ".$section_name;
            $sql = $db->prepare("INSERT INTO subject_group (section_id, subject_id, subject_group_name, teacher_id) VALUES (?,?,?,?)");
            $sql->bind_param("iisi", $sec_id, $sub['id'], $sg_name, $sub['teacher_id']);
            $sql->execute();     
         }
         header("location: ../../frontend/admin/enrollments.php?msg=success");
      }else{
         header("location: ../../frontend/admin/enrollments.php?msg=failed");
      }
   }
?>