<?php
   /** ADD SUBJECTS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $fname    = $_POST["fname"];
      $lname    = $_POST["lname"];
      $email    = $_POST["email"];
      $type     = $_POST["type"];
      $contact_num     = $_POST["contact_num"];
      $password = "password";

      $condition = $type == "ADMIN" || $type == "REGISTRAR" ? array(", verified_on",", CURRENT_TIMESTAMP") : array("","");

      $sql = $db->prepare("INSERT INTO users (fname, lname, email, role, password, contact_num, token".$condition[0].") VALUES (?,?,?,?,?,?,?".$condition[1].")");
      
      $sql->bind_param("sssssss", $fname, $lname, $email, $type, password_hash($password, PASSWORD_DEFAULT), $contact_num, password_hash($password.$email, PASSWORD_DEFAULT));

      if ($sql->execute()) {
         header("location: ../../frontend/admin/people.php");
      } else {
         echo "Error inserting section: " . $db->error;
      }
   }
?>