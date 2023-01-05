<?php
    session_start();

    $hostname = "127.0.0.1";
    $username = "root";
    $password = "";

    $conn = new mysqli($hostname, $username, $password);
    if($conn->query("SELECT schema_name from information_schema.schemata WHERE schema_name = 'elearn_db'")->num_rows < 1)
        include_once("backend/db/RunAtFirstUse.php");
        
    header("location: frontend/index.php");
?>