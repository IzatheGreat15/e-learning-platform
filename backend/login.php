<?php
   include("config.php");
   session_start();

   if(isset($_SESSION["user_id"]) && isset($_SESSION["role"]))
      header("location: ../frontend/dashboard.php");

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $email    = $_POST["email"];
      $password = $_POST["password"];

      $sql = "SELECT * FROM users WHERE email = ".$email;

      var_dump($db->query($sql));
   }
?>