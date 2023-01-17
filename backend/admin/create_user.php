<?php
   /** ADD SUBJECTS **/
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $fname       = $_POST["fname"];
      $lname       = $_POST["lname"];
      $email       = $_POST["email"];
      $type        = $_POST["type"];
      $contact_num = $_POST["contact_num"];
      $password    = "password";
      $token       = $password.$email;

      $sql = $db->prepare("INSERT INTO users (fname, lname, email, role, password, contact_num, token) VALUES (?,?,?,?,?,?,?)");
      $sql->bind_param("sssssss", $fname, $lname, $email, $type, password_hash($password, PASSWORD_DEFAULT), $contact_num, password_hash($token, PASSWORD_DEFAULT));

      if ($sql->execute()) {
         $direct_verify = array("ADMIN", "REGISTRAR", "TEACHER");
         if(in_array($type, $direct_verify)){
            echo $id = mysqli_fetch_assoc($db->query("SELECT id FROM users ORDER BY created_on DESC LIMIT 1"))['id'];
            $sql = $db->prepare("UPDATE users SET verified_on = CURRENT_TIMESTAMP WHERE id = ?");
            $sql->bind_param("i", $id);
            $sql->execute();
         }
         //header("location: ../../frontend/admin/people.php");
      } else {
         echo "Error inserting section: " . $db->error;
      }
   }
?>