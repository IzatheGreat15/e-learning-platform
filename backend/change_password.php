<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $user = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE id = ".$_SESSION['user_id']));
      $isForgotten = FALSE;
      if(!isset($_POST['oldPass'])){
         $newPass = $_POST['new_password'];
         $isForgotten = TRUE;
      }else{
         $oldPass = $_POST['oldPass'];
         $newPass = $_POST['newPass'];
      }
      
      $oldPass = $_POST['oldPass'];

      if($isForgotten || password_verify($oldPass, $user['password'])){
         $sql = $db->prepare("UPDATE users SET password = ?, token = ? WHERE id = ?");
         $sql->bind_param("ssi", password_hash($newPass, PASSWORD_DEFAULT), password_hash($newPass.$user['email'], PASSWORD_DEFAULT), $_SESSION['user_id']);
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