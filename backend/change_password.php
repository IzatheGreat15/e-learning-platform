<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $user = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = ".$_SESSION['user_id']));
      $newPass = $_POST['newPass'];
      $oldPass = $_POST['oldPass'];

      if(password_verify($oldPass, $user['password'])){
         $sql = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
         $sql->bind_param("si", password_hash($newPass, PASSWORD_DEFAULT), $_SESSION['user_id']);
         if($sql->execute()){
            header("location: ../frontend/admin/account-settings.php?msg=success");
         }else{
            header("location: ../frontend/admin/account-settings.php?msg=sqlError");
         }
      }else{
         header("location: ../frontend/admin/account-settings.php?msg=oldPassNotMatch");
      }
      
      
   }
?>