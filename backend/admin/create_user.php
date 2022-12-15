<?php
   /** ADD SUBJECTS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $fname    = $_POST["fname"];
      $lname    = $_POST["lname"];
      $email    = $_POST["email"];
      $type     = $_POST["type"];
      $password = $_POST["pword"];

      $sql = $db->prepare("INSERT INTO users (fname, lname, email, role, password) VALUES (?,?,?,?,?)");
      $sql->bind_param("sssss", $fname, $lname, $email, $type, $password);

      if ($sql->execute()) {
         header("location: ../../frontend/admin/people.php");
      } else {
         echo "Error inserting section: " . $db->error;
      }
   }
?>