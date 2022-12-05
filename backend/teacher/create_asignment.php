<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $activity_name = $_POST["act_name"];
      
   }
?>