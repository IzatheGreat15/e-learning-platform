<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $email    = $_POST["email"];
      $password = $_POST["password"];


      $sql = "SELECT id, role, password FROM users WHERE email = '".$email."'";
      $s = $db->query($sql);
      if($s != FALSE){
         foreach($s as $user){
            if($user['password'] == $password){
               $_SESSION['user_id'] = $user['id'];
               $_SESSION['role'] = $user['role'];

               if($user['role'] == "ADMIN"){
                  header("location: ../frontend/admin/dashboard.php");
               }else{
                  if($user['role'] == "STUDENT"){
                     $sql = "SELECT section_id FROM enrollments WHERE student_id = ".$user['id']." ORDER BY created_on DESC";
                     foreach($db->query($sql) as $section){
                        $_SESSION['section_id'] = $section['section_id'];
                     }
                  }
                  header("location: ../frontend/dashboard.php");
               }   
            }else{
               header("location: ../frontend/index.php?error=incorrectpassword");
            }
         }
      }else{
         header("location: ../frontend/index.php?error=accountdoesnotexist");
      }
   }
?>