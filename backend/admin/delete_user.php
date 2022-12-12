<?php
   include("config.php");
   session_start();

   if(!isset($_SESSION["user_id"]) && !isset($_SESSION["role"]))
        header("location: ../../frontend/index.php");
   
   if($_SESSION["role"] == "ADMIN" && isset($_POST["id"])) {
        $sql = $db->prepare("DELETE FROM users WHERE id = ?");
        $sql->bind_param("i", $_POST['id']);
        if($sql->execute()){
            header("location: ../../frontend/admin/people.php");
        }
   }else{
        header("location: ../../frontend/index.php"); 
   }
?>