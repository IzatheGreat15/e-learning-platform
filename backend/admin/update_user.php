<?php
   /** UPDATE SUBJECTS **/
   include("../config.php");
   include("../file_handling/upload_file.php");
   session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_pp = uploadFileSingle($_FILES['new_pp'], 'profile');

            $sql = $db->prepare("UPDATE users SET pp_location = ? WHERE id = ?");
            $sql->bind_param("si", $new_pp, $_SESSION['user_id']);
        if ($sql->execute() === TRUE) {
            header("location: ../../frontend/admin/account-settings.php");
        } else {
            echo "Error updating subject: " . $db->error;
        }
    }
?>