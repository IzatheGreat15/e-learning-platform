<?php
   include("config.php");
   session_start();

   if(!isset($_SESSION["user_id"]) || !isset($_SESSION["role"]))
        header("location: ../../frontend/index.php");
   
   if($_SESSION["role"] == "ADMIN" && isset($_POST["id"])) {
        $sql = $db->prepare("UPDATE sections SET deleted_on = NULL WHERE id = ?");
        $sql->bind_param("i", $_POST['id']);
        if($sql->execute()){
            header("location: ../../frontend/admin/enrollments.php");
        }
   }else{
        header("location: ../../frontend/index.php"); 
   }
?>