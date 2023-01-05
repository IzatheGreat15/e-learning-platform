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

      $sql = $db->prepare("INSERT INTO users (fname, lname, email, role, password, contact_num) VALUES (?,?,?,?,?,?)");
      $sql->bind_param("ssssss", $fname, $lname, $email, $type, password_hash($password, PASSWORD_DEFAULT), $contact_num);

      if ($sql->execute()) {
         header("location: ../../frontend/admin/people.php");
      } else {
         echo "Error inserting section: " . $db->error;
      }
   }
?>