<?php
   include("config.php");
   session_start();

    $year_level = $_GET['year'];

    $sql = $db->query("SELECT id, section_name FROM sections WHERE year_level = ".$year_level);

    echo json_encode(mysqli_fetch_all($sql));
    //echo json_encode(mysqli_fetch_all($sql->execute()));
?>