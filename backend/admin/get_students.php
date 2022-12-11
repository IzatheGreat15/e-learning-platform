<?php
   include("config.php");
   session_start();

    $year_level = $_GET['year'];
    $section = $_GET['section'];

    $sql = $db->query("SELECT u.id, s.year_level, u.fname, u.lname, u.pp_location, s.section_name FROM enrollments AS e LEFT JOIN users AS u ON u.id = e.student_id LEFT JOIN sections AS s ON s.id = e.section_id WHERE s.year_level = ".$year_level." AND e.section_id = ".$section);

    echo json_encode(mysqli_fetch_all($sql));
?>