<?php
   include("config.php");
   session_start();

   if(isset($_SESSION["user_id"]) && isset($_SESSION["role"]))
      header("location: ../frontend/dashboard.php");

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $email    = $_POST["email"];
      $password = $_POST["password"];


      $sql = "SELECT id, role, password FROM users WHERE email = '".$email."'";
      foreach($db->query($sql) as $user){
         if($user['password'] == $password){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == "STUDENT"){
               $sql = "SELECT section_id FROM enrollments WHERE student_id = ".$user['id']." ORDER BY created_on DESC";
               foreach($db->query($sql) as $section){
                  $_SESSION['section_id'] = $section['section_id'];
               }
            }
            header("location: ../frontend/dashboard.php");
         }else{
            header("location: ../frontend/index.php?error=incorrectpassword");
         }
      }
    
      header("location: ../frontend/index.php?error=accountdoesnotexist");
   }
?>