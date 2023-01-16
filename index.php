<?php
    session_start();

    $hostname = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($hostname, $username, $password);
    include_once("backend/db/RunAtFirstUse.php");
        
    //header("location: frontend/index.php");
?>