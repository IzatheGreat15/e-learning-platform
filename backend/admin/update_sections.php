<?php
   /** ADD SECTIONS **/
   include("../config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $id           = $_POST['id'];
      $adviser_id   = $_POST["adviser"];
      $section_name = $_POST["title"];

      $sql = $db->prepare("UPDATE sections SET adviser_id = ?, section_name = ? WHERE id = ?");
      $sql->bind_param("isi", $adviser_id, $section_name, $id);

      if ($sql->execute()) {
         echo "SUCCESS";
      }
      header("location: ../../frontend/admin/enrollments.php");
   }
?>