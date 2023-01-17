<?php
   include("../config.php");
   session_start();

   if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../../frontend/index.php");
   
   if($_SESSION["role"] == "ADMIN" && isset($_GET["id"])) {
        $sql = $db->prepare("UPDATE users SET deleted_on = NULL WHERE id = ?");
        $sql->bind_param("i", $_GET['id']);
        if($sql->execute()){
            header("location: ../../frontend/admin/people.php");
        }
   }else{
        header("location: ../../frontend/index.php"); 
   }
?>