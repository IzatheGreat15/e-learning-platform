<?php
   /** UPDATE SUBJECTS **/
   include("config.php");
   session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $type  = $_POST["type"];

        $sql = $db->prepare("UPDATE subjects SET teacher_id = ?, year_level = ?, subject_name = ? WHERE id = ?");
        $sql->bind_param("iisi", $teacher_id, $year_level, $subject_name, $subject_id);

        if ($sql->execute() === TRUE) {
            header("location: ../../frontend/admin/courses.php");
        } else {
            echo "Error updating subject: " . $db->error;
        }
    }
?>