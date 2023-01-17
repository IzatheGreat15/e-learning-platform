<?php
    session_start();

    include("backend/credentials.php");
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if($conn->query("SELECT schema_name from information_schema.schemata WHERE schema_name = 'elearn_db'")->num_rows < 1)
        include_once("backend/db/RunAtFirstUse.php");
        
    header("location: frontend/index.php");
?>